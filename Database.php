<?php
// Database credentials
$dbHost = 'localhost'; // Assuming the database is hosted locally
$dbUser = 'CHRIS'; // Your database username
$dbPass = 'CHRISSECRET'; // Your database password
$dbName = 'secad_team0'; // The name of the database
// Create connection
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
// Function to set new password
function changePassword($username, $newpassword) {
global $conn;
// Using prepared statement to prevent SQL injection
$stmt = $conn->prepare("UPDATE users SET password=md5(?) WHERE
username=?");
$stmt->bind_param("ss", $newpassword, $username);
$flag = $stmt->execute();
return $flag;
}
// Function to add a new user to the database
function addNewUser($username, $password) {
global $conn;
// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?,
md5(?))");
$stmt->bind_param("ss", $username, $password);
$flag = $stmt->execute();
return $flag;
}
// Function to add a new post
function addNewPost($username, $post_content) {
global $conn;
// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO posts (username, post_content) VALUES (?,
?)");
$stmt->bind_param("ss", $username, $post_content);
$flag = $stmt->execute();
return $flag;
}
// Function to edit a post
function editPost($post_id, $post_content) {
global $conn;
// Prepare the SQL statement
$stmt = $conn->prepare("UPDATE posts SET post_content=? WHERE post_id=?");
$stmt->bind_param("si", $post_content, $post_id);
$flag = $stmt->execute();
return $flag;
}
// Function to delete a post
function deletePost($post_id) {
global $conn;
// Prepare the SQL statement
$stmt = $conn->prepare("DELETE FROM posts WHERE post_id=?");
$stmt->bind_param("i", $post_id);
$flag = $stmt->execute();
return $flag;
}
// Function to add a comment on a post
function addComment($post_id, $username, $comment_content) {
global $conn;
// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO comments (post_id, username,
comment_content) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $post_id, $username, $comment_content);
$flag = $stmt->execute();
return $flag;
}
// Function to edit a comment
function editComment($comment_id, $comment_content) {
global $conn;
// Prepare the SQL statement
$stmt = $conn->prepare("UPDATE comments SET comment_content=? WHERE
comment_id=?");
$stmt->bind_param("si", $comment_content, $comment_id);
$flag = $stmt->execute();
return $flag;
}
// Function to delete a comment
function deleteComment($comment_id) {
global $conn;
// Prepare the SQL statement
$stmt = $conn->prepare("DELETE FROM comments WHERE comment_id=?");
$stmt->bind_param("i", $comment_id);
$flag = $stmt->execute();
return $flag;
}
// Function to retrieve posts created by a specific user
function getPostsByUser($username) {
global $conn;
$sql = "SELECT * FROM posts WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
return $result->fetch_all(MYSQLI_ASSOC);
}
?>
