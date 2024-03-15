<?php
include "includes/db-connection.php";

if (!isset($_GET['author_id'])) {
    header("Location: index.php");
    exit;
}

$authorID = $_GET['author_id'];

$authorQuery = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$authorQuery->execute([$authorID]);
$author = $authorQuery->fetch(PDO::FETCH_ASSOC);
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
    <title>Blog Nest | Detail Author</title>
</head>

<body>
    <nav>
        <ul>
            <li>
                <h1>
                    <a href="index.php"><span class="fas fa-code" aria-hidden="true"></span> Blog Nest</a>
                </h1>
            </li>
        </ul>
    </nav>
    <div id="detail-author">
        <div class="container">
            <div class="author">
                <div class="author">
                    <div class="author-avatar">
                        <?php
                        $initials = strtoupper(substr($author['first_name'], 0, 1) . substr($author['last_name'], 0, 1));
                        ?>
                        <div class="avatar"><?php echo $initials; ?></div>
                    </div>
                    <div class="author-info">
                        <h1><?php
                            echo $author['first_name'] . " " . $author['last_name'];
                            ?></h1>
                        <p>Username: <?php echo $author['username'] ?></p>
                        <p>Email:<?php echo $author['email'] ?></p>
                        <p>Total posts:
                            <?php
                            $stmt = $pdo->prepare("SELECT COUNT(*) FROM posts WHERE author = ?");
                            $stmt->execute([$authorID]);
                            $totalPosts = $stmt->fetchColumn();
                            echo $totalPosts;
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <section id="articles">
            <?php
            try {
                $sql = "SELECT p.*, u.first_name, u.last_name FROM posts AS p LEFT JOIN users AS u ON p.author = u.id WHERE p.author = ?";

                $stmt = $pdo->prepare($sql);

                $stmt->execute([$authorID]);

                $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $index = 0;

                foreach ($posts as $post) {
                    $index++;

                    $isEven = $index % 2 == 0;

                    $content = strip_tags($post['content']);

                    $readMoreLink = '<a href="view.php?id=' . $post['id'] . '">Read more</a>';
                    $truncatedContent = substr(htmlspecialchars($content), 0, 200) . "..." . $readMoreLink;

            ?>
                    <article class="<?php echo $isEven ? 'reverse' : ''; ?>">
                        <div class="text">
                            <h4>
                                <?php
                                echo 'By ' . htmlspecialchars($post['first_name']) . " " . htmlspecialchars($post['last_name']) . " on " . date('F j, Y', strtotime($post['created_at']));
                                ?>
                            </h4>

                            <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                            <p class="blackbox">
                                <?php echo $truncatedContent; ?>
                            </p>
                            <h4>Topics:</h4>
                            <ul>
                                <?php
                                $stmt = $pdo->prepare("SELECT t.name FROM topics AS t LEFT JOIN post_topics AS pt ON t.id = pt.topic_id WHERE pt.post_id = :post_id");
                                $stmt->execute([':post_id' => $post['id']]);
                                $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($topics as $topic) {
                                    echo "<li>" . htmlspecialchars($topic['name']) . "</li>";
                                }
                                ?>
                            </ul>
                        </div>
                        <?php if (!empty($post['image_path'])) { ?>
                            <img src="<?php echo htmlspecialchars($post['image_path']); ?>" alt="Post Image">
                        <?php } ?>
                    </article>
            <?php
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
        </section>

        <div class="gradient"></div>
        <footer>
            <h2>Blog Nest &middot; Project</h2>
            <p><small>&copy; 2024 Blog Nest. All rights reserved.</small></p>
        </footer>
</body>

</html>