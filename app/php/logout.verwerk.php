<?php 
session_start();


if (isset($_SESSION['user'])) {
    session_start();
    session_unset();
    session_destroy();
    
    header("location: ../../index.php");
    exit();
}

else {
    header("location: ../../index.php");
    exit();
}

