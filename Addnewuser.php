<?php
session_start();
// Check if the request is made over HTTPS
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
// Redirect to the HTTPS page
header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
exit();
}
// Include the database connection file
require "database.php";
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Validate form data
$username = $_POST["register-username"];
$password = $_POST["register-password"];
$repassword = $_POST["register-repassword"];
// Check if passwords match
if ($password !== $repassword) {
$error = "Passwords do not match.";
} else {
// Call addUser function to add the user to the database
$success = addnewuser($username, $password);
if ($success) {
$message = "User registered successfully!";
} else {
$error = "Failed to register user.";
}
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up</title>
<style>
body {
font-family: Arial, sans-serif;
background-color: #f0f0f0;
}
h2 {
text-align: center;
color: #333;
}
#registration-form {
max-width: 400px;
margin: 0 auto;
padding: 20px;
background-color: #fff;
border-radius: 5px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
label {
display: block;
margin-bottom: 5px;
color: #333;
}
.text_field {
width: 100%;
padding: 10px;
margin-bottom: 15px;
border: 1px solid #ccc;
border-radius: 3px;
}
input[type="submit"] {
width: 100%;
padding: 10px;
border: none;
border-radius: 3px;
background-color: #007bff;
color: #fff;
cursor: pointer;
}
.error {
color: #dc3545;
font-size: 14px;
display: none;
}
.message {
padding: 10px;
border-radius: 3px;
margin-top: 15px;
}
.success {
background-color: #d4edda;
color: #155724;
}
.error-msg {
background-color: #f8d7da;
color: #721c24;
}
</style>
</head>
<body>
<h2>SIGN UP</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
id="registration-form">
<label for="register-username">Username:</label>
<input type="text" id="register-username" name="register-username" class="text_field"
required
pattern="^[\w.-]+@[\w-]+(\.[\w-]+)*$"
title="Please enter a valid email as username"
placeholder="Your email address">
<span class="error" id="register-email-error">Email format is incorrect.</span><br><br>
<label for="register-password">Password:</label>
<input type="password" id="register-password" name="register-password"
class="text_field" required
pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&])[A-Za-z\d!@#$%^&]{8,}$"
title="Password must have at least 8 characters with 1 special symbol !@#$%^&
1 number, 1 lowercase, and 1 UPPERCASE"
placeholder="Your password">
<span class="error" id="register-password-error">Password requirements not
met.</span><br><br>
<label for="register-repassword">Retype Password:</label>
<input type="password" id="register-repassword" name="register-repassword"
class="text_field" required
placeholder="Retype your password"
title="Password does not match">
<span class="error" id="register-repassword-error">Passwords do not
match.</span><br><br>
<input type="checkbox" onclick="togglePasswordVisibility('register-password')"> Show
Password<br><br>
<input type="submit" value="Sign up">
</form>
<?php if (isset($message)): ?>
<p class="message success"><?php echo $message; ?></p>
<?php endif; ?>
<?php if (isset($error)): ?>
<p class="message error-msg"><?php echo $error; ?></p>
<?php endif; ?>
<div class="login-link">
<p>Already have an account? <a href="registrationform.php">Login</a></p>
</div>
<script>
// Function to toggle password visibility
function togglePasswordVisibility(inputId) {
var x = document.getElementById(inputId);
if (x.type === "password") {
x.type = "text";
} else {
x.type = "password";
}
}
</script>
</body>
</html>
