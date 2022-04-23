<?php 
    session_start();
?>

<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" type="image/png" href="app/img/popcorn.png">
    <!--CSS-->
    <link rel="stylesheet" href="app/css/index.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!--JS-->
    <script src="app/js/hamburger.js" defer></script>
    <script src="app/js/app.js" defer></script>
</head>
<body>
    <header class="header" id="header">
        <nav>
            <a href="index.php" class="logo"><img src="app/img/popcorn.png" width="50" alt="logo"></a>
            <div class=" openMenu"><i class="fas fa-bars"></i></div>
            <ul class="mainMenu">
                <li><a href="#top" class="active" style="border-bottom: 1px solid white;">Home</a></li>
                <li><a href="films.php" class="nav-link">Movies</a></li>
                <?php 
                    if(isset($_SESSION['user'])) {
                        if($_SESSION['rights'] == 1){
                            echo "<li><a href='profile/profiel.php' class='nav-link'><i class='fas fa-user-shield'></i>Profiel</a></li>";
                        }else {
                            echo "<li><a href='profile/profiel.php' class='nav-link'><i class='fas fa-user'></i>Profiel</a></li>";
                        }
                        echo "<li><a href='app/php/logout.verwerk.php' class='nav-link'>Logout</a></li>";
                    }
                    else {
                        echo "<li><a href='login.php' class='nav-link'>Login</a></li>";
                        echo "<li><a href='register.php' class='nav-link'>Register</a></li>";
                    }
                ?>
                <div class="closeMenu"><i class="fas fa-times"></i></div>
            </ul>
        </nav>
    </header>
    <div id="top">
        <div class="name">
            <h1>Movieholic</h1>
        </div>
    </div>
    <main>
        <section>

        </section>
        <footer>
            <p>©Made by Kaylan</p>
            <section class="contact-links">
                <a href=""><i class="fab fa-instagram"></i></a>
                <a href=""><i class="fab fa-linkedin"></i></a>
                <a href=""><i class="fab fa-twitter"></i></a>
            </section>
        </footer>
    </main>
</body>
</html>