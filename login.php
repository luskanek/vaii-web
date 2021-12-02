<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Inzercia</title>

        <meta charset="UTF-8">
        <meta name="author" content="Lukáš Babečka">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link rel="icon" href="resources/favicon.ico" type="image/ico">
    </head>

    <body onresize="showNavbar()">
        <script src="script.js"></script>

        <div id="header">
            <h1 id="web-title">Inzercia</h1>

            <a href="javascript:void(0);" onclick="showHamburger()" id="hamburger-menu"><span class="fas fa-bars"></span></a>

            <div id="navbar">
                <ul>
                    <?php
                        include("php/config.php");

                        session_start();

                        if (isset($_SESSION["user_mail"]) && $_SESSION["user_active"] == true) {
                            header("location: index.php");
                        }
                        else {
                    ?>

                    <li>
                        <a href="index.php">
                        <i class="fas fa-home"></i>
                        Domov
                        </a>
                    </li>

                    <li>
                        <a href="login.php" id="current-page">
                        <i class="fas fa-sign-in-alt"></i>
                        Prihlásiť sa
                        </a>
                    </li>

                    <?php 
                        }
                    ?>
                </ul>
            </div>
        </div>

        <div id="wrapper-search">  
        </div>

        <div id="wrapper-banner">
            <h3>Autentifikácia</h3>
        </div>

        <div id="content">
            <div class="section">
                <?php
                    if (isset($_GET["new_user"])) {
                ?>

                <form action="php/register.php" method="post">
                    <?php
                        if (isset($_SESSION["error-message"])) {
                            $msg = $_SESSION["error-message"];
                            echo '<p id="info-message">' . $msg . '</p>';
                            echo '<script>appendWarning();</script>';
                            unset($_SESSION["error-message"]);
                        }
                    ?>
					<h4>Nový používateľ</h4>
                    <input name="input-register-fname" type="text" placeholder="Meno" style="float:left" required>
                    <input name="input-register-lname" type="text" placeholder="Priezvisko" style="float:right" required>
					<input name="input-register-mail" type="email" placeholder="Váš prihlasovací email" style="width: 100%" required>
					<input name="input-register-pass" type="password" placeholder="Vaše heslo" style="width: 100%" required>
                    <input name="input-register-confirm" type="password" placeholder="Overenie hesla" style="width: 100%" required>
                    <input name="input-register-submit" type="submit" value="Vytvoriť účet">
				</form>

                <?php
                    }
                    else {
                ?>

                <form action="php/login.php" method="post">
                    <p id="info-message"></p>
                    <?php
                        if (isset($_SESSION["error-message"])) {
                            $msg = $_SESSION["error-message"];
                            ?><script>displayMessage("<?=$msg?>");</script><?php
                            unset($_SESSION["error-message"]);
                        }
                    ?>
					<h4>Vitajte späť</h4>
					<input name="input-login-mail" type="email" placeholder="Váš prihlasovací email" style="width: 100%" required>
					<input name="input-login-pass" type="password" placeholder="Vaše heslo" style="width: 100%" required>
					<a href="?new_user">Vytvoriť nový účet</a>
					<input name="input-login-submit" type="submit" value="Prihlásiť">
				</form>

                <?php
                    }
                ?>
            </div>
        </div>

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