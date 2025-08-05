<?php
require_once '../config/config.php';

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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../display/css/adminDashBoard.css">
</head>
<body>

    <?php require_once '../admin/adminNav.php'; ?>

    <?php require_once '../admin/adminStats.php' ?>

    <div class="dashboard-container">
        <h3>📊 Sales Per Day</h3>
        <canvas id="salesChart"></canvas>
    </div>

    <script>
        const sales = <?php echo json_encode($sales); ?>;
        const labels = sales.map(row => row.date);
        const data = sales.map(row => row.total);

        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Sales (€)',
                    data: data,
                    borderColor: '#4CAF50',
                    backgroundColor: 'rgba(76, 175, 80, 0.1)',
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: '#4CAF50',
                    pointRadius: 4
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
                        ticks: {
                            color: '#555'
                        },
                        grid: {
                            color: '#eee'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#555'
                        },
                        grid: {
                            color: '#eee'
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>

