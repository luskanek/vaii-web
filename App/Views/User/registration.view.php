<link rel="stylesheet" type="text/css" href="public/css/auth.css">

<div id="wrapper-banner">
    <h3>Nový používateľ</h3>
</div>

<div id="content">
    <div class="section">
        <form action="?c=user&a=register" method="post">
            <p id="info-message"></p>
            <?php
                if (isset($_SESSION["error-message"])) {
                    $msg = $_SESSION["error-message"];
                    ?><script>displayMessage("<?=$msg?>");</script><?php
                    unset($_SESSION["error-message"]);
                }
            ?>
			<h4>Vytvorenie nového účtu</h4>
            <input name="input-register-fname" type="text" placeholder="Meno" style="float:left" required>
            <input name="input-register-lname" type="text" placeholder="Priezvisko" style="float:right" required>
            <input name="input-register-phone" type="tel" placeholder="Telefónne číslo (0900 123 456)" pattern="[0-9]{4} [0-9]{3} [0-9]{3}" style="width: 100%" required>
			<input name="input-register-mail" type="email" placeholder="Váš prihlasovací email" style="width: 100%" required>
			<input name="input-register-pass" type="password" placeholder="Vaše heslo" style="width: 100%" required>
            <input name="input-register-conf" type="password" placeholder="Overenie hesla" style="width: 100%" required>
            <input name="input-register-submit" type="submit" value="Vytvoriť účet">
		</form>
    </div>
</div>