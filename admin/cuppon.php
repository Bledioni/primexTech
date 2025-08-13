<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Coupon</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 320px;
            text-align: center;
        }

        .form-container h4 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-container input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #DB4444;
            color: #fff;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container button:hover {
            background-color: #DB4444;
        }
    </style>
</head>
<body>

    <?php require_once '../admin/adminNav.php' ?>

    <div class="form-container">
        <form action="" method="POST">
            <h4>Add Coupon Code</h4>
            <input name="discount" type="number" required placeholder="Discount (%)">
            <button name="submit" type="submit">Add</button>
        </form>
    </div>

</body>
</html>

<?php
include_once '../config/config.php';

if(isset($_POST['submit'])){
    $discount = $_POST['discount'];

    function generateRandomCode($length = 12) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomCode = '';
        for ($i = 0; $i < $length; $i++) {
            $randomCode .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomCode;
    }

    $cuppon_code = generateRandomCode();

    $query = "INSERT INTO cuppon (discount , cuppon_code) VALUES (:discount , :cuppon_code)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':discount', $discount);
    $stmt->bindParam(':cuppon_code', $cuppon_code);
    $stmt->execute();
}
?>
