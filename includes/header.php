<header>
    <div class="navbar">
        <div class="container">
            <div class="header-bottom">
                <div class="bottom-left">
                    <div class="logo">
                        <a href="index.php"> <img src="images/logo.png" alt="logo" title="logo"></a>
                    </div>
                </div>
                <div class="bottom-right">
                    <ul>
                        <li>
                            <a <?php if($route == 'index.php'){ ?> class="active" <?php } ?> href="index.php">Home</a>
                        </li>
                        <li>
                            <a <?php if($route == 'about.php'){ ?> class="active" <?php } ?> href="about.php">About</a>
                        </li>
                        <li>
                            <a <?php if($route == 'contact.php'){ ?> class="active" <?php } ?> href="contact.php">Contact</a>
                        </li>
                        <?php if(isset($_SESSION['front'])){ ?>
                        <li>
                            <a <?php if($route == 'appointment-list.php'){ ?> class="active" <?php } ?> href="appointment-list.php">My Appointments</a>
                        </li>
                        <li>
                            <a onclick="return confirm('Sure to Logout ?')" <?php if($route == 'logout.php'){ ?> class="active" <?php } ?> href="logout.php"><?php echo $_SESSION['front']['name']; ?>/Logout</a>
                        </li>
                        <?php }else{ ?>
                            <li>
                                <a <?php if($route == 'login.php'){ ?> class="active" <?php } ?> href="login.php">Login</a>
                            </li>
                            <?php } ?>
                        </ul>
                </div>
            </div>
        </div>
        <div class="toggle">
            <img src="image/menu.png" alt="image" title="image">
        </div>
    </div>
</header>