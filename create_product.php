<?php
try{
    $pdo = new PDO('mysql:host=localhost;dbname=my_shop;port=3360', "vincent" , "root");//crée l'instance de PDO pour pouvoir l'utiliser.
    if($pdo instanceof PDO){      //vérifie si l'instance est bien crée      
        /*$_FILES pour récupérer le contenu binaire(img)*/
        /*stocker temporairement puis récuperer le fichier*/
        //blob => fichier
        if($img = is_uploaded_file($_FILES['img']['tmp_name'])){//stock l'image temporairement
        $img_blob = file_get_contents ($_FILES['img']['tmp_name']);//retrouve l'image
        $sql = "INSERT INTO products (name, price, category_id, img_blob)
                    VALUES (?, ?, ?, ?)";//requête les "?" permettent de passer les argument par références avec un tableau et les varibles en $ dedans
        $querry = $pdo->prepare($sql);//prépare la requête
        $name = $_POST['name'];/*à récupérer du post */
        $price=$_POST['price'];/*à récupérer du post */
        $category=$_POST['category'];/*à récupérer du post */
            if ($querry->execute([$name,$price,$category,  ($img_blob)]) === TRUE) {//éxectue la requête et si elle a réussi : éxéction du if
                echo "Nouveau produit enregistré";
            } 
            else {//si la requête n'a pas fonctionnée
                echo "Error: invalid picture <br>";
            }
        }
    }
    else{//si $pdo n'est pas une instance de PDO
        throw new Exception("erreur");
    }
}
catch(Exception $e){
    echo "PDO ERROR: " . $e->getMessage() ;
}

/*
  `name` varchar(255) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',

    exemple de catégorie à ajouter

  catégorie{
      0 = meubles;
      1 = vêtement;
      2 = chaussures;
      3 = jouets;
      4 = informatique;

  }
*/
?>

<html>
   <head>
      <title></title>
   </head>
   <body>
      <h3>Envoi d'une image</h3>
      <form enctype="multipart/form-data" action="create_product.php" method="post">/<!-- enctype="multipart/form-data" afin que le navigateur du client transfère les données binaires correctement-->
         <input type="hidden" name="MAX_FILE_SIZE" value="250000" /><!--MAX_FILE_SIZE permet d'empêcher la taille supérieur à 250 000 octet-->
         <input type="file" name="img" id="img" size=50 />
         <input type="text" name="name">
         <input type="number" name="price">
         <select name="category">
            <option value="0" name="0">0</option>
            <option value="1" name="1">1</option>
            <option value="2" name="2">2</option>
            <option value="3" name="3">3</option>
        </select>
         <input type="submit" value="Envoyer" />
      </form>
   </body>
</html>