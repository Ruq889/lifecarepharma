<?php

$route = basename($_SERVER['REQUEST_URI']);

$doctorPage = strpos($route, 'add-doctor.php') !== false || $route === 'doctors.php';
$userPage = strpos($route, 'add-user.php') !== false || $route === 'users.php';
$staffPage = strpos($route, 'add-staff.php') !== false || $route === 'staff.php';
$specialityPage = strpos($route, 'add-speciality.php') !== false || $route === 'specialities.php';

?>

<div class="slide-bar">
    <ul>
        <li <?php if($route == 'index.php'){ ?> class="active" <?php } ?>><a href="index.php">Dashboard</a></li>
        <?php if($_SESSION['backend']['role'] == 'admin'){ ?>
        <li <?php if($userPage){ ?> class="active" <?php } ?>><a href="users.php">Users</a></li>
        <li <?php if($doctorPage){ ?> class="active" <?php } ?>><a href="doctors.php">Doctors</a></li>
        <li <?php if($staffPage){ ?> class="active" <?php } ?>><a href="staff.php">Staff</a></li>
        <li <?php if($specialityPage){ ?> class="active" <?php } ?>><a href="specialities.php">Specialities</a></li>
        <li <?php if($route == 'queries.php'){ ?> class="active" <?php } ?>><a href="queries.php">Queries</a></li>
        <?php } ?>
        <li <?php if($route == 'appointments.php'){ ?> class="active" <?php } ?>><a href="appointments.php">Appointments</a></li>
    </ul>
</div>