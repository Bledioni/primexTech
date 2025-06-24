<?php 

    require_once '../config/config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/auth/auth.css">
</head>
<body>
    
     <div class="main-container">

    <img src="../assets/css/auth/photos/image.png" alt="">
    

        <form action="../auth/login.php" method="post">


            <h3>Log in to PrimexTech</h3>
            <p>Enter your details below</p>

            <input type="email" placeholder="Enter Email" name="email" required>

            <input type="password" placeholder="Enter Password" name="password" required>

            <button name="submit">Log in</button>

            <span><p>Dont have an account</p><a href="../auth/register.php">Sign up</a></span>

        </form>

    </div>

</body>
</html>

<?php

    if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit'])){

        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users where email= :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email' , $email);
        $stmt->execute();
        if($stmt->rowCount()> 0){

            $data = $stmt->fetch();
            // var_dump($data);

            if(password_verify($password , $data['password'])){

                echo "Login Succsesfully";

            }

        }


    }

?>