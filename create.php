<?php

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/global.style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <title>Blog Project</title>
</head>

<body>

    <section id="create">
        <h1>Create Blog Post</h1>

        <a onclick="goBack()">
            <span>
                <i class="fas fa-arrow-left"></i>
            </span>
            Kembali
        </a>

        <div class="create-container">
            <form class="create-form" method="POST">
                <input type="text" placeholder="Blog Title" class="form-control my-3 bg-dark text-white text-center" name="title">
                <textarea id="content" name="content" class="form-control my-3 bg-dark text-white" cols="30" rows="10"></textarea>
                <button type="submit" class="button" name="new_post">Add Post</button>
            </form>
        </div>
    </section>


    <script src="https://cdn.tiny.cloud/1/kvcjcn2r2083od4druogzrbn38f4o0osrkac91hsw7mdl7qe/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#content',
            plugins: 'autoresize',
            autoresize_bottom_margin: 16,
        });

        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>