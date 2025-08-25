<?php
require_once '../config/config.php';

$search = '';
$limit = 15;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

if (isset($_GET['query'])) {
    $search = trim($_GET['query']);
    $stmt = $conn->prepare("SELECT COUNT(*) FROM products WHERE name LIKE :search");
    $stmt->execute(['search' => "%$search%"]);
    $total = $stmt->fetchColumn();

    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE :search LIMIT :start, :limit");
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
    $stmt->bindValue(':start', $start, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
} else {
    $stmt = $conn->query("SELECT COUNT(*) FROM products");
    $total = $stmt->fetchColumn();

    $stmt = $conn->prepare("SELECT * FROM products LIMIT :start, :limit");
    $stmt->bindValue(':start', $start, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
}

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalPages = ceil($total / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../display/css/searchInc.css">
</head>
<body>

    <?php
    
        include_once '../inc/dashBoradNavInc.php';

    ?>

   <div class="product-box-container">
<?php foreach ($products as $product): ?>
    <a href="../inc/product.php?product_id=<?= $product['product_id']?>">
        <div class="product-box">
        <img src="../uploads/<?= htmlspecialchars($product['image_path']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
        <h4><?= htmlspecialchars($product['name']) ?></h4>
        <p><?= htmlspecialchars($product['price']) ?>€</p>
    </div>
    </a>
<?php endforeach; ?>
</div>

<div class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?<?php 
            $params = $_GET;
            $params['page'] = $i;
            echo http_build_query($params); 
        ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
    <?php endfor; ?>
</div>


</body>
</html>
