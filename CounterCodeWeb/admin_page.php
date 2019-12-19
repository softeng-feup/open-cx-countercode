<?php include_once('templates/header.php'); ?>

	<div class="background" id="homebackground3">
        <?php include_once('templates/navbar.php'); ?>
        <div id="flex_container">
            <?php include_once('templates/sidebar.php'); ?>
            <div id="create_account">
                <form id="form">
                    <h1>Create a speaker account</h2>
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Enter your email here">

                    <br><label for="firstname">First Name</label>
                    <input type="text" id="name" placeholder="Enter your first name here">

                    <br><label for="password">Password</label>
                    <input type="password" id="password" minlength="8" maxlength="32" placeholder="Minimum 8 caracters">

                    <br><label for="passwordconfirm">Confirm password</label>
                    <input type="password" id="passwordconfirm">

                    <br><button type="submit" id="register-btn">Register</button>
                </form>
            </div>
            <div id="delete_account">
                <div id="form">
                    <h1>Delete a speaker's account</h2>
                    <!-- TODO: Query get all accounts !=is_admin -->
                </div>
            </div>
        </div>
	</div>

<?php include_once('templates/footer.php'); ?>