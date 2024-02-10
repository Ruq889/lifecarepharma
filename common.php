<?php 
include_once('includes/conn.php');

// if non login user
if(empty($_SESSION['front'])){
    echo "<script>alert('Access Denied ! Login First')
    window.location='login.php';
    </script>";
    exit();
}

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = base64_decode($_GET['id']);

    $stmt=$connection->prepare("SELECT status FROM appointments WHERE id = ?");
    $stmt->bind_param("s",$id);
    $stmt->execute();
    $result=$stmt->get_result();
    $row=$result->fetch_assoc();

    if($row['status'] == 1){
        $stmt1=$connection->prepare("UPDATE appointments SET status = 0 WHERE id = ?");
        $stmt1->bind_param("s",$id);
        if($stmt1->execute()){
            echo "<script>alert('Appointment has been Cancelled.')
            window.location='appointment-list.php';
            </script>";
            exit();
        }else{
            echo "<script>alert('Something Went Wrong Try Again !')
            window.location='appointment-list.php';
            </script>";
            exit();
        }
    }else{
        echo "<script>alert('Appointment Status Already Changed !')
        window.location='appointment-list.php';
        </script>";
        exit();
    }
}



?>

