<?php
    require_once '../load.php';
    confirm_logged_in();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome <?php echo $_SESSION['user_name'];?>!</h2>
    <!-- Sessions are only good for something temporarily, or else it will save to the DB and you don't want to do that -->

    <a href="admin_createuser.php">Create User</a>
    <a href="admin_logout.php">Sign Out</a>
    
</body>
</html>