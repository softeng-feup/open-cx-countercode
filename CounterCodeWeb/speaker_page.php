<?php include_once('templates/header.php'); ?>

	<div class="background" id="homebackground3">
        <?php include_once('templates/navbar.php'); ?>
        <div id="flex_container">
            <?php include_once('templates/sidebar.php'); ?>
            <div id="create_account">
                <form id="form" method = "POST" action = "actions/add_talk.php">
                    <h1>Create a talk</h2>
                    <label for="title">Title</label>
                    <input type="text" name="title" placeholder="Enter your talk's title">

                    <br><label for="room">Room</label>
                    <input type="text" name="room" placeholder="B001">

                    <br><label for="date_start">Start Time</label>
                    <input type="datetime-local" name="date_start" >

                    <br><label for="date_end">End Time</label>
                    <input type="datetime-local" name="date_end" >

                    <br><button type="submit" id="register-btn">Add</button>
                </form>
            </div>
        </div>
	</div>

<?php include_once('templates/footer.php'); ?>