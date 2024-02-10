<?php 
include_once 'includes/conn.php';

// redirect to dashboard if already login
if(isset($_SESSION['backend'])){
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
        if($row['role'] == 'user'){
            echo "<script>alert('Pemission Denied Admin Area !')
            window.location='../login.php';
            </script>";
            exit();
        }elseif ($row['is_active'] != 1) {
            echo "<script>alert('Account is Inactive Contact Admin !')
            window.location='login.php';
            </script>";
            exit();
        } else {
            $_SESSION['backend'] = $row;
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

<?php include_once 'includes/head.php'; ?>

<body class="admin">
    <header>
        <div class="head-wrap">
            <div class="head-left">
                <div class="logo">
                    <a href="../index.php"> <img src="img/logo.png" alt="logo" title="logo"></a>
                </div>
            </div>
        </div>
    </header>
    <section class="login">
        <div class="container">
            <div class="login-form">
                <div class="logo">
                    <a href="../index.php"> <img src="img/logo.png" alt="logo" title="logo" width="70"></a>
                </div>
                <form action="" method="POST">
                    <h2>Login </h2>
                    <div class="row">
                        <div class="col12">
                            <label for="name">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="col12">
                            <label for="name">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="col12">
                            <div class="form-btn"><button name="submit">Login</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <footer>
    @copyright 2024
    </footer>
</body>

</html>