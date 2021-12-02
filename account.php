<?php
    include("php/config.php");

    session_start();

    if (isset($_GET["logout"])) {
        $_SESSION = array();

        session_destroy();
    }

    if (isset($_GET["delete"])) {
        $id = $_GET["delete"];

        $query = "DELETE FROM items WHERE id='$id'";

        if (mysqli_query($connection, $query)) {
            header("location: account.php");
        }
    }

    if (!isset($_SESSION["user_mail"]) || $_SESSION["user_active"] == false) {
        header("location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Inzercia</title>

        <meta charset="UTF-8">
        <meta name="author" content="Lukáš Babečka">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/account.css">
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
                    <li>
                        <a href="index.php">
                        <i class="fas fa-home"></i>
                        Domov
                        </a>
                    </li>

                    <li>
                        <a href="editor.php">
                        <i class="fas fa-plus"></i>
                        Pridať inzerát
                        </a>
                    </li>

                    <li>
                        <a href="account.php" id="current-page">
                        <i class="fas fa-user"></i>
                        Účet
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div id="wrapper-search">
        </div>

        <div id="wrapper-banner">
            <h3>Účet</h3>
        </div>

        <div id="content">
            <div class="section">
                <div id="account-details">
                    <p>Používateľ</p>
                    <h2><?php echo htmlspecialchars($_SESSION["user_first_name"], ENT_COMPAT, "ISO-8859-15") . " " . htmlspecialchars($_SESSION["user_last_name"], ENT_COMPAT, "ISO-8859-15"); ?></h2>
                </div>

                <a id="link-logout" href="?logout"><i class="fas fa-key" style="padding-right: 10px"></i>Odhlásiť sa</a>
            </div>

            <div class="section">
                <h2>Moje inzeráty</h2>
                    <?php
                        $user = $_SESSION["user_mail"];
                        $query = "SELECT * FROM items WHERE author='$user'";
                        $result = mysqli_query($connection, $query);
                                        
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    ?>

                                    <div class="item">
                                        <a href=""><?php echo $row['title']; ?></a>
                                        <div class="icons">
                                            <a href="editor.php?id=<?php echo $row['id']; ?>" style="padding-right: 5px;"><i class="fas fa-edit"></i></a>
                                            <a href="?delete=<?php echo $row['id']; ?>"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </div>

                                    <?php
                                }
                            }
                        }
                    ?>
                </div>
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