<?php // logout.php
session_start(); // is used to start or resume a session
// The session_start() function ensures that the session is active,
// so that session_destroy() can then effectively remove all session data and end the session
// Destroy the session to log out the user
session_destroy();
echo '<p> You have logged out. You may log in again.</p>';
echo '<a href="registrationform.php">Login again</a>';
exit; // same as exit(); used to terminate the execution of the script
?>
