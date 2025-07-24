<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../pannelInc/style/navBarInc.css">
</head>
<body>
    <div class="nav">
            <form action="../auth/logout.php" method="POST">
                <select name="action" required onchange="this.form.submit()">
                    <option value="" disabled selected><?= $_SESSION['role'] ?></option>
                    <option value="logout">Log Out</option>
                </select>
            </form>
    </div>
</body>
</html>