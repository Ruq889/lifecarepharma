<?php
include_once "includes/conn.php";

// redirect to login non-login user
if(empty($_SESSION['backend'])){
    header('location:login.php');
    exit();
}

// confirm appointment
if(isset($_GET['confirm']) && !empty($_GET['confirm'])){
    $confirm = base64_decode($_GET['confirm']);

    $stmt=$connection->prepare("UPDATE appointments SET status = 2 WHERE id = ?");
    $stmt->bind_param("s",$confirm);
    if($stmt->execute()){
        echo "<script>alert('Appointment Confirmed Successfully !')
        window.location='appointments.php';
        </script>";
        exit();
    }else{
        echo "<script>alert('Something Went Wrong Try Again !')
        window.location='appointments.php';
        </script>";
        exit();
    }

}

// cancelled appointment
if(isset($_GET['cancelled']) && !empty($_GET['cancelled'])){
    $cancelled = base64_decode($_GET['cancelled']);

    $stmt=$connection->prepare("UPDATE appointments SET status = 0 WHERE id = ?");
    $stmt->bind_param("s",$cancelled);
    if($stmt->execute()){
        echo "<script>alert('Appointment cancelled Successfully !')
        window.location='appointments.php';
        </script>";
        exit();
    }else{
        echo "<script>alert('Something Went Wrong Try Again !')
        window.location='appointments.php';
        </script>";
        exit();
    }

}

// complete appointment
if(isset($_GET['completed']) && !empty($_GET['completed'])){
    $completed = base64_decode($_GET['completed']);

    $stmt=$connection->prepare("UPDATE appointments SET status = 3 WHERE id = ?");
    $stmt->bind_param("s",$completed);
    if($stmt->execute()){
        echo "<script>alert('Appointment completed Successfully !')
        window.location='appointments.php';
        </script>";
        exit();
    }else{
        echo "<script>alert('Something Went Wrong Try Again !')
        window.location='appointments.php';
        </script>";
        exit();
    }

}


?>