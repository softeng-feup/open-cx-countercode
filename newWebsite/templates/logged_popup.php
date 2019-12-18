<style>
@import url('https://fonts.googleapis.com/css?family=Roboto&display=swap');
body {font-family: 'Roboto', sans-serif;}
* {box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page */
#account-button {
    padding: 7.75px 16px;
    font-size: 17px;
    font-weight: normal;
}

#account-button img{
    pointer-events:none;
}

/* Add styles to the form container */
#logged-container {
    max-width: 315.35px;
    padding: 10px;
    font-size: 0.75em;
}

/* Set a style for the submit/login button */
#logged-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

#logged-container .settings, #logged-container .houses, #logged-container .rent_list{
  background-color: #f1f1f1bb;
  color: black;
}

/* Add some hover effects to buttons */
#logged-container .btn:hover, #account-button:hover {
  opacity: 1;
}

@media screen and (max-width: 720px) {
    #account-button {
        float: none;
        display: block;
        text-align: left;
        width: 100%;
        margin: 0;
        padding: 8.3px 1em;
    }

    #account-popup {
        display: none;
        position: fixed;
        top: 117px;
        width: 100%;
        z-index: 1;
    }

    /* Add styles to the form container */
    .form-container {
        border-radius: 2px;
        padding: 10px;
        width: 100%;
        background-color: #f1f1f1;
    }
}

</style>

<button id="account-button"><img src="images/profile.png"></button>

<div id="account-popup">
  <form id="logged-container">
    <h1>Welcome, <?php echo $_SESSION['firstname']; ?></h1>

    <button type="button" class="btn settings"  onclick="window.location.href='account_settings.php'">Account settings</button>

    <button type="button" class="btn houses" onclick="window.location.href='manage_my_houses.php'">Manage my houses</button>
    
    <button type="button" class="btn rent_list" onclick="window.location.href='my_rent_listing.php'">Rent listings</button>

    <button type="submit" id="logout-btn"class="btn">Logout</button>
  </form>
</div>

<!-- <script>

function open_settings() {
  document.getElementById("myForm").style.display = "none";
}
function open_management() {
  document.getElementById("myForm").style.display = "none";
}

</script> -->
