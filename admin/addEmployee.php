<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../display/css/adminAddEmployee.css">
</head>
<body>

    <?php include_once '../admin/adminNav.php'; ?>

    <div class="form-container">
        <form action="" method="POST">
            <input name="firstname" type="text" required placeholder="First Name">
            <input name="lastname" type="text" required placeholder="Last Name">
            <input name="email" type="email" required placeholder="Email">
            <input name="password" type="password" required  placeholder="Password">
            <button name="submit" type="submit">Add Employee</button>
        </form>
    </div>

</body>
</html>


<?php

    require_once '../config/config.php';

    if(isset($_POST['submit'])){

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashedPassword = password_hash($password , PASSWORD_DEFAULT);
        $role = 'depoist';

        $query = "INSERT INTO users(firstname , lastname , email , password , role)
        VALUES(:firstname , :lastname , :email , :password , :role)";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':firstname' , $firstname);
        $stmt->bindParam(':lastname' , $lastname);
        $stmt->bindParam(':email' , $email);
        $stmt->bindParam(':password' , $hashedPassword);
        $stmt->bindParam(':role' , $role);

        if($stmt->execute()){

            header('refresh:0; url=../admin/adminNav.php');

        }

        else{

            echo "Something Went Wrong";

        }

    }

?>