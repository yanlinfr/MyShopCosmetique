<?php
include "../php_config.php";
if ($connection === true) {    //vérifie si l'instance est bien crée    
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = $id";
    foreach ($pdo->query($sql) as $row) {
        $name = $row['name'];
        $price = $row['price'];
        $cat = $row['category_id'];
        $description = $row['description'];
        $sql = "SELECT category FROM categories WHERE id = $cat";
        $query_cat = $pdo->prepare($sql);
        $query_cat->execute();
        $array_cat = $query_cat->fetch(PDO::FETCH_ASSOC);
        $cat_name = $array_cat["category"];
        $img_in_mysql = $row['img_blob'];
        $img = '<img src="data:image/png;base64,' . base64_encode($row['img_blob']) . '" />';
    }
}
?>

<html>

<head>
    <title></title>
</head>

<body>
    <h3>Modifier le produit : <?php echo $GLOBALS['name'] ?></h3>
    <div class='div_gloable_product'>
        <div>
            <?php
            echo $GLOBALS['img'];
            ?>
        </div>
        <div>
            <p>Nom du produit : <?php echo $GLOBALS['name'] ?><p>
                    <form action=<?php echo "edit_product_id.php?id=" . $_GET['id'] . "&var=name"; ?> method="post">
                        <input type="text" name="value" id="name">
                        <input value="Modifier le nom" type="submit">
                    </form>
        </div>
        <div>
            <p id="test_div">Prix du produit : <?php echo $GLOBALS['price'] ?><p>
                    <form action=<?php echo "edit_product_id.php?id=" . $_GET['id'] . "&var=price"; ?> method="post">
                        <input type="text" name="value" id="price">
                        <input value="Modifier le prix" type="submit">
                    </form>
        </div>
        <div>
            <p id="test_div">description du produit : <?php echo $GLOBALS['description'] ?><p>
                    <form action=<?php echo "edit_product_id.php?id=" . $_GET['id'] . "&var=description"; ?> method="post">
                        <input type="text" name="value" id="price">
                        <input value="Modifier la description" type="submit">
                    </form>
        </div>
        <div>
            <p>Catégorie du produit : <?php echo $GLOBALS['cat_name'] ?>
            </p>
            <form action=<?php echo "./edit_product_id.php?id=" . $_GET['id'] . "&var=category_id"; ?> method="post">
                <!-- enctype="multipart/form-data" afin que le navigateur du client transfère les données binaires correctement-->
                <select name="value">
                    <option value="4" name="4">nettoyants</option>
                    <option value="5" name="5">crèmes</option>
                    <option value="6" name="6">masques</option>
                    <option value="7" name="7">hydratant</option>
                    <option value="8" name="8">huiles</option>
                    <option value="9" name="9">gels douche</option>
                    <option value="10" name="10">shampoings</option>
                    <option value="11" name="11">après-shampoings</option>
                    <option value="12" name="12">masques capillaires</option>
                </select>
                <input type="submit" value="Modifier" />
            </form>
        </div>
    </div>
    <form enctype="multipart/form-data" action=<?php echo "edit_img_product.php?id=" . $_GET['id']; ?> method="post">/
        <!-- enctype="multipart/form-data" afin que le navigateur du client transfère les données binaires correctement-->
        <input type="hidden" name="MAX_FILE_SIZE" value="250000" />
        <!--MAX_FILE_SIZE permet d'empêcher la taille supérieur à 250 000 octet-->
        <input type="file" name="img" id="img" size=50 />
        <input type="submit" value="Modifier l'image" />
    </form>
    <form action=<?php echo "delete_product.php?id=" . $_GET['id']; ?> method="post">/
        <input type="submit" value="supprimer"></input>
    </form>
    <br />
</body>

</html>
<style>
    .div_gloable_product div {
        margin: auto;
        width: 80%;
        border: 1px solid black;
        display: flex;
    }

    .div_gloable_product img {
        margin-left: auto;
        width: 300px;
        border: 1px solid black;
    }

    #test_div {
        width: 100%;
        height: 100%;
        margin: auto;
    }
</style>