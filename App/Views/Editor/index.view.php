<link rel="stylesheet" type="text/css" href="public/css/editor.css">

<script src="public/js/editor.js"></script>

<div id="wrapper-banner">
    <h3>Nový inzerát</h3>
</div>

<div id="content">
    <div class="section">
        <?php
            use App\Models\Items;

            $title = NULL;
            $desc = NULL;
            $price = NULL;
            $id = NULL;

            if (isset($_GET["p"])) {
                $id = $_GET["p"];
                $item = Items::getOne("id", $id);

                $title = $item->title;
                $desc = $item->description;
                $price = $item->price;
            }
        ?>

        <form id="upload-form" action="?c=editor&a=submit" method="post" enctype="multipart/form-data">
            <p id="info-message"></p>
            <label for="input-new-title">Názov inzerátu</label>
            <input name="input-new-title" type="text" maxlength="128" placeholder="Zadajte nádpis inzerátu" value="<?php echo $title ?>" required>
            <label for="select-new-category">Kategória</label>
            <select id="select-category" name="select-new-category" style="display: block" required>
                <option value="" selected hidden>Vyberte kategóriu</option>
            </select>
            <label for="input-new-desc">Popis</label>
            <textarea name="input-new-desc" placeholder="Popis inzerátu zadajte sem" maxlength="300" required><?php echo $desc ?></textarea>
            <label for="input-new-price">Cena</label>
            <input name="input-new-price" type="number" min="0" placeholder="0" value="<?php echo $price ?>" required>
            <input name="input-new-submit" type="submit" value="Vytvoriť inzerát">
            <input name="input-new-id" type="number" value="<?php echo $id ?>" hidden>
        </form>
    </div>

    <div id="wrapper-images" class="section">
        <label for="file">Obrázky</label>
        <input name="files[]" id="input-new-images" type="file" form="upload-form" multiple required>
    </div>
</div>