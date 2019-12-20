<?php include_once('templates/header.php'); ?>

	<div class="background" id="homebackground">
        <?php include_once('templates/navbar.php'); ?>
        <div id="login_container">
            <form id="login_form" action="actions/login.php" method="post">
                <label for="username">Email<br>
                    <input type="email" name="email">
                </label>
                <label for="password"><br>Password<br>
                    <input type="password" name="password" minlength="8" maxlength="128">
                </label>
                <br><input type="submit" name="login_btn" value="Login">
            </div>
        </div>
	</div>

<?php include_once('templates/footer.php'); ?>

<script>
    function check_params($email, $pwd) {
		if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return 'Bad Login';
		}
		if(empty($pwd) || strlen($pwd) < 8 || strlen($pwd) > 128) {
			return 'Bad Login';
		}
		return 'OK';
	}
</script>