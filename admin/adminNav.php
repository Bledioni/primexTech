<?php 

    require_once '../config/config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../pannelInc/style/navBarInc.css">
</head>
<body>

    <div class="nav-container">
        <div class="nav-main-container">
            <div class="dashboardMenu">
                <h1>Primex</h1>
            </div>

            <div class="nav-functions">
                    <button class="button"><i class="fa-solid fa-box"></i> <a class="button" href="../admin/dashboard.php">Dashboard</a></button>
                    <button class="button"><i class="fa-solid fa-box"></i> <a class="button" href="../admin/viewProductsAdmin.php">All Products</a></button>
                    <button class="button"><i class="fa-solid fa-list"></i> <a class="button" href="../admin/addEmployee.php">Add Employee</a></button>
                    <button class="button"><i class="fa-solid fa-list"></i> <a class="button" href="../admin/cuppon.php">Add Cuppon</a></button>
                    <form action="../admin/adminCategories.php" method="GET">
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

            <div class="nav">
                <form action="../auth/logout.php" method="POST">
                    <select name="action" required onchange="this.form.submit()">
                        <option value="" disabled selected><?= $_SESSION['role'] ?></option>
                        <option value="logout">Log Out</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
</body>
</html>