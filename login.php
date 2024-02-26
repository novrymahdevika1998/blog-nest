<?php
include "includes/db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $username;
            $_SESSION["user_id"] = $row["id"];

            // Update user_role status
            $id = $_SESSION["user_Id"];
            $sql = "UPDATE user_role SET status = ? WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $status = 1;
            $stmt->bind_param("ii", $status, $id);
            $stmt->execute();

            // Redirect to index.php
            header("Location: index.php");
            exit();
        } else {
            $errormsg =  "Password is incorrect";
        }
    } else {
        $errormsg =  "Username is incorrect";
    }

    $stmt->close();
}
$conn->close();
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
    <title>Blog Project</title>
</head>

<body>
    <div class="container">
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <?php
            if (!empty($errormsg)) {
            ?>
                <div class="alert alert-danger mt-1" role="alert">
                    <?php echo $errormsg; ?>
                </div>
            <?php
            }
            ?>
            <button type="submit" class="button" name="register">Login</button>
            <div class="register">
                <a class="register-link" href="register.php">Belum punya akun?</a>
            </div>
        </form>
    </div>
</body>

</html>