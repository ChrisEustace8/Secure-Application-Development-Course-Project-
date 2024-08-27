<?php
// Database credentials
$dbHost = 'localhost';
$dbUser = 'CHRIS';
$dbPass = 'CHRISSECRET';
$dbName = 'secad_team0';
// Function to connect to the database
function dbConnect($dbHost, $dbUser, $dbPass, $dbName) {
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
exit("Connection failed: " . $conn->connect_error);
}
return $conn;
}
// Function to check login credentials
function checkLoginDatabase($username, $password, $conn) {
// Using prepared statement to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND
password=md5(?)");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
return TRUE;
}
return FALSE;
}
// This function will output the JavaScript for the alert and redirection.
function loginFailed() {
echo "<script type='text/javascript'>
alert('Login failed. Incorrect username or password.');
window.history.back();
</script>";
}
// Set a variable for each parameter
$lifetime = 10 * 60; // 10 minutes
$path = '/lab6';
$domain = 'udchris.minifacebook.com'; // replace with your domain
$secure = true; // cookie should only be sent over secure connections
$httponly = true; // cookie will only be accessible over the HTTP protocol
// Set the session cookie parameters
session_set_cookie_params($lifetime, $path, $domain, $secure, $httponly);
session_start();
// Check if the request is made over HTTPS
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
// Redirect to the HTTPS page
header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$username = $_POST['username'];
$password = $_POST['password'];
$conn = dbConnect($dbHost, $dbUser, $dbPass, $dbName);
if (checkLoginDatabase($username, $password, $conn)) {
$_SESSION['username'] = $username;
$_SESSION["logged"] = TRUE;
$_SESSION["browser"] = $_SERVER["HTTP_USER_AGENT"];
echo '<h2>Login successful! Welcome, ' . htmlspecialchars($username) . '.</h2>';
echo '<a href="changepasswordform.php">Change password</a><br><br>';
echo '<a href="logout.php">Logout</a><br><br>';
echo '<a href="forum.php">Create a post</a>';
exit(); // Exit after displaying the login success message and links
} else {
loginFailed();
unset($_SESSION["logged"]);
}
$conn->close();
}
// a user may load index.php again: Check if the user is already logged in
else if ($_SESSION["logged"]){
if($_SESSION["browser"] != $_SERVER["HTTP_USER_AGENT"]){
echo "<script>alert('Session hijacking is detected! Use your own username and password
to log in!');</script>";
header("Refresh:0; url=registrationform.php");
die();
} else {
echo '<h2>Welcome back, ' . htmlspecialchars($_SESSION['username']) . '.</h2>';
echo '<a href="changepasswordform.php">Change password</a><br><br>';
echo '<a href="logout.php">Logout</a><br><br>';
echo '<a href="forum.php">Create a post</a>';
}
}
// user hasn’t submitted login form, nor has been logged in
else{
// Show login form or redirect to login page
echo '<a href="registrationform.php">Please log in</a>';
die();
}
?>
