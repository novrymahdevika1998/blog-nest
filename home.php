<?php
include "includes/db.php"
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
            <article>
                <div class="text">
                    <h4>Article #1</h4>
                    <h3>Wall of Wonder</h3>
                    <p class="blackbox">
                        Description of the project. This should be fairly concise while
                        also describing the key components that you developed or worked
                        on. It can be as long as you need it to be but should at least be
                        a few sentences long. Be sure to include specific links anywhere
                        in the description. A link looks like
                        <a href="https://frontendmasters.github.io/grid-flexbox-v2/">this</a>, and multiple links look <a href="#">like this</a> and
                        <a href="#">like this</a>.
                    </p>
                </div>
                <img src="https://assets.codepen.io/296057/fem-gettingstartedcss-ch5-1.png" alt="Screenshot of the Wall of Wonder." />
            </article>
            <article class="reverse">
                <div class="text">
                    <h4>Article #2</h4>
                    <h3>Feed-A-Star-Mole Game</h3>
                    <p class="blackbox">
                        Description of the project. This should be fairly concise while
                        also describing the key components that you developed or worked
                        on. It can be as long as you need it to be but should at least be
                        a few sentences long. Be sure to include specific links anywhere
                        in the description. A link looks like
                        <a href="https://frontendmasters.github.io/bootcamp/mole">this</a>, and multiple links look <a href="#">like this</a> and
                        <a href="#">like this</a>.
                    </p>
                </div>
                <img src="https://assets.codepen.io/296057/fem-gettingstartedcss-ch5-5.png" alt="Screenshot of the Frontend Masters Bootcamp." />
            </article>
            <article>
                <div class="text">
                    <h4>Article #3</h4>
                    <h3>Wall of Wonder Collection</h3>
                    <p class="blackbox">
                        Description of the project. This should be fairly concise while
                        also describing the key components that you developed or worked
                        on. It can be as long as you need it to be but should at least be
                        a few sentences long. Be sure to include specific links anywhere
                        in the description. A link looks like
                        <a href="https://frontendmasters.github.io/grid-flexbox-v2/grid-figure-figcaption">this</a>, and multiple links look <a href="#">like this</a> and
                        <a href="#">like this</a>.
                    </p>
                </div>
                <img src="https://assets.codepen.io/296057/fem-gettingstartedcss-ch5-4.png" alt="Screenshot of the Wall of Wonder Collections." />
            </article>
        </section>
    </div>
    <div class="gradient"></div>
</body>

</html>