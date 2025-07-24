<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../pannelInc/style/dashboard.css">
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

</head>
<body>


    <div class="dashboardMenu">
        <h1>Primex</h1>
        <button class="button"><i class="fa-solid fa-box"></i> <a class="button" href="../pannelInc/viewProductsInc.php">All Products</a></button>
        <button class="button"><i class="fa-solid fa-list"></i> <a class="button" href="../pannelInc/depoistOrdersInc.php">Orders List</a></button>
        <h3>Categories</h3>
        <form action="../pannelInc/categoriesInc.php" method="GET">
            <select name="category" id="category" required onchange="this.form.submit()">
                <option value="" disabled selected>Select a category</option>
                <option value="Computer">Computer</option>
                <option value="Gaming">Gaming</option>
                <option value="Camera">Camera</option>
                <option value="HeadPhones">HeadPhones</option>
                <option value="Phones">Phones</option>
                <option value="SmartWatch">SmartWatch</option>
            </select>
        </form>
    </div>

</body>
</html>