<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Inzercia</title>

        <meta charset="UTF-8">
        <meta name="author" content="Lukáš Babečka">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/index.css">
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
                    ?>

                        <li>
                            <a href="index.php" id="current-page">
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
                            <a href="account.php">
                            <i class="fas fa-user"></i>
                            Účet
                            </a>
                        </li>
    
                    <?php
                        }
                        else {
                    ?>

                    <li>
                        <a href="index.php" id="current-page">
                        <i class="fas fa-home"></i>
                        Domov
                        </a>
                    </li>

                    <li>
                        <a href="login.php">
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
            <form action="search_section.php" method="post">
                <input name="search-section" placeholder="Kúpim.." type="text">
                <button type="submit"><span class="fas fa-search"></span></button>
            </form>
        </div>

        <div id="wrapper-banner">
            <h3>Prezerať inzeráty podľa kategórie</h3>
        </div>

        <div id="content">
            <div id="categories">
                <div class="section">
                    <a href="?category=auto">
                    <i class="fas fa-car-alt"></i>
                    <h3>Auto</h3>
                    <p>Škoda, Audi, ..</p>
                    </a>
                </div>

                <div class="section">
                    <a href="?category=furniture">
                    <i class="fas fa-couch"></i>
                    <h3>Nábytok</h3>
                    <p>Skrine, postele, ..</p>
                    </a>
                </div>

                <div class="section">
                    <a href="?category=living">
                    <i class="fas fa-city"></i>
                    <h3>Reality</h3>
                    <p>Byty, domy, ..</p>
                    </a>
                </div>

                <div class="section">
                    <a href="?category=machines">
                    <i class="fas fa-tractor"></i>
                    <h3>Stroje</h3>
                    <p>Motory, diely, ..</p>
                    </a>
                </div>

                <div class="section">
                    <a href="?category=phones">
                    <i class="fas fa-mobile-alt"></i>
                    <h3>Mobily</h3>
                    <p>Samsung, Apple, ..</p>
                    </a>
                </div>

                <div class="section">
                    <a href="?category=pc">
                    <i class="fas fa-desktop"></i>
                    <h3>Počítače</h3>
                    <p>Hry, skrine, ..</p>
                    </a>
                </div>

                <div class="section">
                    <a href="?category=moto">
                    <i class="fas fa-motorcycle"></i>
                    <h3>Motocykle</h3>
                    <p>Enduro, skútre, ..</p>
                    </a>
                </div>

                <div class="section">
                    <a href="?category=electronics">
                    <i class="fas fa-bolt"></i>
                    <h3>Elektronika</h3>
                    <p>Práčky, sporáky, ..</p>
                    </a>
                </div>

                <div class="section">
                    <a href="?category=sports">
                    <i class="fas fa-bicycle"></i>
                    <h3>Šport</h3>
                    <p>Bicykle, lyže, ..</p>
                    </a>
                </div>

                <div class="section">
                    <a href="?category=clothes">
                    <i class="fas fa-tshirt"></i>
                    <h3>Oblečenie</h3>
                    <p>Šaty, tričká, ..</p>
                    </a>
                </div>

                <div class="section">
                    <a href="?category=music">
                    <i class="fas fa-drum"></i>
                    <h3>Hudba</h3>
                    <p>Gitary, bicie, ..</p>
                    </a>
                </div>

                <div class="section">
                    <a href="?category=literature">
                    <i class="fas fa-book"></i>
                    <h3>Knihy</h3>
                    <p>Poézia, próza, ..</p>
                    </a>
                </div>
            </div>

            <div id="items">
                <?php
                    if (isset($_GET["category"])) {
                        echo "<script>hideCategories();</script>";
                                
                        $cat = $_GET["category"];

                        $query = "SELECT * FROM items WHERE category='$cat'";
                        $result = mysqli_query($connection, $query);
                                
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {	
                                    ?>
                                        <div class="item">
                                            <?php
                                                $images = explode(";", $row["files"]);

                                                for ($i = 0; $i < sizeof($images); $i++) {
                                                    if (!empty($images[$i])) {
                                                        ?><img src="uploads/<?php echo $images[$i]?>"><?php
                                                    }
                                                }
                                            ?>
                                            <h2><?php echo htmlspecialchars($row["title"], ENT_COMPAT, "ISO-8859-15");?></h2>
                                            <p><?php echo $row["description"];?></p>
                                        </div>
                                    <?php
                                }
                            }
                            else {
                                ?>
                                    <div id="empty-category">
                                        <i class="fas fa-box-open"></i>
                                        <h3>Táto kategória neobsahuje inzeráty..</h3>
                                    </div>

                                <?php
                            }
                        }
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