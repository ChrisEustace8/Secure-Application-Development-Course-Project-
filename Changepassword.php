<?php
require "session_auth.php";
require "database.php";
/*
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// $username = $_POST['username'];
$username = $_SESSION["username"];
$newpassword = $_POST['newpassword'];
$nocsrftoken = $_POST['nocsrftoken'];
if (!isset($nocsrftoken) or ($nocsrftoken != $_SESSION['nocsrftoken'])) {
echo "<script>alert('Cross-site request forgery is detected!');</script>";
header("Refresh:0; url=logout.php");
die();
}
if (changepassword($username, $newpassword)) {
echo "<h4> The new password has been set for " . htmlentities($username) . ".</h4>";
echo '<a href="logout.php">Log out</a>';
} else {
echo "<h4> Error: Cannot change the password.</h4>";
}
} else {
// Show login form or redirect to login page
echo "<h4> You have to log in first in order to change your password.</h4>";
echo '<a href="form.php">Please log in</a>';
die();
}
*/
$username = $_SESSION["username"];
$newpassword = $_REQUEST['newpassword'];
$nocsrftoken = $_POST['nocsrftoken'];
if (!isset($nocsrftoken) or ($nocsrftoken != $_SESSION['nocsrftoken'])) {
echo "<script>alert('Cross-site request forgery is detected!');</script>";
header("Refresh:0; url=logout.php");
die();
}
if (isset($username) AND isset($newpassword)) {
if (changepassword($username, $newpassword)) {
echo "<h4> The new password has been set for " . htmlentities($username) . ".</h4>";
echo '<a href="logout.php">Log out</a>';
} else {
echo "<h4> Error: Cannot change the password.</h4>";
}
} else {
// Show login form or redirect to login page
echo "<h4> You have to log in first in order to change your password.</h4>";
echo '<a href="registrationform.php">Please log in</a>';
die();
}
?>
