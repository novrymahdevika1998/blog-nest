<nav>
    <ul>
        <li>
            <h1>
                <a href="index.php"><span class="fas fa-code" aria-hidden="true"></span> Blog Nest</a>
            </h1>
        </li>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="articles.php">Articles</a></li>
        <li><a href="authors.php">Authors</a></li>
        <li><a href="edit-profile.php">Edit Profile</a></li>
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