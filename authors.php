<?php
include "includes/db.php";
include "includes/db-connection.php";

if (isset($_GET['new_role_id'])) {
    $new_role_id = $_GET['new_role_id'];
    $user_id = $_GET['user_id'];
    echo '<pre>';
    print_r($new_role_id);
    echo '</pre>';
    die();


    if (isset($user_id) && isset($new_role_id) && is_numeric($user_id) && is_numeric($new_role_id)) {

        $sql = "UPDATE users SET role_id = :role_id WHERE id = :user_id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':role_id', $new_role_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        // Redirect to a page after successful role update
        header("Location: users_list.php");
        exit();
    } else {
        // Handle invalid input
        echo "Invalid user ID or role ID.";
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
    <title>Blog Nest | Authors</title>
</head>

<body>
    <?php include "navbar-admin.php" ?>

    <div id="authors">
        <div class="table-container">
            <h1>List Authors</h1>
            <table>
                <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th></th>
                </tr>
                <?php
                $itemsPerPage = 5;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $offset = ($page - 1) * $itemsPerPage;

                $sql = "SELECT *, COUNT(*) OVER() AS total_count FROM users LIMIT :limit OFFSET :offset";
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
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['role_id']; ?></td>
                            <td>
                                <a id="edit-modal" onclick="confirmEdit(<?php echo $row['id']; ?>, <?php echo $row['role_id']; ?>)">
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

    <div id="editRoleModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit Author Role</h2>
            <form id="editRoleForm">
                <div>
                    <label for="new_role_id">Select Role:</label>
                    <select id="new_role_id" name="new_role_id">
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                    </select>
                </div>
                <div class="modal-form-action">
                    <button id="editConfirm" type="submit">Submit</button>
                    <button id="editCancel">Cancel</button>
                </div>
            </form>
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
    <div class="gradient"></div>
    <footer>
        <h2>Blog Nest &middot; Project</h2>
        <p><small>&copy; 2024 Blog Nest. All rights reserved.</small></p>
    </footer>
</body>
<script>
    // Get the modal
    var modal = document.getElementById("deleteModal");
    var span = document.getElementsByClassName("close")[0];
    var deleteConfirmBtn = document.getElementById("deleteConfirm");
    var deleteCancelBtn = document.getElementById("deleteCancel");
    var authorIdToDelete = null;

    var editRoleModal = document.getElementById('editRoleModal');
    var editConfirmBtn = document.getElementById('editConfirm');
    var editCancelBtn = document.getElementById('editCancel');
    var authorIdToEdit = null;
    var roleIdToEdit = null;

    for (var i = 0; i < span.length; i++) {
        span[i].onclick = function() {
            if (this.parentElement.parentElement.id === "editRoleModal") {
                editRoleModal.style.display = "none";
            } else if (this.parentElement.parentElement.id === "deleteModal") {
                deleteModal.style.display = "none";
            }
        }
    }

    function confirmDeletion(authorId) {
        modal.style.display = "block";
        authorIdToDelete = authorId;
    }

    function confirmEdit(authorId, roleId) {
        editRoleModal.style.display = "block";
        authorIdToEdit = authorId;
        roleIdToEdit = roleId;
    }

    deleteConfirmBtn.onclick = function() {
        if (authorIdToDelete !== null) {
            window.location.href = `?delete_id=${authorIdToDelete}`;
        }
    }

    editConfirmBtn.onclick = function(event) {
        event.preventDefault(); // Prevent the default form submission behavior

        var selectedRoleId = document.getElementById('new_role_id').value;

        if (authorIdToEdit !== null && selectedRoleId !== null) {
            window.location.href = `?user_id=${authorIdToEdit}&role_id=${selectedRoleId}`;
        }
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        } else if (event.target == editRoleModal) {
            editRoleModal.style.display = "none";
        }
    }

    deleteCancelBtn.onclick = function() {
        modal.style.display = "none";
    }

    editCancelBtn.onclick = function() {
        editRoleModal.style.display = "none";
    }
</script>

</html>