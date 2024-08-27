<?php
session_start();
// Set a variable for each parameter
$lifetime = 10 * 60; // 10 minutes
$path = '/lab6';
$domain = 'udchris.minifacebook.com'; // replace with your domain
$secure = true; // cookie should only be sent over secure connections
$httponly = true; // cookie will only be accessible over the HTTP protocol
// Set the session cookie parameters
session_set_cookie_params($lifetime, $path, $domain, $secure, $httponly);
if (!$_SESSION["logged"]) {
echo "<script>alert('You have to login first!');</script>";
session_destroy();
header("Refresh:0; url=registrationform.php");
die();
}
// Prevent session hijacking
if ($_SESSION["browser"] != $_SERVER["HTTP_USER_AGENT"]) {
echo "<script>alert('Session hijacking is detected! Use your own username and
password to log in!');</script>";
session_destroy();
header("Refresh:0; url=registrationform.php");
die();
}
?>
