<?php 
    /** @var Users $data */ 
    if (session_status() === PHP_SESSION_NONE) session_start();
?>
<link rel="stylesheet" type="text/css" href="public/css/account.css">
<script src="public/js/user.js"></script>

<div id="wrapper-banner">
    <h3>Účet</h3>
    <p id="user-id" hidden><?= $data->id ?></p>
</div>

<div id="content">
    <div class="section">
        <h3>Používateľ</h3>
        <p><?= $data->name ?></p>
        <h3>E-mail</h3>
        <p><?= $data->username ?></p>
        <h3>Telefónne číslo</h3>
        <p id="user-phone"><?= $data->phone ?></p>
    </div>

    <div id="ads" class="section">
        <h3>Zverejnené inzeráty</h3>
        <script>loadItems(false);</script>
    </div>

    <div id="reviews" class="section">
        <h3>Hodnotenia</h3>
        <?php if (!empty($_SESSION["user"])) { ?>
            <i class="fas fa-plus-circle" onclick="showEditor()"></i>
        <?php } ?>
        <script>loadReviews();</script>
        <form id="editor" action="?c=user&a=submit" method="post" hidden>
            <input name="review-id" value="<?= $data->id ?>" hidden readonly>
            <textarea name="review-content" placeholder="Ohodnotenie používateľa zadajte sem" maxlength="150" required></textarea>
            <input name="review-submit" type="submit" value="Odoslať">
        </form>
    </div>
</div>