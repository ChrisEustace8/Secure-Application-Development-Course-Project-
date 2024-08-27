<!DOCTYPE html>
<?php
require "session_auth.php";
// $rand = 10;
$rand = bin2hex(openssl_random_pseudo_bytes(16));
$_SESSION["nocsrftoken"] = $rand;
?>
<html>
<head>
<title>My change-password page</title>
<script>
function togglePasswordVisibility() {
var passwordField = document.getElementById("password");
if (passwordField.type === "password") {
passwordField.type = "text";
} else {
passwordField.type = "password";
}
}
</script>
</head>
<body>
<h2>Change Password, SecAppDevelopment at UDayton</h2>
<?php
// Format the date and time
$currentDateTime = date('Y-m-d h:i:s A');
// Display the date and time
echo "<p>Current Time: $currentDateTime</p>";
?>
<form action="changepassword.php" method="post">
<label for="username">Username:</label>
<!-- input type="text" id="username" name="username" required><br><br> /-->
<?php echo htmlentities($_SESSION["username"]); ?>
<br>
<input type="hidden" name="nocsrftoken" value="<?php echo $rand; ?>" />
<label for="password">New Password:</label>
<input type="password" id="password" name="newpassword" required>
<input type="checkbox" onclick="togglePasswordVisibility()"> Show Password<br><br>
<input type="submit" value="Change password">
</form>
</body>
</html>
