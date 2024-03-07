<?php
include "includes/db.php";
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
    <title>Blog Nest | Articles</title>
</head>

<body>
    <?php include "navbar-admin.php" ?>

    <div id="articles">
        <div class="table-container">
            <h1>List Articles</h1>
            <table>
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th></th>
                </tr>
                <?php
                $itemsPerPage = 10;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $offset = ($page - 1) * $itemsPerPage;

                $sql = "SELECT posts.*, users.username, COUNT(*) OVER() AS total_count FROM posts LEFT JOIN users ON posts.author = users.id LIMIT :limit OFFSET :offset";
                $result = $pdo->prepare($sql);

                $result->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
                $result->bindParam(':offset', $offset, PDO::PARAM_INT);
                $result->execute();

                $items = $result->fetchAll();

                if ($result->rowCount() > 0) {
                    $row_number = 1;
                    foreach ($items as $row) {
                        $totalItems = $row['total_count'];
                        $totalPages = ceil($totalItems / $itemsPerPage);
                ?>
                        <tr>
                            <td>
                                <?php echo $row_number; ?>
                            </td>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id']; ?>">
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
                    echo "Belum ada artikel";
                }
                ?>
            </table>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo '<li class="page-item ';
                        echo ($page == $i) ? 'active' : '';
                        echo '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>

    <div id=" deleteModal" class="modal">
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
    var articleIdToDelete = null;

    function confirmDeletion(articleId) {
        modal.style.display = "block";
        articleIdToDelete = articleId;
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    deleteConfirmBtn.onclick = function() {
        if (articleIdToDelete !== null) {
            window.location.href = `?delete_id=${articleIdToDelete}`;
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