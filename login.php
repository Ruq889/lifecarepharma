<?php 
include_once('includes/conn.php');

// redirect to dashboard if already login
if(isset($_SESSION['front'])){
    header('location:index.php');
    exit();
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $connection->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "<script>alert('Incorrect Email/Password ! No user found')
            </script>";
    } else {
        $row = $result->fetch_assoc();
       if ($row['is_active'] != 1) {
            echo "<script>alert('Account is Inactive Contact Admin !')
            window.location='login.php';
            </script>";
            exit();
        } else {
            $_SESSION['front'] = $row;
            echo "<script>alert('Login Successfully !')
                window.location='index.php';
                </script>";
            exit();
        }
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
                        <form action="" method="POST">
                            <h2>Login</h2>
                            <div class="input-grid">
                                <label for="Username">Username</label> <input type="email" name="email" placeholder="Enter Username" required></div>
                          
                            <div class="input-grid">
                                <label for="Password">Password</label> <input type="password" name="password" placeholder="Enter Password" required></div>
                            <button class="btn" name="submit">Sign In</button>
                            <p>Don't have an account?
                                <a href="register.php">Sign Up</a>
                            </p>
                        </form>
                    </div>
                    <div class="login-info">
                        <div class="login-image">
                            <img src="images/login.jpg" alt="login" title="login">
                        </div>
                    </div>
                </div>
            </section>
            <?php include_once('includes/footer.php'); ?>
</body>

</html>