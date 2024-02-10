<?php 
include_once "includes/conn.php"; 

// redirect to login
if(empty($_SESSION['backend'])){
    header('location:login.php');
    exit();
}

// users count
$stmt = $connection->prepare("SELECT 
    COUNT(CASE WHEN role = 'doctor' THEN 1 ELSE NULL END) AS doctor,
    COUNT(CASE WHEN role = 'user' THEN 1 ELSE NULL END) AS user
    FROM users");
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// appointments count in-progress
$stmt1 = $connection->prepare("SELECT count(*) AS appointments FROM appointments WHERE status = 1");
$stmt1->execute();
$result1 = $stmt1->get_result();
$row1 = $result1->fetch_assoc();


?>
<!DOCTYPE html>
<html lang="en">

<?php include_once "includes/head.php"; ?>

<body>
    <?php include_once "includes/header.php"; ?>
    <?php include_once "includes/sidebar.php"; ?>

    <section class="admin">
        <div class="dashboard-wrap">
            <div class="heading">
                <h2>Dashboard !</h2>
            </div>
            <div class="dashboard-wrap-boxes">
                <div class="row">
                    <div class="col4">
                        <div class="employee-box">
                            <div class="box-top">
                                <h4>Total User's</h4>
                                <i class="fa fa-user"></i>
                            </div>
                            <span><?php echo $row['user']; ?></span>
                        </div>
                    </div>
                    <div class="col4">
                        <div class="employee-box">
                            <div class="box-top">
                                <h4>Total Doctor's</h4>
                                <i class="fa fa-user"></i>
                            </div>
                            <span><?php echo $row['doctor']; ?></span>
                        </div>
                    </div>
                    <div class="col4">
                        <div class="employee-box">
                            <div class="box-top">
                                <h4>New Appointments</h4>
                                <i class="fa fa-user"></i>
                            </div>
                            <span><?php echo $row1['appointments']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>