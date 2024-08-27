**Secure Application Development Course Project**

## Description:
This project is a secure miniFacebook web application developed as part of the **CPS 475/575: Secure Application Development** course at the University of Dayton.
This project demonstrates the application of secure programming principles and web development technologies by building a simple yet secure miniFacebook web application. The application allows users to register, log in, post, edit, delete, and comment, all while adhering to key security practices. 

## Features:

User Registration: Anyone can register for an account.

User Aunthentication: Registered users can log in and change their passwords.

Account Management: Users can delete their accounts.

Post Management: Users can add, edit, and delete their own posts.

Commenting: Users can add comments to any post.

Security:
    HTTPS deployment 
    Password hashing
    Use of Prepared Statements for SQL queries
    Input validation at every layer (HTML, PHP, SQL)
    HTML output sanitzation 
    Role-based access control
    Session authenication and prevention of session hijacking 
    CSRF protection

## Description of functions used in files:
dbConnect($dbHost, $dbUser, $dbPass, $dbName): Function to establish a connection
to the database.

checkLoginDatabase($username, $password, $conn): Function to check user login
credentials against the database using prepared statements to prevent SQL injection.
loginFailed(): Function to display an alert message and redirect the user back if login
fails.

changePassword($username, $newpassword): Function to change the password for a
user in the database.

addNewUser($username, $password): Function to add a new user to the database.

addNewPost($username, $post_content): Function to add a new post to the forum.

editPost($post_id, $post_content): Function to edit an existing post in the forum.

deletePost($post_id): Function to delete a post from the forum.

addComment($post_id, $username, $comment_content): Function to add a comment to
a post in the forum.

editComment($comment_id, $comment_content): Function to edit an existing comment
in the forum.

deleteComment($comment_id): Function to delete a comment from the forum.

getPostsByUser($username): Function to retrieve posts created by a specific user from
the database.

## Acknowledgements 
Dr. Zhongmei Yao at the University of Dayton
