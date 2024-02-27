<?php
include "includes/db.php";
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
    <title>Blog Nest | Articles</title>
</head>

<body>
    <nav>
        <ul>
            <li>
                <h1>
                    <a href="index.html"><span class="fas fa-code" aria-hidden="true"></span> Blog Nest</a>
                </h1>
            </li>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Articles</a></li>
            <li><a href="authors.php">Authors</a></li>
            <li>
                <?php
                if (isset($_SESSION["username"])) {
                    if ($role == "1") {
                ?>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                Admin Panel
                            </a>
                            <div class="dropdown-menu">
                                <a class="drobpdown-item" href="blog/addblog.php">Add Text</a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <a class="button" href="logout.php">Logout</a>
                <?php
                } else {
                ?>
                    <a class="button" href="login.php">
                        Login
                    </a>
                <?php
                }
                ?>
            </li>
        </ul>
    </nav>

    <div id="articles">
        <div class="table-container">
            <h1>List Articles</h1>
            <table>
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Author</th>
                    <th></th>
                </tr>
                <?php
                $sql = "SELECT * FROM posts LEFT JOIN users ON posts.author = users.id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row_number = 1;
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td>
                                <?php echo $row_number; ?>
                            </td>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['content']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td>
                                <a href="edit_author.php?id=<?php echo $row['id']; ?>">
                                    <span class="fas fa-edit" aria-hidden="true"></span>
                                </a>
                                <a id="delete-modal" onclick="confirmDeletion(<?php echo $row['id']; ?>)">
                                    <span class="fas fa-trash" aria-hidden="true"></span>
                                </a>
                            </td>
                        </tr>
                <?php
                        $row_number++;
                    }
                } else {
                    echo "Belum ada penulis";
                }
                $conn->close();
                ?>
            </table>
        </div>
    </div>

    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Apakah anda yakin akan menghapus penulis ini?</p>
            <button id="deleteConfirm">Yes, delete</button>
            <button id="deleteCancel">Cancel</button>
        </div>
    </div>
</body>
<script>
    // Get the modal
    var modal = document.getElementById("deleteModal");
    var span = document.getElementsByClassName("close")[0];
    var deleteConfirmBtn = document.getElementById("deleteConfirm");
    var deleteCancelBtn = document.getElementById("deleteCancel");
    var authorIdToDelete = null;

    function confirmDeletion(authorId) {
        modal.style.display = "block";
        authorIdToDelete = authorId;
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    deleteConfirmBtn.onclick = function() {
        if (authorIdToDelete !== null) {
            window.location.href = `?delete_id=${authorIdToDelete}`;
        }
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    deleteCancelBtn.onclick = function() {
        modal.style.display = "none";
    }
</script>

</html>