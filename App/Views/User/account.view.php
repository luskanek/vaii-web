<?php /** @var Users $data */ ?>
<link rel="stylesheet" type="text/css" href="public/css/account.css">
<script src="public/js/user.js"></script>

<div id="wrapper-banner">
    <h3>Účet</h3>
    <p id="user-id" hidden><?= $data->id ?></p>
</div>

<div id="content">
    <div id="info" class="section">
        <h3>Používateľ</h3>
        <p><?= $data->name ?></p>
        <h3>E-mail</h3>
        <p><?= $data->username ?></p>
        <h3>Telefónne číslo</h3>
        <p id="user-phone"><?= $data->phone ?><i id="user-phone-update" class="fas fa-edit" onclick="updatePhone()" style="margin-left: 5px; cursor: pointer;"></i></p>
        <input id="user-input-phone" type="tel" pattern="[0-9]{4} [0-9]{3} [0-9]{3}" hidden required>
        <i id="user-phone-confirm" class="fas fa-check" onclick="updatePhone()" style="margin-left: 5px; cursor: pointer; display: none;"></i>
    </div>

    <div id="ads" class="section">
        <h3>Moje inzeráty</h3>
        <script>loadItems(true);</script>
    </div>

    <div id="reviews" class="section">
        <h3>Hodnotenia</h3>
        <script>loadReviews();</script>
    </div>
</div>