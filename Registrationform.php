<!DOCTYPE html>
<html>
<head>
<style>
body {
font-family: Arial, sans-serif;
background-color: #f0f0f0;
margin: 0;
padding: 0;
}
h2 {
text-align: center;
color: #333;
}
form {
max-width: 400px;
margin: 20px auto;
padding: 20px;
background-color: #fff;
border-radius: 8px;
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
border-radius: 5px;
box-sizing: border-box;
}
input[type="checkbox"] {
margin-bottom: 15px;
}
input[type="submit"] {
padding: 12px 20px;
background-color: #007bff;
color: #fff;
border: none;
border-radius: 5px;
cursor: pointer;
font-size: 16px;
transition: background-color 0.3s ease;
}
input[type="submit"]:hover {
background-color: #0056b3;
}
.error {
color: #ff0000;
margin-top: 5px;
display: none; /* Hide error messages by default */
}
.signup-link {
text-align: center;
margin-top: 20px;
}
.signup-button {
padding: 10px 20px;
background-color: #28a745;
color: #fff;
border: none;
border-radius: 5px;
cursor: pointer;
font-size: 16px;
transition: background-color 0.3s ease;
text-decoration: none; /* Remove underline from the link */
}
.signup-button:hover {
background-color: #218838;
}
</style>
</head>
<body>
<h2>Login</h2>
<?php
// Format the date and time
$currentDateTime = date('Y-m-d h:i:s A');
// Display the date and time
echo "<p>Current Time: $currentDateTime</p>";
echo "<p style='text-align: center; font-weight: bold; color: #333;'>minifacebook - Secad -
Team 0</p>";
echo "<p style='text-align: center; font-style: italic; color: #777;'>by Chris Eustace</p>";
?>
<form action="index.php" method="post">
<label for="username">Username:</label>
<input type="text" id="username" name="username" required><br><br>
<label for="password">Password:</label>
<input type="password" id="password" name="password" required>
<input type="checkbox" id="showPasswordCheckbox"> Show Password<br><br> <!--
Updated id for the checkbox -->
<input type="submit" value="Login">
</form>
<div class="signup-link">
<a href="addnewuser.php" class="signup-button">Join us</a>
</div>
<script>
function togglePasswordVisibility() {
var passwordField = document.getElementById("password");
var checkbox = document.getElementById("showPasswordCheckbox");
if (checkbox.checked) {
passwordField.type = "text";
} else {
passwordField.type = "password";
}
}
// Attach the toggle function to the checkbox's click event
document.getElementById("showPasswordCheckbox").addEventListener("click",
togglePasswordVisibility);
</script>
