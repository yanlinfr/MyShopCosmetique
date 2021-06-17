<?php
//ce fichier modifie une valeur d'un produits de la BD my_shop, dans la table "products" avec l'id, le type de variable et la valeur de la nouvelle valeur
function edit_product($var, $value, $id)
{
    include "./php_config.php"; //car appelée depuis le dossier parent
    if ($connection === true) {
        $sql = "UPDATE products SET $var=? WHERE id=?"; //permet de modifier la variable qui sera affectée avec $var(name, description,etc)
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$value, $id]) === true) {
            echo "<p class='msg'>Modification réussie !</p>"; //envoie la réponse

        } else {
            echo "<p class='msg'>modification échouée</p>";
        }
    }
}
