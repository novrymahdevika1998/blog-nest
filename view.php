<?php

include "includes/db-connection.php";

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
    <title>Blog Nest</title>
</head>

<body>
    <nav>
        <ul>
            <li>
                <h1>
                    <a href="home.php"><span class="fas fa-code" aria-hidden="true"></span> Blog Nest</a>
                </h1>
            </li>
        </ul>
    </nav>

    <div id="detail">
        <?php
        try {
            $postId = $_GET['id'];
            $stmt = $pdo->prepare("SELECT p.*, u.first_name, u.last_name FROM posts AS p LEFT JOIN users AS u ON p.author=u.id WHERE p.id = :id");
            $stmt->execute([':id' => $postId]);
            $post = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($post) {
        ?>
                <div class="post-detail">
                    <h1 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h1>
                    <p class="post-caption">By <?php echo htmlspecialchars($post['first_name']) . " " . htmlspecialchars($post['last_name']); ?></p>
                    <?php if (!empty($post['image_path'])) { ?>
                        <img class="post-image" src="<?php echo htmlspecialchars($post['image_path']); ?>" alt="Post Image">
                    <?php } ?>
                    <?php echo $post['content']; ?>
                </div>
            <?php } else { ?>
                <p>Post not found.</p>
        <?php
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </div>
    <div class="gradient"></div>
    <footer>
        <h2>Blog Nest &middot; Project</h2>
        <p><small>&copy; 2024 Blog Nest. All rights reserved.</small></p>
    </footer>
</body>

</html>