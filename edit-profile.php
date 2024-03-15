<?php
include "includes/db-connection.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userID = $_SESSION['user_id'];
$query = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$query->execute([$userID]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found.";
    exit;
}

if ($_POST) {
    $firstName = $_POST["first-name"];
    $lastName = $_POST["last-name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $params = [$firstName, $lastName, $email, $username, $userID];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if ($firstName != "" && $lastName != "" && $username != "" && $email != "" && $password != "") {
        $sql = "UPDATE users SET first_name=?, last_name=?, email=?, username=?, password=? WHERE id=?";
        $query = $pdo->prepare($sql);
        $query->execute([$firstName, $lastName, $email, $username, $hashedPassword, $userID]);
        header("Location: index.php");
        exit;
    } else {
        echo "Isi semua input!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Oxygen&family=Oxygen+Mono&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/global.style.css">
    <title>Blog Nest | Register</title>
</head>

<body>

    <div class="container">
        <form method="POST">
            <div class="form-group">
                <label for="first-name">First Name</label>
                <input type="text" placeholder="First Name" name="first-name" value="<?= htmlspecialchars($user['first_name']) ?>">
            </div>
            <div class="form-group">
                <label for="last-name">Last Name</label>
                <input type="text" placeholder="Last Name" name="last-name" value="<?= htmlspecialchars($user['last_name']) ?>">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" placeholder="Username" name="username" value="<?= htmlspecialchars($user['username']) ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" placeholder="Email" name="email" value="<?= htmlspecialchars($user['email']) ?>">
            </div>
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" placeholder="New Password" name="password">
            </div>
            <button type="submit" class="button">Update Profile</button>
        </form>
    </div>
    <div class="gradient"></div>
    <footer>
        <h2>Blog Nest &middot; Project</h2>
        <p><small>&copy; 2024 Blog Nest. All rights reserved.</small></p>
    </footer>
</body>

</html>