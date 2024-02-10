<?php
include_once "includes/conn.php";

// redirect to login non-login user
if(empty($_SESSION['backend'])){
    header('location:login.php');
    exit();
}

// only admin access
if(isset($_SESSION['backend']) && $_SESSION['backend']['role'] != 'admin'){
    echo "<script>alert('Access Denied !')
    window.location='index.php';
    </script>";
    exit();
}

$stmt = $connection->prepare("SELECT * FROM specialities WHERE is_deleted = 0");
$stmt->execute();
$result = $stmt->get_result();

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
                <h2>Specialities</h2> <a href="add-speciality.php" class="btn">Add Speciality</a>
            </div>
            <div class="product-list">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($result->num_rows != 0){
                            $n = 1;
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $n++; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['description']; ?>
                                    </td>
                                    <td>
                                        <?php if ($row['is_active'] == 1) { ?>
                                            <h3>ACTIVE</h3>
                                        <?php } else { ?>
                                            <h3>IN-ACTIVE</h3>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div class="action">
                                        <!-- <i class="fa fa-trash-o"></i> -->
                                        <a href="add-speciality.php?id=<?php echo base64_encode($row['id']) ?>"><i class="fa fa-edit"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } }else{ ?>
                                <tr>
                                    <td>No Records Found</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>

</html>