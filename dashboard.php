<?php
include "includes/db-connection.php";
include "includes/db.php";

$stmt = $pdo->prepare("
    SELECT t.name AS topic_name, COUNT(DISTINCT p.author) AS total_authors
    FROM post_topics pt
    JOIN topics t ON pt.topic_id = t.id
    JOIN posts p ON pt.post_id = p.id
    GROUP BY t.name
");
$stmt->execute();
$topicData = $stmt->fetchAll(PDO::FETCH_ASSOC);

$topicNames = [];
$totalAuthors = [];

foreach ($topicData as $row) {
    $topicNames[] = $row['topic_name'];
    $totalAuthors[] = $row['total_authors'];
}

$topicNamesJson = json_encode($topicNames);
$totalAuthorsJson = json_encode($totalAuthors);

$stmt = $pdo->prepare("
    SELECT COUNT(*) as total_articles, MONTHNAME(created_at) as month FROM posts p GROUP BY month;  
");
$stmt->execute();
$monthlyData = $stmt->fetchAll(PDO::FETCH_ASSOC);

$monthlyLabels = [];
$monthlyTotals = [];

foreach ($monthlyData as $row) {
    $monthlyLabels[] = $row['month'];
    $monthlyTotals[] = $row['total_articles'];
}

$monthlyLabelsJson = json_encode($monthlyLabels);
$monthlyTotalsJson = json_encode($monthlyTotals);
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
    <title>Blog Nest | Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php
    if (isset($_SESSION['role_id'])) {
        $_SESSION['role_id'] == 1 ? include "navbar-admin.php" : include "navbar.php";
    } else {
        include "navbar.php";
    }
    ?>

    <section id="dashboard">
        <h1>Dashboard</h1>
        <div class="dashboard-charts">
            <div class="card">
                <canvas id="authorsTopicsChart" width="600" height="400"></canvas>
            </div>
            <div class="card">
                <canvas id="postsMonthlyChart" width="600" height="400"></canvas>
            </div>
        </div>
    </section>
    <div class="gradient"></div>
    <footer>
        <h2>Blog Nest &middot; Project</h2>
        <p><small>&copy; 2024 Blog Nest. All rights reserved.</small></p>
    </footer>


    <script>
        // Retrieve data from PHP variables
        var topicNames = <?php echo $topicNamesJson; ?>;
        var totalAuthors = <?php echo $totalAuthorsJson; ?>;
        var totalPosts = <?php echo $monthlyTotalsJson; ?>;
        var monthlyLabels = <?php echo $monthlyLabelsJson; ?>;

        // Create Chart.js chart
        var ctx = document.getElementById('authorsTopicsChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: topicNames,
                datasets: [{
                    label: 'Total Authors',
                    data: totalAuthors,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Total Authors per Topic',
                        font: {
                            size: 20,
                        }
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });

        var mtx = document.getElementById('postsMonthlyChart').getContext('2d');
        var postsMonthlyChart = new Chart(mtx, {
            type: 'bar',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Total Posts',
                    data: totalPosts,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Total Posts per Month',
                        font: {
                            size: 20,
                        }
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        })
    </script>
</body>

</html>