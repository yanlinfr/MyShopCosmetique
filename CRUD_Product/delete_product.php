<?php
//cette page supprime un produit à partir de son id dans la bd my_shop, dans la table products

function delete_product($id)
{
    include "./php_config.php";
    if ($connection === true) {
        $sql = "DELETE FROM products WHERE id=$id";
        $querry = $pdo->prepare($sql);
        if ($querry->execute() === true) {
            echo "Operation was a succes !";
        } else {
            echo "error in querry request";
        }
    }
}
