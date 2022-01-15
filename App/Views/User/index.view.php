<link rel="stylesheet" type="text/css" href="css/login.css">

<div id="wrapper-banner">
    <h3>Autentifikácia</h3>
</div>

<div id="content">
    <div class="section">
    <?php
        if (isset($_GET["new_user"])) {
    ?>
        <form action="php/register.php" method="post">
            <p id="info-message"></p>
            <?php
                if (isset($_SESSION["error-message"])) {
                    $msg = $_SESSION["error-message"];
                    ?><script>displayMessage("<?=$msg?>");</script><?php
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
            } else {
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