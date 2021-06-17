<?php
//ce fichier modifie une valeur d'un produits de la BD my_shop, dans la table "products" avec l'id, le type de variable et la valeur de la nouvelle valeur
function update_category(){
include "./php_config.php";
if ($connection === true && isset($_POST['value'])) {
    $sql = "UPDATE categories SET category=? WHERE id=?"; //permet de modifier la variable qui sera affectée avec $var(name, description,etc)
    $id = $_POST['parent_id_update'];
    $value = $_POST['value'];
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$value, $id]) === true) {
        echo "Modificaiton réussie !\n$var : $value"; //envoie la réponse
        
    } else {
        echo "modification échouée";
    }
}
}
?>
