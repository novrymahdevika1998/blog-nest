<?php
include "includes/db-connection.php";

if (!isset($_SESSION)) {
    session_start();
}
// Don't display server errors 
ini_set("display_errors", "off");

// Initialize a database connection
$conn = mysqli_connect("localhost", "root", "", "blogprojectdb");

if (!$conn) {
    echo "<h3 class='container bg-dark p-3 text-center text-warning rounded-lg mt-5'>Not able to establish Database Connection<h3>";
}

// Delete users

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $query = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($query);
    echo '<pre>';
    print_r($pdo->prepare($query));
    echo '</pre>';
    die();
    try {
        $stmt->execute(['id' => $id]);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

// Update User Role

if (isset($_REQUEST['switch_role'])) {
    $isAdmin = $_REQUEST['isAdmin'];
    $userId = $_SESSION['user_id'];
    $role = $isAdmin === 'true' ? 1 : 2;
    echo $role;
    $_SESSION['role_id'] = $role;
}


// Get posts
$sql = "SELECT * FROM posts";
$query = mysqli_query($conn, $sql);

// Create a new post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $author = $_SESSION['id'];

    $sql = "INSERT INTO posts (title, content, author) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $title, $content, $author);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Blog post created successfully!";
    } else {
        echo "Error creating blog post.";
    }


    header("Location: index.php?info=added");

    $stmt->close();
    $conn->close();
}
// if (isset($_REQUEST['new_post'])) {
//     $title = $_REQUEST['title'];
//     $content = $_REQUEST['content'];
//     $author = $_SESSION['id'];

//     $sql = "INSERT INTO posts(title, content, author) VALUES('$title', '$content', '$author')";
//     mysqli_query($conn, $sql);

//     echo $sql;

//     header("Location: index.php?info=added");
//     exit();
// }

// Get a post
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $sql = "SELECT * FROM posts WHERE id = $id";
    $query = mysqli_query($conn, $sql);
}

// Delete a post
if (isset($_REQUEST['delete'])) {
    $id = $_REQUEST['id'];

    $sql = "DELETE FROM posts WHERE id = $id";
    mysqli_query($conn, $sql);

    header("Location: index.php");
    exit();
}

// Update a post
if (isset($_REQUEST['update'])) {
    $id = $_REQUEST['id'];
    $title = $_REQUEST['title'];
    $content = $_REQUEST['content'];
    $author = $_SESSION['user_id'];

    $sql = "UPDATE posts SET title = '$title', content = '$content', author = '$author' WHERE id = $id";
    mysqli_query($conn, $sql);

    header("Location: index.php");
    exit();
}

// Delete Authors
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM users WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->execute(['id' => $id]);

    header("Location: authors.php");
    exit();
}
