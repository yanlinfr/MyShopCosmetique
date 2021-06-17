<?php
//cette page crée un produit dans la table products
function create_subcat(){
include "./php_config.php";
if ($connection === true) {
    $sql = "INSERT INTO categories (category, parent_id)
                    VALUES (?, ?)"; //requête les "?" permettent de passer les argument par références avec un tableau et les varibles en $ dedans
    $querry = $pdo->prepare($sql); //prépare la requête
    $category = $_POST['subcategory'];/*à récupérer du post */
    $parent_id = $_POST['parent_id'];
    if ($querry->execute([$category, $parent_id]) === TRUE) { //éxectue la requête et si elle a réussi : éxéction du if
        echo "Nouvelle catégorie enregistrée";
    } else { //si la requête n'a pas fonctionnée
        echo "erreur";
    }
}
}
?>