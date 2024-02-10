<?php 

include_once('includes/conn.php');

$stmt=$connection->prepare("SELECT u.*,s.name AS speciality FROM users u
INNER JOIN specialities s ON s.id = u.speciality_id
WHERE u.is_active = 1 AND u.is_deleted = 0 AND u.role = 'doctor'");
$stmt->execute();
$result=$stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/head.php'); ?>

<body>
    <?php include_once('includes/header.php'); ?>
            <section class="banner doctor-banner">
                <div class="container">
                    <h2>Our Doctors</h2>
                </div>
            </section>
            <section class="doctor_list">
                <div class="container">
                    <div class="heading">
                    </div>
                    <div class="doctor_wrap">
                        <div class="row">
                            <?php while($row=$result->fetch_assoc()){ ?>
                            <div class="col-md-4">
                                <div class="doctor_box">
                                    <div class="img">
                                        <img src="backend/img/doctors/<?php echo $row['image']; ?>" alt="image" title="image">
                                    </div>
                                    <div class="doctor_info">
                                        <h3>Dr. <?php echo $row['name']; ?></h3>
                                        <span><?php echo $row['speciality']; ?></span>
                                        <p><?php echo $row['description']; ?></p>
                                        <a href="book-appointment.php?id=<?php echo base64_encode($row['id']); ?>" class="btn">Book Appointment</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php include_once('includes/footer.php'); ?>
</body>

</html>