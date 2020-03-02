<!-- Login page submits to admin_login.php -->
<?php
    require_once '../load.php';

    // $_UPPERCASE means built-in variables from php
    $ip = $_SERVER['REMOTE_ADDR'];

    if(isset($_POST['submit'])){
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if(!empty($username) && !empty($password)){
            // Log user in
            $message = login($username, $password, $ip);
        }else{
            $message = 'Please fill out the required field';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
</head>
<body>
    <h2>Login Page</h2>
    <?php echo !empty($message)? $message: ''; ?>
    
    <!-- Use post method as it doesn't reveal information in the URL, get will reveal that information -->
    <form action="admin_login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="">

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value="">

        <button name="submit">Submit</button>
    </form>
</body>
</html>