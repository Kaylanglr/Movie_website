<?php 

require 'config.php';


if(isset($_POST['submit'])) {
    $dateCreated = date("F Y");
    $profileImgArray = array("profile-1.jpg", "profile-2.jpg", "profile-3.jpg", "profile-4.jpg", "profile-5.jpg", "profile-6.jpg", "profile-7.jpg", "profile-10.jpg", "profile-11.jpg");
    $randomImg = array_rand($profileImgArray, 1);
    $profileImg = $profileImgArray[$randomImg];
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $passwordVerify = mysqli_real_escape_string($mysqli, $_POST['passwordVerify']);


    $userExist = "SELECT * FROM user_list WHERE userName = ?";
    $stmt = $mysqli->prepare($userExist);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if ($row) {
        header("Location:../../register.php?fout=uidfout");
        exit();
    }
    else {
        if ($password == $passwordVerify) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO user_list (userName, userPassword, create_date, profile_img) VALUES (?, ?, ?, ?)";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("ssss", $username, $passwordHash, $dateCreated, $profileImg);
            $stmt->execute();
            $result2 = $stmt->get_result();

            session_start();
            $_SESSION['date'] = $dateCreated;
            $_SESSION['profileImg'] = $profileImg;
            $_SESSION['user'] = $username;
            $_SESSION['userID'] = $mysqli->insert_id;
            $_SESSION['rights'] = 0;

            $stmt->close();
            header("Location:../../index.php");
            exit();
        }
        else {
            header("Location:../../register.php?fout=wwfout");
            exit();
        }
    }
}

else {
    header("Location:../../index.php");
    exit();
}