<?php

// Be able to use phpmailer (following installation instructions)
use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// This loads phpmailer (following installation instructions)
require '../vendor/autoload.php';

function createUser($fname, $username, $email){
    $pdo = Database::getInstance()->getConnection();
    
    // TO DO: Run a SQL query to create a new user with the provided data
    $create_user_query = 'INSERT INTO tbl_user(user_fname, user_name, user_pass, user_email, user_ip)';
    $create_user_query .= ' VALUES(:fname, :username, :password, :email, "no" )';

    // Generates a random password composed of 'password_length' characters from 'password_picker'
    $password_length = 5;
    $password_picker = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $generated_password = mixed_password($password_picker, $password_length);

    // Encrypts the password using the md5 function
    $encrypted_password = md5($generated_password);

    $create_user_set = $pdo->prepare($create_user_query);
    $create_user_result = $create_user_set->execute(
        array(
            ':fname'=>$fname,
            ':username'=>$username,
            ':password'=>$encrypted_password,
            ':email'=>$email,
        )
    );

    // TO DO: Redirect to index.php if the user was created successfully
    // Otherwise, return an error message
    if($create_user_result){

        // // Add phpmailer here (following tutorial in reference list)
        // // When it creates a user, it should send out info mail to them...
        // $mail = new PHPMailer;

        // // SERVER SETTINGS
        // // Debugger
        // $mail->SMTPDebug = 1;

        // // SMTP authentication
        // $mail->SMTPAuth = TRUE;

        // // Encryption
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        // // Set the port number
        // $mail->Port = 465;

        // // This is the host name that the email will send with
        // $mail->Host = 'smtp.gmail.com';
        
        // $mail->Username   = 'hillarystrongportfolio@gmail.com';
        
        // $mail->Password   = '@Portfolio100';

        // // Send using STMP
        // $mail->isSMTP();

        // // SERVER SETTINGS
        // // Details on who the create user email will be sent from
        // $mail->setFrom('hillarystrongportfolio@gmail.com', 'Hillary Strong - Admin');

        // // Who the create user email will be sent to (the recipient)
        // $mail->addAddress($email, $fname);


        // // CONTENT OF EMAIL
        // // Subject line on email sent
        // $mail->Subject = 'Your account info is here!';

        // // Body copy of what the email sent will say
        // $mail->Body = 'Thanks for becoming a new user. Save this email to reference your username, password and remember the URL to login.
        // Username: '.$fname.'
        // Password: '.$generated_password.'
        // Login link for Apple users: http://localhost:8888/Blake_A_Strong_H_3014_r2/admin/admin_login.php
        // Login link for Windows users: http://localhost/Blake_A_Strong_H_3014_r2/admin/admin_login.php

        // Thank you! Have a nice day.';

        // // Send the mail with phpmailer
        // if(!$mail->send()){
        //     echo 'Your login info has been sent.';
        // }else{
        //     echo 'The login info was not sent. Please try again.';
        // }

        echo '<p>Thanks for becoming a new user. Please write down your username and password.</p>
        <p>Username: '.$fname.'</p>
        <p>Password: '.$generated_password.'</p>';
    }else{
        return 'The user submission did not go though.';
    }
}
?>