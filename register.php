<?php

include_once('includes/conn.php');

// register
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $role = 'user';
    $status = 1;
    $address = $_POST['address'];

    if ($name == '' || $contact == '' || $email == '' || $password == '' || $address == '') {
        echo "<script>alert('All Fields are required !')
        window.location='register.php';
        </script>";
        exit();
    }

    if (!preg_match('/^\d{10}$/', $contact)) {
        echo "<script>alert('Invalid contact number ! Contact Number Should be 10 Digit.')
        window.location='register.php';
        </script>";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid Email !')
        window.location='register.php';
        </script>";
        exit();
    }

    $stmt = $connection->prepare("INSERT INTO users (name,email,contact,password,role,is_active,address) VALUES(?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssss", $name, $email, $contact, $password, $role, $status, $address);
    if ($stmt->execute()) {
        echo "<script>alert('Hey, $name Welcome to Life Care Pharma Elite !')
        window.location='login.php';
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
    <section class="login-detail">
        <div class="login-wrap">
            <div class="login-info">
                <div class="login-image">
                    <img src="images/register.jpg" alt="login" title="login">
                </div>
            </div>
            <div class="login-info">
                <form action="" method="POST">
                    <h2>Register</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-grid">
                                <label for="Name">Name</label> <input type="text" name="name" placeholder="Enter Name"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-grid">
                                <label for="Mobile Number">Mobile Number</label> <input type="tel" name="contact"
                                    placeholder="Enter Mobile Number" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-grid">
                                <label for="Mobile Number">Email</label> <input type="email" name="email"
                                    placeholder="Enter Email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-grid">
                                <label for="Password">Password</label> <input type="password" name="password"
                                    minlength="8" placeholder="Enter Password" required>
                            </div>
                        </div>
                    </div>
                    <div class="input-grid">
                        <label for="Password">Address</label>
                        <textarea name="address" id="" placeholder="Address" required></textarea>
                    </div>
                    <button class="btn" name="submit">Sign Up</button>
                    <p>Already have an account?
                        <a href="login.php">Sign in</a>
                    </p>
                </form>
            </div>
        </div>
    </section>
    <?php include_once('includes/footer.php'); ?>
</body>

</html>