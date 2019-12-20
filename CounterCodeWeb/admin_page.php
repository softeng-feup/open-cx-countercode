<?php
    include_once('templates/header.php');

    if(!isset($_SESSION['email']) || !isset($_SESSION['admin'])) {
        header('Location: admin_login.php');
        return;
    }
    
    if($_SESSION['admin'] == false) {
        header('Location: speaker_page.php');
        return;
    }
?>


	<div class="background" id="homebackground3">
        <?php include_once('templates/navbar.php'); ?>
        <div id="flex_container">
            <?php include_once('templates/sidebar.php'); ?>
            <div id="create_account">
                <form id="form" method = "POST" action = "actions/add_speaker.php">
                    <h1>Create a speaker account</h2>
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Enter your email here">

                    <br><label for="name">Name</label>
                    <input type="text" name="name" placeholder="Enter your name here">

                    <br><label for="password">Password</label>
                    <input type="password" name="password" minlength="8" maxlength="32" placeholder="Minimum 8 caracters">

                    <br><button type="submit" id="register-btn">Register</button>
                </form>
            </div>
            <!-- <div id="delete_account">
                <div id="form">
                    <h1>Delete a speaker's account</h2>
                </div>
            </div> -->
        </div>
	</div>

<?php include_once('templates/footer.php'); ?>