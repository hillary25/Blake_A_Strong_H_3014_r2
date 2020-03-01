<?php

function login($username, $password, $ip){
    // Debug

    // sprintf allows you to use % and switch out for varible on the browser screen
    //$message = sprintf('You are trying to login with username %s and password %s', $username, $password);

    $pdo = Database::getInstance()->getConnection();
    // Check existance
    $check_exist_query = 'SELECT COUNT(*) FROM tbl_user WHERE user_name= :username';
    $user_set = $pdo->prepare($check_exist_query);
    $user_set->execute(
        array(
            ':username' => $username,
        )
    );

    if($user_set->fetchColumn()>0){
        // User exists
        //$message = 'User exists!';
        $get_user_query = 'SELECT * FROM tbl_user WHERE user_name = :username';
        $get_user_query .= ' AND user_pass = :password';
        $user_check = $pdo->prepare($get_user_query);
        $user_check->execute(
            array(
                ':username'=>$username,
                ':password'=>$password
            )
        );
        // Check user table and see if there is a username and password that matches the database

        while($found_user = $user_check->fetch(PDO::FETCH_ASSOC)){
            $id = $found_user['user_id'];
            // Logged in!
            // If there is a match from the database, you will be able to login (use this syntax as we don't want people using sql injection)
            $message = 'You just logged in!';
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $found_user['user_fname'];

            // TO DO: Finish the folloiwng lines so that when user logged in the user_ip column gets updated by the $ip
            $update_query ='UPDATE tbl_user SET user_ip = :ip WHERE user_id = :id';
            $update_set = $pdo->prepare($update_query);
            $update_set->execute(
                array(
                    ':ip'=>$ip,
                    ':id'=>$id
                )
            );

        }

        if(isset($id)){
            redirect_to('index.php');
        }

        // Log user in
    }else{
        // User does not exist
        $message = 'User does not exist';
    }

    // Log user in
    return $message;
}

function confirm_logged_in(){
    if(!isset($_SESSION['user_id'])){
        redirect_to('admin_login.php');
    }
}

function logout(){
    session_destroy();
    redirect_to('admin_login.php');
}