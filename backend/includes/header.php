<header>
    <div class="head-wrap">
        <div class="head-left">
            <div class="logo">
                <a href="index.php"> <img src="img/logo.png" alt="logo" title="logo"></a>
            </div>
        </div>
        <div class="head-right">
            <h4>
                <a onclick="return confirm('Confirm to logout ?')" href="logout.php"><?php if(isset($_SESSION['backend']) && !empty($_SESSION['backend'])){ echo $_SESSION['backend']['name'] ?>/Logout <?php } ?></a>
            </h4>
        </div>
    </div>
</header>