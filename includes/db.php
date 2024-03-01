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

// Delete article

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $query = "DELETE FROM posts WHERE id = :id";
    $stmt = $pdo->prepare($query);
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
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $author = $_SESSION['user_id'];
    $isPublished = isset($_POST['is_published']) && $_POST['is_published'] ? true : false;
    $imagePath = '';

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $uploadPath = "uploads/";
        $fileName = $_FILES['image']['name'];
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileType = $_FILES['image']['type'];
        $fileExtension = strtolower(end(explode('.', $fileName)));

        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $destination = $uploadPath . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destination)) {
                $imagePath = $destination;
            } else {
                echo "Error uploading the file.";
            }
        } else {
            echo "Unsupported file extension.";
        }
    }

    if ($title && $content) {
        try {
            $stmt = $pdo->prepare("INSERT INTO posts (title, content, author, image_path, is_published) VALUES (:title, :content, :author, :image_path, :is_published)");
            $stmt->execute([
                ':title' => $title,
                ':content' => $content,
                ':author' => $author,
                ':image_path' => $imagePath,
                ':is_published' => $isPublished,
            ]);

            echo "Post added successfully!";
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    } else {
        // Handle error - required fields missing
        echo "Required fields are missing.";
    }

    header("Location: home.php?info=added");
}

// Get a post
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $sql = "SELECT * FROM posts WHERE id = $id";
    $query = mysqli_query($conn, $sql);
}

// Update a post
if (isset($_REQUEST['update'])) {
    $id = $_REQUEST['id'];
    $title = $_REQUEST['title'];
    $content = $_REQUEST['content'];
    $author = $_SESSION['user_id'];

    $sql = "UPDATE posts SET title = '$title', content = '$content', author = '$author' WHERE id = $id";
    mysqli_query($conn, $sql);

    header("Location: home.php");
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
