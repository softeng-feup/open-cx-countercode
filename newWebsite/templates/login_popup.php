<button id="account-button" onclick=open_admin() >Admin Page</button>

<div id="account-popup">
    <form id="login-container">
        <h1>Admin Login</h1>

        <label for="username"><b>Username</b></label>
        <input type="text" id="username" placeholder="Enter username" required>

        <label for="password"><br><b>Password</b></label>
        <input type="password" id="password" minlength="8" maxlength="128" placeholder="Enter Password" required>
        <button type="submit" id="login-btn">Login</button>

        <button type="button" id="register-btn" onclick="location.href='create_account.php';" >Don't have an account? Contact an admin.</button>
    </form>
</div>

<script>
    function open_admin() {
        document.getElementById("account_popup").style.display = "block";
    }
</script>
