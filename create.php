<?php
include "includes/db.php";

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
            <form class="create-form" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" placeholder="Blog Title" class="form-control my-3 bg-dark text-white text-center" name="title">
                </div>
                <div class="input-file-container">
                    <label for="image-upload">Pilih gambar</label>
                    <input id="image-upload" type="file" name="image" accept="image/*">
                </div>
                <div id="image-preview"></div>
                <textarea id="content" name="content" class="form-control my-3 bg-dark text-white" cols="30" rows="10"></textarea>

                <div class="form-group">
                    <label for="topic">Select Topic</label>
                    <select id="topics" name="topic" class="form-control">
                        <option value="1">Technology</option>
                        <option value="2">Lifestyle</option>
                        <option value="3">Health</option>
                        <option value="4">Education</option>
                        <option value="5">Finance</option>
                        <option value="6">Travel</option>
                        <option value="7">Food</option>
                        <option value="8">Entertainment</option>
                        <option value="9">Sports</option>
                        <option value="10">Science</option>
                    </select>
                </div>
                <input type="hidden" name="is_published" value="true">
                <button type="submit" class="button">Add Post</button>
            </form>
        </div>
    </section>

    <!-- tinymce Javascript -->
    <script src="https://cdn.tiny.cloud/1/kvcjcn2r2083od4druogzrbn38f4o0osrkac91hsw7mdl7qe/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Additional script -->
    <script>
        tinymce.init({
            selector: '#content',
        });

        function goBack() {
            window.history.back();
        }

        document.getElementById('image-upload').addEventListener('change', function() {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    var imgElement = document.createElement('img');
                    imgElement.setAttribute('src', event.target.result);
                    imgElement.setAttribute('alt', 'Preview');
                    imgElement.setAttribute('class', 'preview-image');
                    document.getElementById('image-preview').innerHTML = '';
                    document.getElementById('image-preview').appendChild(imgElement);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>