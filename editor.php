<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Inzercia</title>

        <meta charset="UTF-8">
        <meta name="author" content="Lukáš Babečka">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/new.css">
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
                            <a href="index.php">
                            <i class="fas fa-home"></i>
                            Domov
                            </a>
                        </li>

                        <li>
                            <a href="editor.php" id="current-page">
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
                            header("location: index.php");
                        }
                    ?>
                </ul>
            </div>
        </div>

        <div id="wrapper-search">
        </div>

        <div id="wrapper-banner">
            <h3>Nový inzerát</h3>
        </div>

        <div id="content">
            <div class="section">
                <?php
                    $title = NULL;
                    $desc = NULL;
                    $price = NULL;
                    $id = NULL;

                    if (isset($_GET["id"])) {
                        $id = $_GET["id"];

                        $query = "SELECT * FROM items WHERE id='$id'";
                        $result = mysqli_query($connection, $query);
                                
                        if ($result) {
                            if (mysqli_num_rows($result) == 1) {
                                $row = mysqli_fetch_assoc($result);
                                
                                $title = $row["title"];
                                $desc = $row["description"];
                                $price = $row["price"];
                            }
                        }
                    }
                ?>

                <form id="upload-form" action="php/add.php" method="post" enctype="multipart/form-data">
                    <label for="input-new-title">Názov inzerátu</label>
                    <input name="input-new-title" type="text" maxlength="255" placeholder="Zadajte nádpis inzerátu" value="<?php echo $title ?>" required>
                    <label for="select-new-category">Kategória</label>
                    <select name="select-new-category" style="display: block" required>
                        <option value="none" selected hidden>Vyberte kategóriu</option>
                        <option value="auto">Auto</option>
                        <option value="furniture">Nábytok</option>
                        <option value="living">Reality</option>
                        <option value="machines">Stroje</option>
                        <option value="phones">Mobily</option>
                        <option value="pc">Počítače</option>
                        <option value="moto">Motocykle</option>
                        <option value="electronics">Elektronika</option>
                        <option value="sports">Šport</option>
                        <option value="clothes">Oblečenie</option>
                        <option value="music">Hudba</option>
                        <option value="literature">Knihy</option>
                    </select>
                    <label for="input-new-desc">Popis</label>
                    <textarea name="input-new-desc" placeholder="Popis inzerátu zadajte sem" required><?php echo $desc ?></textarea>
                    <label for="input-new-price">Cena</label>
                    <input name="input-new-price" type="number" min="0" placeholder="0" value="<?php echo $price ?>" required>
                    <input name="input-new-submit" type="submit" value="Vytvoriť inzerát">
                    <input name="input-new-id" type="number" value="<?php echo $id ?>" hidden>
                </form>
            </div>

            <div id="wrapper-images" class="section">
                <label for="file">Obrázky</label>
                <input name="files[]" id="input-new-images" type="file" form="upload-form" multiple>
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