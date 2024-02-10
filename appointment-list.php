<?php

include_once('includes/conn.php');

// if non login user
if(empty($_SESSION['front'])){
    echo "<script>alert('Access Denied ! Login First')
    window.location='login.php';
    </script>";
    exit();
}

// appointments
$query = "SELECT a.*, d.name AS doctor, p.name AS patient,s.name AS speciality FROM appointments a
INNER JOIN users d ON d.id = a.doctor_id
INNER JOIN specialities s ON s.id = d.speciality_id
INNER JOIN users p ON p.id = a.patient_id WHERE p.id = " . $_SESSION['front']['id'];

$stmt = $connection->prepare($query);
$stmt->execute();
$result = $stmt->get_result();


?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/head.php'); ?>
<body>
    <?php include_once('includes/header.php'); ?>
    <section class="banner doctor-banner">
        <div class="container">
            <h2>Appointment</h2>
        </div>
    </section>
    <section class="listing">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-data">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Doctor</th>
                                        <th>Problem</th>
                                        <th>Description</th>
                                        <th>Datetime</th>
                                        <th>Booked At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if($result->num_rows != 0){
                                    while($row=$result->fetch_assoc()){ ?>
                                    <tr>
                                        <td><?php echo $row['doctor'] . "(" . $row['speciality'] . ")" ?></td>
                                        <td><?php echo $row['problem']; ?></td>
                                        <td>
                                            <div>
                                                <?php echo $row['description']; ?>
                                            </div>
                                        </td>
                                        <td><?php echo date('d/M/y h:i A', strtotime($row['appointment_datetime'])) ?></td>
                                        <td><?php echo date('d/M/y h:i A', strtotime($row['created_at'])) ?></td>
                                        <td><span class="badge"><?php if($row['status'] == 1){ echo "InProgress"; }elseif($row['status'] == 2){ echo "Confirm"; }elseif($row['status'] == 0){ echo 'Cancelled'; } ?></span></td>
                                        <td>
                                            <?php if($row['status'] == 1){ ?>
                                            <div>
                                                <a href="common.php?id=<?php echo base64_encode($row['id']); ?>" class="btns" onclick="return confirm('Sure to cancelled the appointment.')" >Cancelled</a>
                                            </div>
                                            <?php }else{ ?>
                                                -
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php } }else{ ?>
                                        <tr>
                                            <td>
                                                <h2>No Records Found !</h2>
                                                </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <?php include_once('includes/footer.php'); ?>
</body>

</html>