<?php
include_once('includes/conn.php');

if(isset($_POST['submit'])){
    $name=trim($_POST['name']);
    $email=trim($_POST['email']);
    $contact=trim($_POST['contact']);
    $subject=trim($_POST['subject']);
    $message=trim($_POST['message']);

    if($name == '' || $email == '' || $contact == '' || $subject == '' || $message == ''){
        echo "<script>alert('All feilds are required !')
        window.location='contact.php';
        </script>";
        exit();
    }
    
    if (!preg_match('/^\d{10}$/', $contact)) {
        echo "<script>alert('Invalid contact number ! Contact Number Should be 10 Digit.')
        window.location='contact.php';
        </script>";
        exit();
    }
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<script>alert('Invalid Email !')
        window.location='contact.php';
        </script>";
        exit();
    }

    $stmt = $connection->prepare("INSERT INTO queries (name,email,contact,subject,message) VALUES(?,?,?,?,?)");
    $stmt->bind_param("sssss", $name, $email, $contact, $subject, $message);
    if ($stmt->execute()) {
        echo "<script>alert('Hey, $name your query has been received !')
        window.location='index.php';
        </script>";
        exit();
    } else {
        echo "<script>alert('Something Went Wrong Try Again !')
        </script>";
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/head.php'); ?>

<body>
    <?php include_once('includes/header.php'); ?>
    <section class="banner">
        <div class="container">
            <h2>Contact</h2>
        </div>
    </section>
    <section class="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-left">
                        <div class="title">
                            <span>Contact With Us</span>
                            <h3>Get in Touch with Us</h3>
                        </div>
                        <div class="contact-box">
                            <div class="icon-box">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="icon-info">
                                <p> Call Anytime</p>
                                <span>35780088008</span>
                            </div>
                        </div>
                        <div class="contact-box">
                            <div class="icon-box">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="icon-info">
                                <p> Write Email</p>
                                <span>lifecare@gmail.com</span>
                            </div>
                        </div>
                        <div class="contact-box">
                            <div class="icon-box">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="icon-info">
                                <p> Visit Us Anytime</p>
                                <span>880 Broklyn Street New York. USA</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-wrap">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-cntrol" name="name" placeholder="Your name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-cntrol" name="email" placeholder="Email Address"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" class="form-cntrol" name="contact" placeholder="Phone Number"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="subject">Subject</label>
                                    <input type="text" class="form-cntrol" name="subject" placeholder="Subject"
                                        required>
                                </div>
                                <div class="col-md-12">
                                    <label for="message">Message</label>
                                    <textarea name="message" placeholder="Message" required></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button name="submit" class="btn">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include_once('includes/footer.php'); ?>
</body>

</html>