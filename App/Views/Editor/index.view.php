<link rel="stylesheet" type="text/css" href="public/css/editor.css">

<script src="public/js/editor.js"></script>

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

        <form id="upload-form" action="?c=editor&a=submit" method="post" enctype="multipart/form-data">
            <p id="info-message"></p>
            <label for="input-new-title">Názov inzerátu</label>
            <input name="input-new-title" type="text" maxlength="255" placeholder="Zadajte nádpis inzerátu" value="<?php echo $title ?>" required>
            <label for="select-new-category">Kategória</label>
            <select id="select-category" name="select-new-category" style="display: block" required>
                <option value="" selected hidden>Vyberte kategóriu</option>
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
        <input name="files[]" id="input-new-images" type="file" form="upload-form" multiple required>
    </div>
</div>