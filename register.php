<?php 
    session_start();
    
    if(isset($_SESSION['user'])) {
        header("Location:index.php");
        exit();
    }
?>

<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" type="image/png" href="app/img/popcorn.png">
    <!--CSS-->
    <link rel="stylesheet" href="app/css/login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!--JS-->
    <script src="app/js/hamburger.js" defer></script>
</head>
<body>
    <div class="grid-container" id="top">
        <header>
            <nav>
                <a href="index.php" class="logo"><img src="app/img/popcorn.png" width="50" alt="logo"></a>
                <div class=" openMenu"><i class="fas fa-bars"></i></div>
                <ul class="mainMenu">
                    <li><a href="index.php" class="nav-link">Home</a></li>
                    <li><a href="films.php" class="nav-link">Movies</a></li>
                    <li><a href="login.php" class="nav-link">Login</a></li>
                    <li><a href="register.php" class="active">register</a></li>
                    <div class="closeMenu"><i class="fas fa-times"></i></div>
                </ul>
            </nav>
        </header>
        <main>
            <section>
                <h1>Register</h1>
                <form action="app/php/register.verwerk.php" method="post">
                    <label for="username">Username</label> <br>
                    <input type="text" name="username" id="username" placeholder="Type username in..." required autocomplete="off"> <br>
                    <label for="password">Password</label> <br>
                    <input type="password" name="password" id="password" placeholder="Type password in..." required autocomplete="off"> <br>
                    <label for="passwordVerify">Herhaal password</label> <br>
                    <input type="password" name="passwordVerify" id="passwordVerify" placeholder="Type password in..." required autocomplete="off"> <br>
                    <input type="submit" value="submit" name="submit" id="submit">
                </form>
                <?php 
                    if(isset($_GET['fout'])) {
                        if ($_GET['fout'] == "uidfout") {
                            echo "<p style='color: red;'>User bestaat al!</p>";
                        }
                        else if ($_GET['fout'] == "wwfout") {
                            echo "<p style='color: red;'>Wachtwoorden komen niet overeen!</p>";
                        }
                        else {
                            echo "<p style='color: red;'>UNKNOWN ERROR!</p>";
                        }
                    }
                ?>  
                <a href="login.php">Heb je al een account? Klik hier om in te loggen</a>
            </section>
        </main>
        <footer>
            <p>??Made by Kaylan</p>
            <section class="contact-links">
                <a href=""><i class="fab fa-instagram"></i></a>
                <a href=""><i class="fab fa-linkedin"></i></a>
                <a href=""><i class="fab fa-twitter"></i></a>
            </section>
        </footer>
    </div>
</body>
</html>