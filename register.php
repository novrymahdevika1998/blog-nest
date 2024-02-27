<?php
include "includes/db-connection.php";
if ($_POST) {
    // POST 
    $firstName = $_POST["first-name"];
    $lastName = $_POST["last-name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    if ($firstName != "" && $lastName != "" && $username != "" && $email != "" && $password != "") {
        $sql = "SELECT * FROM users WHERE email=?";
        $query = $pdo->prepare($sql);
        $query->execute(array($email));
        $emailcontrol = $query->rowCount();
        if ($emailcontrol > 0) {
            $errormsg = "Email ini sudah digunakan oleh user lain!";
        } else {
            if (filter_var($email,  FILTER_VALIDATE_EMAIL)) {
                $query = $pdo->prepare("
                    INSERT INTO users SET first_name=?, last_name=?, email=?, username=?, password=?, created_at=?
                    ");
                $add = $query->execute(array($firstName, $lastName, $email, $username, $password, date("Y-m-d")));
                if ($add) {
                    $query = $pdo->prepare("
                        INSERT INTO user_role SET user_id=?, role_id=?
                    ");

                    $user_id = $pdo->lastInsertId();
                    $add = $query->execute(array($user_id, 2));
                    $add = $query->execute(array($user_id, 1));
                    $errormsg = "Akun berhasil dibuat";
                } else {
                    $errormsg = "Akun gagal dibuat";
                }
            } else {
                $errormsg = "Masukkan email yang valid!";
            }
        }
    } else {
        $errormsg = "Isi semua input!";
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
                <input type="text" placeholder="First Name" name="first-name">
            </div>
            <div class="form-group">
                <label for="last-name">Last Name</label>
                <input type="text" placeholder="Last Name" name="last-name">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" placeholder="Username" name="username">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" placeholder="Email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" placeholder="Password" name="password">
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
            <button type="submit" class="button" name="register">Register</button>
            <div class="register">
                <a class="register-link" href="login.php" class="nav-link">Sudah punya akun?</a>
            </div>
        </form>
    </div>
    <div class="gradient"></div>
    <footer>
        <h2>Blog Nest &middot; Project</h2>
        <p><small>&copy; 2024 Blog Nest. All rights reserved.</small></p>
    </footer>
</body>

</html>