
<?php
//cette page crée un produit dans la table products
function create_cat(){
include "./php_config.php";
if ($connection === true) {
        $sql = "INSERT INTO categories (category, parent_id)
                    VALUES (?, ?)"; //requête les "?" permettent de passer les argument par références avec un tableau et les varibles en $ dedans
        $querry = $pdo->prepare($sql); //prépare la requête
        $category = $_POST['category'];/*à récupérer du post */
        if ($querry->execute([$category,0]) === TRUE) { //éxectue la requête et si elle a réussi : éxéction du if
            echo "Nouvelle catégorie enregistrée";
        } else { //si la requête n'a pas fonctionnée
            echo "erreur";
        }
    }
}
?>


