<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="submit">Submit</button>
    </form>
</body>
</html>

<?php

    require_once '../config/config.php';

    if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit'])){

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = 'depoist';

        $hashedPassword = password_hash($password , PASSWORD_DEFAULT);

        $checkEmailQuery = "SELECT * FROM users WHERE email = :email";

        $checkEmailStmt = $conn->prepare($checkEmailQuery);
        $checkEmailStmt->bindParam(':email' , $email);

        $checkEmailStmt->execute();

        if($checkEmailStmt->rowCount() > 0){

            echo "This user exists";

        

        }else{

            $query = "INSERT INTO users(firstname , lastname , email ,password , role)
        VALUES (:first_name , :last_name , :email , :password , :role)";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':first_name' , $first_name);
        $stmt->bindParam(':last_name' , $last_name);
        $stmt->bindParam(':email' , $email);
        $stmt->bindParam(':password' , $hashedPassword);
        $stmt->bindParam(':role' , $role);

        $stmt->execute();

        }

        }else{



        }

?>