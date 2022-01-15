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

<link rel="stylesheet" type="text/css" href="public/css/account.css">

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
            $id = $_SESSION["user_id"];
            $query = "SELECT * FROM items WHERE author='$id'";
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