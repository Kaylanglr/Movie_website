<?php 
session_start();
?>

<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films</title>
    <link rel="icon" type="image/png" href="app/img/popcorn.png">
    <!--CSS-->
    <link rel="stylesheet" href="app/css/films.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!--JS-->
    <script src="app/js/hamburger.js" defer></script>
    <script src="app/js/movies.js" defer></script>
</head>
<body>
    <div class="grid-container" id="top">
        <header>
            <nav>
                <a href="index.php" class="logo"><img src="app/img/popcorn.png" width="50" alt="logo"></a>
                <div class=" openMenu"><i class="fas fa-bars"></i></div>
                <ul class="mainMenu">
                <li><a href="index.php" class="nav-link">Home</a></li>
                <li><a href="" class="active">Movies</a></li>
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
        <div class="filter">
            <form class="searchBar" id="form">
                <input type="text" name="searchMovie" id="searchMovie" placeholder="Zoek film.." autocomplete="off">
                <button><i class="fas fa-search"></i></button>
            </form>
            <button onclick="filter()"><i class="fas fa-filter"></i></button>
        </div>
        <main>
            <div class="boxAlign" id="boxAlign">
                <div class="filter-box" id="filter-box" style="transform: translateX(101%);">

                </div>
            </div>
            <section class="films" id="films">
            </section>
        </main>
        <footer>
            <p>©Made by Kaylan</p>
            <section class="contact-links">
                <a href=""><i class="fab fa-instagram"></i></a>
                <a href=""><i class="fab fa-linkedin"></i></a>
                <a href=""><i class="fab fa-twitter"></i></a>
            </section>
        </footer>
    </div>
</body>
</html>