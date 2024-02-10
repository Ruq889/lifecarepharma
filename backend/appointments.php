<?php
include_once "includes/conn.php";

// redirect to login non-login user
if(empty($_SESSION['backend'])){
    header('location:login.php');
    exit();
}

// // only admin access
// if(isset($_SESSION['backend']) && $_SESSION['backend']['role'] != 'admin' && $_SESSION['backend']['role'] != 'doctor'){
//     echo "<script>alert('Access Denied !')
//     window.location='index.php';
//     </script>";
//     exit();
// }

$query = "SELECT a.*, d.name AS doctor, p.name AS patient, s.name AS speciality
FROM appointments a
INNER JOIN users d ON d.id = a.doctor_id
INNER JOIN specialities s ON s.id = d.speciality_id
INNER JOIN users p ON p.id = a.patient_id";


// if doctor login
if(isset($_SESSION['backend']) && $_SESSION['backend']['role'] == 'doctor'){
    $query = $query . " WHERE doctor_id = " . $_SESSION['backend']['id'];
}

$stmt = $connection->prepare($query);
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
                <h2>Appointments</h2> 
                <!-- <a href="add-user.php" class="btn">Add User</a> -->
            </div>
            <div class="product-list">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Prescription</th>
                                <th>Patinet</th>
                                <?php if($_SESSION['backend']['role'] != 'doctor'){ ?>
                                    <th>Doctor</th>
                                    <?php } ?>
                                    <th>Datetime</th>
                                <th>Problem</th>
                                <th>Description</th>
                                <th>Status</th>
                                <?php if($_SESSION['backend']['role'] == 'doctor' || $_SESSION['backend']['role'] == 'admin'){ ?>
                                    <th>Action</th>
                                    <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n = 1;
                            if($result->num_rows != 0){
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                <tr>
                                    <td>
                                        <?php echo $n++; ?>
                                    </td>
                                    
                                    <td>
                                        <img src="img/prescriptions/<?php echo $row['prescription']; ?>">
                                    </td>
                                    <td>
                                        <?php echo $row['patient']; ?>
                                    </td>
                                    <?php if($_SESSION['backend']['role'] != 'doctor'){ ?>
                                        <td>
                                            <?php echo $row['doctor'] . "(" . $row['speciality'] . ")" ?>
                                        </td>
                                        <?php } ?>
                                        <td>
                                            <?php echo date('d-M-Y h:i A',strtotime($row['appointment_datetime'])); ?>
                                        </td>
                                        <td>
                                            <?php echo $row['problem']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['description']; ?>
                                    </td>
                                    <td>
                                        <?php if ($row['status'] == 1) { ?>
                                            <h3>InProgress</h3>
                                            <?php } elseif($row['status'] == 2) { ?>
                                                <h3>Confirm</h3>
                                                <?php } elseif($row['status'] == 3) { ?>
                                                    <h3>Completed</h3>
                                                    <?php } elseif($row['status'] == 0) { ?>
                                                        <h3>Cancelled</h3>
                                                        <?php } ?>
                                                    </td>
                                                    <?php if($_SESSION['backend']['role'] == 'doctor' || $_SESSION['backend']['role'] == 'admin'){ ?>
                                                    <td>
                                                        <div class="action">
                                        <!-- <i class="fa fa-trash-o"></i> -->
                                        <?php if($row['status'] == 1){ ?>
                                            <a onclick="return confirm('Sure to confirm Appointment ?')" href="common.php?confirm=<?php echo base64_encode($row['id']); ?>"><i class="fa fa-check" aria-hidden="true"></i></a>
                                            <a onclick="return confirm('Sure to cancelled Appointment ?')" href="common.php?cancelled=<?php echo base64_encode($row['id']); ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                                            <?php }elseif($row['status'] == 2){ ?>
                                                <a onclick="return confirm('Sure to mark Appointment as Completed ?')" href="common.php?completed=<?php echo base64_encode($row['id']); ?>"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                <?php }else{ ?>
                                                    -
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <?php } ?>
                                </tr>
                            <?php } }else{ ?>
                                <tr>
                                    <td>No Records Forund !</td>
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