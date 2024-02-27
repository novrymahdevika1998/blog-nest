<?php
include 'includes/auth.php';
include 'includes/db.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Oxygen&family=Oxygen+Mono&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/global.style.css">
    <title>Blog Project</title>
</head>

<body>
    <?php include "navbar.php" ?>
    <div class="container mt-5">

        <!-- Display any info -->
        <?php if (isset($_REQUEST['info'])) { ?>
            <?php if ($_REQUEST['info'] == "added") { ?>
                <div class="alert alert-success" role="alert">
                    Post has been added successfully
                </div>
            <?php } ?>
        <?php } ?>

        <?php if ($_SESSION['role_id'] === 1) : ?>
            <h2>LU ADMIN BANG</h2>
        <?php endif; ?>

        <!-- Create a new Post button -->
        <div class="text-center">
            <a href="create.php">
                <button class="btn btn-outline-dark">+ Create a new post</button>
            </a>
        </div>

        <!-- Display posts from database -->
        <div class="row">
            <?php foreach ($query as $q) { ?>
                <div class="col-12 col-lg-4 d-flex justify-content-center">
                    <div class="card text-white bg-dark mt-5" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $q['title']; ?></h5>
                            <p class="card-text"><?php echo substr($q['content'], 0, 50); ?>...</p>
                            <a href="view.php?id=<?php echo $q['id'] ?>" class="btn btn-light">Read More <span class="text-danger">&rarr;</span></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>
    <div class="gradient"></div>
    <footer>
        <h2>Blog Nest &middot; Project</h2>
        <p><small>&copy; 2024 Blog Nest. All rights reserved.</small></p>
    </footer>

</body>

</html>