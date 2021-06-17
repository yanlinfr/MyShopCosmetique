<?php
function update_img($file,$id){
include "./php_config.php";
if ($connection === true) {
    /*$_FILES pour récupérer le contenu binaire(img)*/
    /*stocker temporairement puis récuperer le fichier*/
    //blob => fichier
    if ($img = is_uploaded_file($file)) { //stock l'image temporairement
        $img_blob = file_get_contents($file); //retrouve l'image
        $sql = "UPDATE products SET img_blob=? WHERE id=?";            
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$img_blob, $id]) === true) {
            echo "<p class='msg'>Modification réussie !</p>"; //envoie la réponse
        } else {
            echo "<p class='msg'>modification échouée</p>";
        }
    }
}
}
