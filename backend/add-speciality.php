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
    $status = $_POST['status'];
    $description = $_POST['description'];

    if($name == '' || $status == '' || $description == ''){
        echo "<script>alert('All fields are required !')
        window.location='add-speciality.php';
        </script>";
        exit();
    }

    $stmt = $connection->prepare("INSERT INTO specialities (name,is_active,description) VALUES(?,?,?)");
    $stmt->bind_param("sss", $name,$status,$description);
    if ($stmt->execute()) {
        echo "<script>alert('Speciality Added Successfully')
        window.location='specialities.php';
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
    $stmt1 = $connection->prepare("SELECT * FROM specialities WHERE id = ?");
    $stmt1->bind_param("s", $get_id);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    if ($result1->num_rows == 0) {
        echo "<script>alert('Unauthorized Access !')
        window.location='specialities.php';
        </script>";
        exit();
    }
    $row1 = $result1->fetch_assoc();

    // update query
    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        
        $stmt2 = $connection->prepare("UPDATE specialities SET name = ?,is_active = ?, description = ? WHERE id = ?");
        $stmt2->bind_param("ssss", $name, $status, $description, $get_id);
        if ($stmt2->execute()) {
            echo "<script>alert('Update Successfully')
        window.location='specialities.php';
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
                <?php if(isset($row1) && !empty($row1)){ ?>
                <h2>Update Speciality</h2>
                <?php }else{ ?>
                <h2>Add Speciality</h2>
                <?php } ?>
            </div>
            <div class="product-form">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col12">
                            <label for="name">Speciality</label>
                            <input type="text" name="name" value="<?php if (isset($row1) && !empty($row1)) {
                                echo $row1['name'];
                            } ?>" class="form-control" placeholder="Speciality" required>
                        </div>
                        <div class="col12">
                            <label for="name">Description</label>
                            <textarea class="form-control" name="description" placeholder="Description" required><?php if (isset($row1) && !empty($row1)) {
                                echo $row1['description'];
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
</body>

</html>