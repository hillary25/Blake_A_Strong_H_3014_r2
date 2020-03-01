<?php

function redirect_to($location){
    if($location != null){
        // This line does the redirect from login page to user dashboard
        header("Location: ".$location);
        exit; // This is an important part of code to add
    }
}