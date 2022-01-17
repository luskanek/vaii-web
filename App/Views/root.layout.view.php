<?php
    if (session_status() === PHP_SESSION_NONE) session_start();
?>

<!DOCTYPE html>
<html lang="sk">
    <head>
        <title>Inzercia</title>

        <meta charset="UTF-8">
        <meta name="author" content="Lukáš Babečka">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" type="text/css" href="public/css/main.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link rel="icon" href="public/resources/favicon.ico" type="image/ico">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>

    <body onresize="showNavbar()">
        <script src="public/js/utils.js"></script>
        
        <div id="header">
            <h1 id="web-title"><a href="?c=home">Inzercia</a></h1>

            <a href="javascript:void(0);" onclick="showHamburger()" id="hamburger-menu"><span class="fas fa-bars"></span></a>

            <div id="navbar">
                <ul>
                    <?php 
                        if (isset($_SESSION["user"])) 
                        {
                    ?>

                    <li class="nav-item">
                        <a class="nav-link" href="?c=home">Domov</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?c=editor">Nový inzerát</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?c=user&a=account">Účet</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?c=user&a=logout">Odhlásiť sa</a>
                    </li>

                    <?php
                        }
                        else
                        {
                    ?>

                    <li class="nav-item">
                        <a class="nav-link" href="?c=home">Domov</a>
                    </li>
                    <li class="nav-item">
                            <a class="nav-link" href="?c=user">Prihlásiť sa</a>
                    </li>

                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>

        <div id="wrapper-search"></div>

        <?= $contentHTML ?>
        
        <div id="footer">
            <div id="info">
                <div class="col">
                    <h2>Informácie</h2>
                    <a href="#">Podmienky inzercie</a>
                    <a href="#">Reklama</a>
                    <a href="#">Mobilná aplikácia</a>
                    <a href="#">GDPR</a>
                </div>

                <div class="col">
                    <h2>O webstránke</h2>
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam sed neque iaculis, mattis tortor sit amet, laoreet leo. Fusce rutrum, lorem a pharetra cursus, sapien lorem congue arcu, sit amet porta libero lacus nec lacus. Sed tincidunt est ac lorem hendrerit, ut sodales lorem maximus. Ut quis posuere elit
                    </p>
                </div>

                <div class="col">
                    <h2>Napíšte nám</h2>
                    <form>
                        <input name="contact-mail" type="email" placeholder="Váš e-mail" required>
                        <textarea placeholder="Vaša správa"></textarea>
                        <input type="submit" value="Odoslať">
                    </form>
                </div>
            </div>

            <div id="socials">
                <a href="http://www.facebook.com/"><i class="fab fa-facebook"></i></a>
                <a href="http://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                <a href="http://www.youtube.com/"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </body>
</html>