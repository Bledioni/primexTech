
<?php

    require_once '../config/config.php';
    if(!isset($_SESSION['role'])){

        header("refresh: 0;url=../auth/login.php");
        die("");

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1><?php echo 'Welcome' .$_SESSION['firstname']?></h1>
<?php

    include_once '../inc/adminInc.php';

?>

    
</body>
</html>