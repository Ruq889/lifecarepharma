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

// add user
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];
    $status = $_POST['status'];
    $address = $_POST['address'];

    $stmt = $connection->prepare("INSERT INTO users (name,email,contact,password,role,is_active,address) VALUES(?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssss", $name, $email, $contact, $password, $role, $status, $address);
    if ($stmt->execute()) {
        echo "<script>alert('Staff Added Successfully')
        window.location='staff.php';
        </script>";
        exit();
    } else {
        echo "<script>alert('Something Went Wrong Try Again !')
        </script>";
    }
}

// edit user
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $get_id = base64_decode($_GET['id']);
    // check if record exists
    $stmt1 = $connection->prepare("SELECT * FROM users WHERE (role = 'pharmacist' OR role = 'staff') AND id = ?");
    $stmt1->bind_param("s", $get_id);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    if ($result1->num_rows == 0) {
        echo "<script>alert('Unauthorized Access !')
        window.location='staff.php';
        </script>";
        exit();
    }
    $row1 = $result1->fetch_assoc();

    // update query
    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $status = $_POST['status'];
        $role = $_POST['role'];
        
        $stmt2 = $connection->prepare("UPDATE users SET name = ?,contact = ?,is_active = ?, address = ?,role = ? WHERE id = ?");
        $stmt2->bind_param("ssssss", $name, $contact, $status, $address,$role, $get_id);
        if ($stmt2->execute()) {
            echo "<script>alert('Update Successfully')
        window.location='staff.php';
        </script>";
            exit();
        } else {
            echo "<script>alert('Something Went Wrong Try Again !')
        </script>";
        }
    }
}

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
                <h2><?php if(isset($row1)){ echo "Update"; }else{ echo "Add";  }?> Staff</h2>
            </div>
            <div class="product-form">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col12">
                            <label for="name">Role</label>
                            <select name="role" id="" required>
                                <option value="">Choose</option>
                                <option value="pharmacist" <?php if(isset($row1) && !empty($row1) && $row1['role'] == 'pharmacist'){ echo 'selected'; } ?>>Pharmacist</option>
                                <option value="staff" <?php if(isset($row1) && !empty($row1) && $row1['role'] == 'staff'){ echo 'selected'; } ?>>Staff</option>
                            </select>
                        </div>
                        <div class="col6">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="<?php if (isset($row1) && !empty($row1)) {
                                echo $row1['name'];
                            } ?>" class="form-control" placeholder="Name" required>
                        </div>

                        <div class="col6">
                            <label for="number">Contact</label>
                            <input type="tel" value="<?php if (isset($row1) && !empty($row1)) {
                                echo $row1['contact'];
                            } ?>" class="form-control" name="contact" placeholder="Contact" required>
                        </div>
                        <?php if(!isset($row1)){ ?>
                        <div class="col6">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="<?php if (isset($row1) && !empty($row1)) {
                                echo $row1['email'];
                            } ?>" class="form-control" placeholder="Email" <?php if (isset($row1)) { ?> readonly
                                <?php } else { ?> required <?php } ?>>
                        </div>
                        <div class="col6">
                            <label for="address">Password</label>
                            <input type="password" name="password" minlength="8" value="<?php if (isset($row1) && !empty($row1)) {
                                echo $row1['password'];
                            } ?>" class="form-control" placeholder="Password" <?php if (isset($row1)) { ?> readonly
                                <?php } else { ?> required <?php } ?>>
                        </div>
                        <?php } ?>
                        <div class="col12">
                            <label for="name">Address</label>
                            <textarea class="form-control" name="address" placeholder="Address" required><?php if (isset($row1) && !empty($row1)) {
                                echo $row1['address'];
                            } ?></textarea>
                        </div>
                        <div class="col12">
                            <label for="email">Status</label>
                            <select name="status" id="" required>
                                <option value="1" <?php if (isset($row1) && $row1['is_active'] == 1) {
                                    echo 'selected';
                                } ?>>Active</option>
                                <option value="0" <?php if (isset($row1) && $row1['is_active'] == 0) {
                                    echo 'selected';
                                } ?>>In-Active</option>
                            </select>
                        </div>
                        <div class="col12">
                            <div class="form-btn"> <button <?php if (isset($row1)) { ?> name="update" <?php } else { ?>
                                        name="submit" <?php } ?>>Submit</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function(){

    $('#role').change(function(){
        var n = $(this).val();

        if(n == 'admin'){
            alert('ohk')
        }
    })

});
</script>
</body>

</html>