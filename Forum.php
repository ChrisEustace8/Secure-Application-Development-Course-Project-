<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Forum</title>
<style>
body {
font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
margin: 0;
padding: 0;
background-color: #f2f2f2;
}
.container {
max-width: 800px;
margin: 20px auto;
padding: 20px;
background-color: #fff;
border-radius: 8px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
h1 {
text-align: center;
margin-bottom: 20px;
color: #333;
}
.post {
margin-bottom: 30px;
padding: 20px;
background-color: #fff;
border-radius: 8px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.post-header {
font-size: 20px;
font-weight: bold;
margin-bottom: 10px;
color: #333;
}
.post-content {
margin-bottom: 20px;
color: #555;
}
.comment {
margin-left: 40px;
margin-bottom: 20px;
padding: 10px;
background-color: #f5f5f5;
border-radius: 6px;
}
.comment-content {
margin-bottom: 10px;
color: #666;
}
.form-group {
margin-bottom: 15px;
}
input[type="text"],
textarea {
width: 100%;
padding: 10px;
border: 1px solid #ccc;
border-radius: 4px;
font-size: 16px;
box-sizing: border-box;
}
button[type="submit"] {
padding: 10px 20px;
background-color: #007bff;
color: #fff;
border: none;
border-radius: 4px;
font-size: 16px;
cursor: pointer;
transition: background-color 0.3s ease;
}
button[type="submit"]:hover {
background-color: #0056b3;
}
</style>
</head>
<body>
<div class="container">
<h1>Forum</h1>
<!-- Form to add a new post -->
<form method="post" action="">
<div class="form-group">
<input type="text" name="post_content" placeholder="Type your post here">
</div>
<button type="submit" name="action" value="addpost">Add Post</button>
</form>
<?php
session_start();
// Check if the request is made over HTTPS
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
// Redirect to the HTTPS version page
header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
exit();
}
// Include database functions
require "database.php";
// Check if user is logged in
if(isset($_SESSION['username'])) {
$username = $_SESSION['username'];
// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST['action'])) {
switch($_POST['action']) {
case 'addpost':
$post_content = $_POST['post_content'];
if (addNewPost($username, $post_content)) {
echo "Post added successfully.";
} else {
echo "Error adding post.";
}
break;
case 'editpost':
$post_id = $_POST['post_id'];
$post_content = $_POST['post_content'];
if (editPost($post_id, $post_content)) {
echo "Post edited successfully.";
} else {
echo "Error editing post.";
}
break;
case 'deletepost':
$post_id = $_POST['post_id'];
if (deletePost($post_id)) {
echo "Post deleted successfully.";
} else {
echo "Error deleting post.";
}
break;
case 'editcomment':
$comment_id = $_POST['comment_id'];
$comment_content = $_POST['comment_content'];
if (editComment($comment_id, $comment_content)) {
echo "Comment edited successfully.";
} else {
echo "Error editing comment.";
}
break;
case 'deletecomment':
$comment_id = $_POST['comment_id'];
if (deleteComment($comment_id)) {
echo "Comment deleted successfully.";
} else {
echo "Error deleting comment.";
}
break;
case 'addcomment':
$post_id = $_POST['post_id'];
$username = $_POST['username'];
$comment_content = $_POST['comment_content'];
if (addComment($post_id, $username, $comment_content)) {
echo "Comment added successfully.";
} else {
echo "Error adding comment.";
}
break;
}
}
}
// Display posts created by the user
$user_posts = getPostsByUser($username);
if (!empty($user_posts)) {
foreach ($user_posts as $row) {
echo '<div class="post">';
echo '<div class="post-header">' . htmlspecialchars($row['username']) . '</div>';
echo '<div class="post-content">' . htmlspecialchars($row['post_content']) .
'</div>';
echo '<form method="post" action="">';
echo '<input type="hidden" name="action" value="editpost">';
echo '<input type="hidden" name="post_id" value="' . $row['post_id'] . '">';
echo '<textarea name="post_content" rows="3" placeholder="Edit your post">' .
htmlspecialchars($row['post_content']) . '</textarea>';
echo '<button type="submit">Edit</button>';
echo '</form>';
echo '<form method="post" action="">';
echo '<input type="hidden" name="action" value="deletepost">';
echo '<input type="hidden" name="post_id" value="' . $row['post_id'] . '">';
echo '<button type="submit">Delete</button>';
echo '</form>';
// Display comments for this post
$comments = $conn->query("SELECT * FROM comments WHERE post_id=" .
$row['post_id']);
if ($comments->num_rows > 0) {
while ($comment = $comments->fetch_assoc()) {
echo '<div class="comment">';
echo '<div class="comment-content">' .
htmlspecialchars($comment['username']) . ': ' . htmlspecialchars($comment['comment_content'])
. '</div>';
echo '<form method="post" action="">';
echo '<input type="hidden" name="action" value="editcomment">';
echo '<input type="hidden" name="comment_id" value="' .
$comment['comment_id'] . '">';
echo '<textarea name="comment_content" rows="2" placeholder="Edit
your comment">' . htmlspecialchars($comment['comment_content']) . '</textarea>';
echo '<button type="submit">Edit</button>';
echo '</form>';
echo '<form method="post" action="">';
echo '<input type="hidden" name="action" value="deletecomment">';
echo '<input type="hidden" name="comment_id" value="' .
$comment['comment_id'] . '">';
echo '<button type="submit">Delete</button>';
echo '</form>';
echo '</div>';
}
}
// Form to add a new comment
echo '<form method="post" action="">';
echo '<input type="hidden" name="action" value="addcomment">';
echo '<input type="hidden" name="post_id" value="' . $row['post_id'] . '">';
echo '<div class="form-group">';
echo '<input type="text" name="username" placeholder="Your Name">';
echo '</div>';
echo '<div class="form-group">';
echo '<textarea name="comment_content" rows="2" placeholder="Add a
comment"></textarea>';
echo '</div>';
echo '<button type="submit">Add Comment</button>';
echo '</form>';
echo '</div>';
}
} else {
echo 'No posts available.';
}
} else {
echo 'Please login to view and create posts.';
}
?>
<div style="text-align: center; margin-top: 20px;">
<a href="index.php">Go back</a>
</div>
</div>
</body>
</html>
