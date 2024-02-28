<?php
include "includes/db.php";
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Oxygen&family=Oxygen+Mono&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/global.style.css">
    <title>Homepage</title>
</head>

<body>
    <?php include "navbar.php" ?>
    <section id="intro">
        <p class="name">Welcome to <span>Blog Nest.</span></p>
        <p>
            A place where you can share your thoughts and ideas with the world.
        </p>
        <a href="login.php" class="button">Get Started</a>
    </section>
    <div class="gradient"></div>
    <div class="section-blue">
        <section id="articles">
            <h2>Article List</h2>
            <form method="GET">
                <label for="filter">Cari berdasarkan:</label>
                <select name="filter" id="filter">
                    <option value="keyword">Kata kunci</option>
                    <option value="newest">Paling baru</option>
                    <option value="oldest">Paling lama</option>
                </select>
                <input type="text" name="keyword" placeholder="Masukkan kata kunci">
                <button type="submit">Terapkan</button>
            </form>
            <?php
            try {
                $sql = "SELECT p.*, u.first_name, u.last_name FROM posts AS p LEFT JOIN users AS u ON p.author = u.id ";

                $orderBy = "";
                $filter = isset($_GET['filter']) ? $_GET['filter'] : "";

                if (!empty($filter)) {
                    switch ($filter) {
                        case 'keyword':
                            $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
                            if (!empty($keyword)) {
                                $sql .= "WHERE p.title LIKE '%$keyword%' OR p.content LIKE '%$keyword%' ";
                            }
                            break;
                        case 'newest':
                            $orderBy = "ORDER BY p.created_at DESC ";
                            break;
                        case 'oldest':
                            $orderBy = "ORDER BY p.created_at ASC ";
                            break;
                        default:
                            $orderBy = "ORDER BY p.created_at DESC ";
                            break;
                    }
                }

                $stmt = $pdo->query($sql . $orderBy);
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
                                <?php echo 'By ' . htmlspecialchars($post['first_name']) . " " . htmlspecialchars($post['last_name']); ?>
                            </h4>
                            <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                            <p class="blackbox">
                                <?php echo $truncatedContent; ?>
                            </p>
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
    </div>
    <div class="gradient"></div>
    <footer>
        <h2>Blog Nest &middot; Project</h2>
        <p><small>&copy; 2024 Blog Nest. All rights reserved.</small></p>
    </footer>
</body>

</html>