<?php
include "includes/db.php";
include "includes/db-connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $user_id = $_POST['user_id'];
    $new_role_id = $_POST['new_role_id'];

    // Check if user_id and new_role_id are set and numeric
    if (isset($user_id) && isset($new_role_id) && is_numeric($user_id) && is_numeric($new_role_id)) {
        // Update status in user_role table for the corresponding user and role
        // Set status = 0 for all roles of the user first
        $update_user_role_status_query = "UPDATE user_role SET status = 0 WHERE user_id = :user_id";
        $stmt = $pdo->prepare($update_user_role_status_query);
        $stmt->execute(['user_id' => $user_id]);

        // Then set status = 1 for the selected role
        $update_selected_role_query = "UPDATE user_role SET status = 1 WHERE user_id = :user_id AND role_id = :role_id";
        $stmt = $pdo->prepare($update_selected_role_query);
        $stmt->execute(['user_id' => $user_id, 'role_id' => $new_role_id]);

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
                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row_number = 1;
                    while ($row = $result->fetch_assoc()) {
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
                $conn->close();
                ?>
            </table>
        </div>
    </div>

    <div id="editRoleModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit Author Role</h2>
            <form id="editRoleForm">
                <input type="hidden" id="userId" name="userId">
                <div>
                    <label for="userRole">Select Role:</label>
                    <select id="userRole" name="userRole">
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                    </select>
                </div>
                <button id="editConfirm" type="button">Submit</button>
                <button id="editCancel">Cancel</button>
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
</body>
<script>
    // Get the modal
    var modal = document.getElementById("deleteModal");
    var span = document.getElementsByClassName("close")[0];
    var deleteConfirmBtn = document.getElementById("deleteConfirm");
    var deleteCancelBtn = document.getElementById("deleteCancel");
    var authorIdToDelete = null;

    var editRoleModal = document.getElementById('editRoleModal');
    var userId = document.getElementById('userId').value = userId;
    var currentRoleId = document.getElementById('userRole').value = currentRoleId;
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

    editConfirmBtn.onclick = function() {
        if (authorIdToDelete !== null) {
            window.location.href = `?edit_id=${authorIdToEdit}&role_id=${roleIdToEdit}`;
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