<?php include_once('templates/header.php'); ?>

	<div class="background" id="homebackground">
        <?php include_once('templates/navbar.php'); ?>
        <div id="login_container">
            <form id="login_form">
                <label for="username">Username<br>
                    <input type="text" id="username">
                </label>
                <label for="password"><br>Password<br>
                    <input type="password" id="password">
                </label>
                <br><input type="submit" id="login_btn" value="Login">
            </div>
        </div>
	</div>

<?php include_once('templates/footer.php'); ?>