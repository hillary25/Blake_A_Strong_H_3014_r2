<?php

function redirect_to($location){
    if($location != null){
        // This line does the redirect from login page to user dashboard
        header("Location: ".$location);
        exit; // This is an important part of code to add
    }
}

function mixed_password($password_picker, $character){
    // Returns the first 'character' characters of a shuffled version of 'password_picker'
    return substr(str_shuffle($password_picker), 0, $character);
}