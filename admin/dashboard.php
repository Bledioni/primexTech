<?php
require_once '../config/config.php';

// SALES DATA
$query = "
    SELECT 
        DATE(o.created_at) AS date,
        SUM(oi.quantity * oi.price) AS total
    FROM 
        order_items oi
    JOIN 
        orders o ON o.order_id = oi.order_id
    GROUP BY 
        DATE(o.created_at)
    ORDER BY 
        date
";
$stmt = $conn->prepare($query);
$stmt->execute();
$sales = $stmt->fetchAll(PDO::FETCH_ASSOC);

// USERS SIGNUPS DATA
$userQuery = "
    SELECT 
        DATE(created_at) AS date,
        COUNT(*) AS total
    FROM 
        users
    GROUP BY 
        DATE(created_at)
    ORDER BY 
        date
";
$userStmt = $conn->prepare($userQuery);
$userStmt->execute();
$signups = $userStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard Charts</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../display/css/adminDashBoard.css">
</head>
<body>

    <?php require_once '../admin/adminNav.php' ?>
    <?php require_once '../admin/adminStats.php' ?>

    <div class="dashboard-wrapper">
    <div class="dashboard-container">
        <h3>📊 Sales Per Day</h3>
        <canvas id="salesChart"></canvas>
    </div>

    <div class="dashboard-container">
        <h3>👤 New User Sign-Ups Per Day</h3>
        <canvas id="userChart"></canvas>
    </div>
</div>


    <script>
        // Sales Chart
        const sales = <?php echo json_encode($sales); ?>;
        const salesLabels = sales.map(row => row.date);
        const salesData = sales.map(row => row.total);

        const ctxSales = document.getElementById('salesChart').getContext('2d');
        new Chart(ctxSales, {
            type: 'line',
            data: {
                labels: salesLabels,
                datasets: [{
                    label: 'Total Sales (€)',
                    data: salesData,
                    borderColor: '#4CAF50',
                    backgroundColor: 'rgba(76, 175, 80, 0.1)',
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: '#4CAF50',
                    pointRadius: 4
                }];
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            color: '#333',
                            font: {
                                size: 14
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#555' },
                        grid: { color: '#eee' }
                    },
                    x: {
                        ticks: { color: '#555' },
                        grid: { color: '#eee' }
                    }
                }
            }
        });

        // User Sign-Ups Chart
        const signups = <?php echo json_encode($signups); ?>;
        const userLabels = signups.map(row => row.date);
        const userData = signups.map(row => row.total);

        const ctxUsers = document.getElementById('userChart').getContext('2d');
        new Chart(ctxUsers, {
            type: 'bar',
            data: {
                labels: userLabels,
                datasets: [{
                    label: 'New Users',
                    data: userData,
                    backgroundColor: '#DB4444',
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            color: '#333',
                            font: {
                                size: 14
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#555' },
                        grid: { color: '#eee' }
                    },
                    x: {
                        ticks: { color: '#555' },
                        grid: { color: '#eee' }
                    }
                }
            }
        });
    </script>

</body>
</html>
