<link rel="stylesheet" type="text/css" href="public/css/auth.css">

<div id="wrapper-banner">
    <h3>Autentifikácia</h3>
</div>

<div id="content">
    <div class="section">
        <form action="?c=user&a=login" method="post">
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
			<input name="input-login-submit" type="submit" value="Prihlásiť">
            <a href="?c=user&a=registration">Vytvoriť nový účet</a>
		</form>
    </div>
</div>