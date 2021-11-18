<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Inzercia</title>

        <meta charset="UTF-8">
        <meta name="author" content="Lukáš Babečka">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="style.css">
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
                        <a href="index.php" id="current-page">
                        <i class="fas fa-home"></i>
                        Inzeráty
                        </a>
                    </li>

                    <li>
                        <a href="login.php">
                        <i class="fas fa-user"></i>
                        Prihlásiť sa
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div id="wrapper-search">
            <form action="search_item.php" method="post">
                <input name="search-item" placeholder="Kúpim.." type="text">
                <button type="submit"><span class="fas fa-search"></span></button>
            </form>
        </div>

        <div id="wrapper-banner">
            <h3>Prezerať inzeráty podľa kategórie</h3>
        </div>

        <div id="content">
            <div class="category">
                <a href="#">
                <i class="fas fa-car-alt"></i>
                <h3>Auto</h3>
                <p>Škoda, Audi, ..</p>
                </a>
            </div>

            <div class="category">
                <a href="#">
                <i class="fas fa-couch"></i>
                <h3>Nábytok</h3>
                <p>Skrine, postele, ..</p>
                </a>
            </div>

            <div class="category">
                <a href="#">
                <i class="fas fa-city"></i>
                <h3>Reality</h3>
                <p>Byty, domy, ..</p>
                </a>
            </div>

            <div class="category">
                <a href="#">
                <i class="fas fa-tractor"></i>
                <h3>Stroje</h3>
                <p>Motory, diely, ..</p>
                </a>
            </div>

            <div class="category">
                <a href="#">
                <i class="fas fa-mobile-alt"></i>
                <h3>Mobily</h3>
                <p>Samsung, Apple, ..</p>
                </a>
            </div>

            <div class="category">
                <a href="#">
                <i class="fas fa-desktop"></i>
                <h3>Počítače</h3>
                <p>Hry, skrine, ..</p>
                </a>
            </div>

            <div class="category">
                <a href="#">
                <i class="fas fa-motorcycle"></i>
                <h3>Motocykle</h3>
                <p>Enduro, skútre, ..</p>
                </a>
            </div>

            <div class="category">
                <a href="#">
                <i class="fas fa-bolt"></i>
                <h3>Elektronika</h3>
                <p>Práčky, sporáky, ..</p>
                </a>
            </div>

            <div class="category">'
                <a href="#">
                <i class="fas fa-bicycle"></i>
                <h3>Šport</h3>
                <p>Bicykle, lyže, ..</p>
                </a>
            </div>

            <div class="category">
                <a href="#">
                <i class="fas fa-tshirt"></i>
                <h3>Oblečenie</h3>
                <p>Šaty, tričká, ..</p>
                </a>
            </div>

            <div class="category">
                <a href="#">
                <i class="fas fa-drum"></i>
                <h3>Hudba</h3>
                <p>Gitary, bicie, ..</p>
                </a>
            </div>

            <div class="category">
                <a href="#">
                <i class="fas fa-book"></i>
                <h3>Knihy</h3>
                <p>Poézia, próza, ..</p>
                </a>
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