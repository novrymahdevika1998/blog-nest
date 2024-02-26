<?php
include "includes/db.php";


if ($_POST) {
    // POST 
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    if ($username != "" && $email != "" && $password != "") {
        $query = $db->prepare("SELECT * FROM users WHERE email=?");
        $query->execute(array($email));
        $emailcontrol = $query->rowCount();
        if ($emailcontrol > 0) {
            $errormsg = "Email ini sudah digunakan oleh user lain!";
        } else {
            if (filter_var($email,  FILTER_VALIDATE_EMAIL)) {
                $query = $db->prepare("
                    INSERT INTO users SET email=?, username=?, password=?, created_at=?
                    ");
                $add = $query->execute(array($email, $username, $password, date("Y-m-d")));
                if ($add) {
                    $query = $db->prepare("
                        INSERT INTO user_role SET user_id=?, role_id=?
                    ");

                    $user_id = $db->lastInsertId();
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Blog Project</title>
</head>

<body>

    <div class="container mt-5">
        <form method="POST">
            <input type="text" placeholder="Username" class="form-control my-3 bg-dark text-white text-center" name="username">
            <input type="email" placeholder="Email" class="form-control my-3 bg-dark text-white text-center" name="email">
            <input type="password" placeholder="Password" class="form-control my-3 bg-dark text-white text-center" name="password">
            <?php
            if (!empty($errormsg)) {
            ?>
                <div class="alert alert-danger mt-1" role="alert">
                    <?php echo $errormsg; ?>
                </div>
            <?php
            }
            ?>
            <a href="login.php" class="nav-link">Sudah punya akun?</a>
            <button class="btn btn-dark" name="register">Register</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>

</html>