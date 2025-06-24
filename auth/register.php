<?php

// Include the database configuration file to establish a PDO connection
require_once '../config/config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="../assets/css/auth/auth.css">
</head>
<body>

    <!-- Registration Form -->
    <div class="main-container">

    <img src="../assets/css/auth/photos/image.png" alt="">
    

        <form action="../auth/register.php" method="post">

            <h3>Create an account</h3>
            <p>Enter your details below</p>

            <input type="text" placeholder="Enter First Name" name="firstname" required>

            <input type="text" placeholder="Enter Last Name" name="lastname" required>

            <input type="email" placeholder="Enter Email" name="email" required>

            <input type="password" placeholder="Enter Password" name="password" required>

            <button name="submit" >Submit</button>

            <span><p>Already have an account</p><a href="../auth/login.php">Log in</a></span>

        </form>

    </div>

</body>
</html>

<?php
// Check if form is submitted via POST method and the submit button is clicked
if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit'])){

    // Retrieve and store form inputs
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password before saving to database
    $hashedPassword = password_hash($password , PASSWORD_DEFAULT);

    // Set default role for new users
    $role = 'user';

    // Validate that none of the required fields are empty
    if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($hashedPassword)){

        // Prepare SQL query to insert new user data safely using named parameters
        $query = "INSERT INTO users (firstname , lastname , email , password , role) VALUES (:firstname , :lastname , :email , :password , :role)";
        $stmt = $conn->prepare($query);

        // Bind PHP variables to the named parameters in SQL query
        $stmt->bindParam(':firstname' , $firstname);
        $stmt->bindParam(':lastname' , $lastname);
        $stmt->bindParam(':email' , $email);
        $stmt->bindParam(':password' , $hashedPassword);
        $stmt->bindParam(':role' , $role);

        try {
            // Check if the email already exists in the database to avoid duplicate users
            $checkEmailQuery = "SELECT email FROM users WHERE email = :email";
            $checkEmailStmt = $conn->prepare($checkEmailQuery);
            $checkEmailStmt->bindParam(":email", $email);
            $checkEmailStmt->execute();

            if($checkEmailStmt->rowCount() > 0){
                // If email exists, notify user and redirect back to registration form
                echo "User already exists";
                header("refresh: 2; url=../auth/register.php");
            } else {
                // Execute the insert query to register the new user
                $stmt->execute();
                echo "Registration successful!";
                header("refresh: 2; url=../auth/login.php"); // Redirect to login page after success
            }

        } catch(Exception $e){
            // Catch and display any errors during database operations
            echo "Error: " . $e->getMessage();
        }

    } else {
        // If required fields are missing, show error and redirect back to form
        echo "Please fill all the fields";
        header("refresh: 2; url=../auth/register.php");
    }
}
?>
