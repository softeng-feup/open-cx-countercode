<div class="topnav">

    <form action="search_results.php" method="GET">
        <?php if(!isset($_SESSION['email'])) { ?>
            <button type="button" id="account-button" onclick="location.href='admin_login.php'">Admin Login</button>
        <?php } else { ?>
            <button type="button" id="account-button" onclick="location.href='actions/logout.php'">Logout</button>
        <?php } ?>
    </form>

</div>