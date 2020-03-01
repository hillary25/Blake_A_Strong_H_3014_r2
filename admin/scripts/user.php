<?php
function createUser($fname, $username, $password, $email){
    $pdo = Database::getInstance()->getConnection();
    
    // TO DO: Run a SQL query to create a new user with the provided data
    $create_user_query = 'INSERT INTO tbl_user(user_fname, user_name, user_pass, user_email, user_ip) VALUES(:fname, :username, :password, :email, "no")';

    $create_user_set = $pdo->prepare($create_user_query);
    $create_user_result = $create_user_set->execute(
        array(
            ':fname'=>$fname,
            ':username'=>$username,
            ':password'=>$password,
            ':email'=>$email,
        )
    );

    // TO DO: Redirect to index.php if the user was created successfully
    // Otherwise, return an error message
    if($create_user_result){
        redirect_to('index.php');
    }else{
        return 'The user submission did not go though';
    }
}