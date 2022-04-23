<?php 
require 'config.php';


if (isset($_POST['submit'])) {



    $username = mysqli_escape_string($mysqli, $_POST['username']);
    $password = mysqli_escape_string($mysqli, $_POST['password']);

    $stmt = $mysqli->prepare("SELECT * FROM user_list WHERE userName = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result) {
        $row = $result->fetch_assoc();   
        if ($row) {
            $passwordVerify = password_verify($password, $row["userPassword"]);

            if ($passwordVerify) {
                session_start();
                $_SESSION['date'] = $row['create_date'];
                $_SESSION['profileImg'] = $row['profile_img'];
                $_SESSION['user'] = $row['userName'];
                $_SESSION['userID'] = $row['userID'];
                $_SESSION['rights'] = $row['rights'];
    
                header("Location:../../index.php");
                exit();
            } 
            else {
                header("Location:../../login.php?fout=wrong");
                exit();
            }
        } 
        else {
            header("Location:../../login.php?fout=wrong");
            exit();
        }
    }

    else{
        header("Location:../../login.php?fout=error");
        exit();
    }

}

else {
    header("Location:../../index.php");
    exit();
}