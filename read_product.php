<html>

<body>
    <div class='conteneur_card'>
        <?php
        include "./php_config.php";
        if ($connection === true) {     //vérifie si l'instance est bien crée      
            $sql = "SELECT * FROM products"; //requête les "?" permettent de passer les argument par références avec un tableau et les varibles en $ dedans
            $is_admin = true;
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
                $img = '<img src="data:image/png;base64,' . base64_encode($row['img_blob']) . '" />';
                $id = $row['id'];
                /* le lien envoie vers la page read a product_id avec l'id du produit via un get */
                if ($is_admin === true) {
                    $a = './CRUD_Product/Manage_product_id.php?id=' . $id;
                } else {
                    $a = 'read_product_id.php?id=' . $id;
                }
                echo
                    "<a href='$a'>
                    <div class='product_card'>
                        <p>$name</p>
                        <p>$price €</p>
                        <p>$cat_name</p>
                        <p>$description</p>
                        $img
                    </div>
                </a>";
            }
        }

        ?>
    </div>
</body>
<style>
    .product_card img {
        max-width: 300px;
    }

    .conteneur_card {
        display: flex;
    }
</style>

</html>