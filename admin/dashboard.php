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
<html>
<head>
    <title>Sales Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <?php require_once '../admin/adminNav.php' ?>

    <h3>Sales Per Day</h3>
    <canvas id="salesChart" width="600" height="300"></canvas>

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
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</body>
</html>

