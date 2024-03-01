<?php
// require_once "includes/auth.php";
?>
<nav>
    <ul>
        <li>
            <h1>
                <a href="index.html"><span class="fas fa-code" aria-hidden="true"></span> Blog Nest</a>
            </h1>
        </li>
        <?php if (isset($_SESSION["username"])) { ?>
            <li><a href="home.php">Home</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="create.php">Create</a></li>
        <?php } ?>
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
<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Blog Project</a>
        <div>
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </div>
        </div>
        <form class="form-inline my-2 my-lg-0">
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

                <div class="d-flex flex-row justify-content-center align-items-center gap-4">
                    <div class="form-check form-switch">
                        <input name="switch_role" class="form-check-input" type="checkbox" role="switch" id="adminSwitch" <?php echo $_SESSION['role_id'] == 1 ? 'checked' : '' ?>>
                        <label class="form-check-label" for="adminSwitch">Admin Mode</label>
                    </div>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            <?php
            } else {
            ?>
                <a class="btn btn-primary" href=" login.php">
                    Login
                </a>
            <?php
            }
            ?>
        </form>
    </div>
</nav> -->

<script>
    const adminSwitch = document.getElementById("adminSwitch");

    adminSwitch.addEventListener("change", () => {
        const formData = new FormData()
        formData.append('isAdmin', adminSwitch.checked)
        formData.append('switch_role', true)

        fetch('http://localhost/blog-project/includes/db.php', {
            method: 'post',
            body: formData,
        }).then(function(response) {
            if (response.status >= 200 && response.status < 300) {
                return response.text()
            }

            throw new Error(response.statusText)
        }).then(() => {
            window.location.href = "index.php"
        })
    });
</script>