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
            <p id="info-message"></p>
            <label for="input-new-title">Názov inzerátu</label>
            <input name="input-new-title" type="text" maxlength="255" placeholder="Zadajte nádpis inzerátu" value="<?php echo $title ?>" required>
            <label for="select-new-category">Kategória</label>
            <select name="select-new-category" style="display: block" required>
                <option value="" selected hidden>Vyberte kategóriu</option>
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
        <input name="files[]" id="input-new-images" type="file" form="upload-form" multiple required>
    </div>
</div>