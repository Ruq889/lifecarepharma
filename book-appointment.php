<?php 

include_once('includes/conn.php');

// if non login user
if(empty($_SESSION['front'])){
    echo "<script>alert('Access Denied ! Login First')
    window.location='login.php';
    </script>";
    exit();
}

// current user details
$stmt=$connection->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("s",$_SESSION['front']['id']);
$stmt->execute();
$result=$stmt->get_result();
$row=$result->fetch_assoc();

// fetch doctors
$query="SELECT u.*,s.name AS specialty FROM users u 
INNER JOIN specialities s ON s.id = u.speciality_id
WHERE u.role = 'doctor' AND u.is_active = 1 AND u.is_deleted = 0";

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = base64_decode($_GET['id']);
}

$stmt1=$connection->prepare($query);
$stmt1->execute();
$result1=$stmt1->get_result();

// submit appointment
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $doctor_id = $_POST['doctor_id'];
    $patient_id = $_SESSION['front']['id'];
    $datetime = $_POST['datetime'];
    $problem = $_POST['problem'];
    $description = $_POST['description'];
    $status = 1;
    $prescription = $_FILES['prescription']['name'];
    $tmpname = $_FILES['prescription']['tmp_name'];

    $folder="backend/img/prescriptions/" . $prescription;

    $stmt2=$connection->prepare("INSERT INTO appointments (name,contact,email,doctor_id,patient_id,appointment_datetime,problem,description,prescription,status) VALUES(?,?,?,?,?,?,?,?,?,?)");
    $stmt2->bind_param("ssssssssss",$name,$contact,$email,$doctor_id,$patient_id,$datetime,$problem,$description,$prescription,$status);
    if($stmt2->execute()){
        move_uploaded_file($tmpname,$folder);
        echo "<script>alert('Thanks For booking your appointment')
        window.location='appointment-list.php';
        </script>";
        exit();
    }else{
        echo "<script>alert('Something Went Wrong Please Try Again !')
        </script>";
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/head.php'); ?>

<body>
    <?php include_once('includes/header.php'); ?>
            <section class="banner" style="background-image: url(./images/doctor-banner1.jpg);">
                <div class="container">
                    <h2>Book Appointment</h2>
                </div>
            </section>
            <section class="contact">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="contact-left">
                            <img src="images/appointment.jpg" alt="appointment" title="appointment">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-wrap">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="name">Doctor</label>
                                            <select class="form-cntrol" name="doctor_id" id="" required>
                                                <option value="">Choose</option>
                                                <?php while($row1=$result1->fetch_assoc()){ ?>
                                                <option value="<?php echo $row1['id']; ?>" <?php if(isset($id) && !empty($id) && $id == $row1['id']){ echo 'selected'; } ?> ><?php echo $row1['name'] . "(" . $row1['specialty'] . ")"; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-cntrol" value="<?php echo $row['name']; ?>" name="name" placeholder="Your name" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-cntrol" value="<?php echo $row['email']; ?>" name="contact" placeholder="Email Address" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone">Phone Number</label>
                                            <input type="tel" class="form-cntrol" value="<?php echo $row['contact']; ?>" name="email" placeholder="Phone Number" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="subject">Appointment Date-Time</label>
                                            <input type="datetime-local" class="form-cntrol" id="datetime" name="datetime" placeholder="Subject" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="subject">Problem</label>
                                            <input type="text" class="form-cntrol" name="problem" placeholder="Problem" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="subject">Prescription</label>
                                            <input type="file" class="form-cntrol" name="prescription" placeholder="Subject" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="message">Description</label>
                                            <textarea name="description" placeholder="Description" required></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn" name="submit">Book</button>
                                            <!-- <a href="#" class="btn">Book</a> -->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php include_once('includes/footer.php'); ?>
            <script>
var today = new Date().toISOString().slice(0, 16);

document.getElementById("datetime").min = today;
                </script>
</body>

</html>