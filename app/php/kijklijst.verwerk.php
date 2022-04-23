<?php 

session_start();
require "config.php";

if (!isset($_GET['movieID']) || $_GET['movieID'] == "" ||!isset($_GET['action']) || $_GET['action'] == "") {
    header("Location: ../../index.php");
    exit;
}else if(!isset($_SESSION['user'])) {
    header("Location: ../../login.php");
    exit;
}
else {
    $movieID = $_GET['movieID'];
    $userID = $_SESSION['userID'];
    $action = $_GET['action'];

    if ($action == "add") {
        $sql = "SELECT * FROM user_watchlist WHERE userID = {$userID} AND movieID = {$movieID}";
        $moveInWatchList = $mysqli->query($sql);
    
        if ($moveInWatchList->num_rows > 0) {
            echo "MOVIE ALREADY IN LIST";
        }else {
            $sql = "INSERT INTO user_watchlist (movieID, userID) VALUES ($movieID, $userID)";
            if ($mysqli->query($sql) === true) {
                header("Location: ../../details.php?movie=".$movieID);
                exit;
            }else {
                echo "ERRER WITH INSERT";
            }
        }
    }else if ($action == "remove") {
        $sql = "DELETE FROM user_watchlist WHERE userID = {$userID} AND movieID = {$movieID}";
        if ($mysqli->query($sql) === true) {
            if(isset($_GET['page'])) {
                if($_GET['page'] == "watchlist") {  
                    header("Location: ../../profile/list.php?page=watchlist");
                    exit;
                }
            }else {
                header("Location: ../../details.php?movie=".$movieID);
                exit;
            }
        }else {
            echo "ERRER WITH DELETE";
        }
    }else {
        header("Location: ../../index.php");
        exit;
    }
}