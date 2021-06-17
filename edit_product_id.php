<script>
function delete_product(id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.status == 200) {
            alert("produit suprimé");
            window.open("read_product.php","_self");
        }
        else
        {
            document.getElementById("response_server").innerHTML = "erreur requete";
        }
    };
    xhttp.open("GET", "delete_product.php?id=" + id, true);
    xhttp.send();
}
</script>
<?php
/*
function delete_product($id){
    echo "delete function id is $id <br>";
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=my_shop;port=3360', "vincent" , "root");//crée l'instance de PDO pour pouvoir l'utiliser.
        if($pdo instanceof PDO){      //vérifie si l'instance est bien crée    
            $sql = "DELETE FROM products WHERE id=$id";                  
            if($pdo->query($sql)===true){
                echo "Operation was a succes !";
                /* ouvrir une autre page HTML cebloque foncitonne
            }
            else{
                echo "error in querry request";
            }
        }
        else{//si $pdo n'est pas une instance de PDO
            throw new Exception("erreur");
        }
    }
    catch(Exception $e){
        echo "PDO ERROR: " . $e->getMessage() ;
    }
}
if(array_key_exists("supprimer",$_POST)){//permet déclencher la fonction php delete_prodcut
    delete_product($_GET['id']);
}*/
if($_POST['name']===NULL){//si on entre dans le champs de la modification pour la première fois
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=my_shop;port=3360', "vincent" , "root");//crée l'instance de PDO pour pouvoir l'utiliser.
        if($pdo instanceof PDO){      //vérifie si l'instance est bien crée    
            $id = $_GET['id']; 
            $sql = "SELECT * FROM products WHERE id = $id";                  
        foreach  ($pdo->query($sql) as $row) {
                $name=$row['name'];
                $price = $row['price'];
                $cat = $row['category_id'];
                $img_in_mysql = $row['img_blob'];
                $img = '<img src="data:image/png;base64,' . base64_encode($row['img_blob']) . '" />';
            }
            
        }
        else{//si $pdo n'est pas une instance de PDO
            throw new Exception("erreur");
        }
    }
    catch(Exception $e){
        echo "PDO ERROR: " . $e->getMessage() ;
    }
}
else{    //récupère les éléments du post pour les modifier dans mysql
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=my_shop;port=3360', "vincent" , "root");//crée l'instance de PDO pour pouvoir l'utiliser.
        if($pdo instanceof PDO){      //vérifie si l'instance est bien crée    
            $id = $_GET['id']; 
            $sql = "SELECT img_blob FROM products WHERE id = $id";                  
        foreach  ($pdo->query($sql) as $row) {
            $img = '<img src="data:image/png;base64,' . base64_encode($row['img_blob']) . '" />';
            }
        $name=$POST['name'];//erreur dans le post?
        $price = $POST['price'];
        $cat = $POST['category'];
        var_dump($_POST['name']);
            try{
                $update_querry = "UPDATE products SET name=$name' ,price=$price ,category_id=$cat  WHERE id=$id";
                //"UPDATE products SET img_blob=  WHERE id="; sur autre page?
                $querry = $pdo->prepare($update_querry);
                if($querry->execute()===true){
                    echo "modification réussie";
                }
                else{
                    echo "modification échouée";
                }
            }
            catch(Exception $e){
                echo "PDO ERROR: " . $e->getMessage() ;
            }
        }
        else{//si $pdo n'est pas une instance de PDO
            throw new Exception("erreur");
        }
    }
    catch(Exception $e){
        echo "PDO ERROR: " . $e->getMessage() ;
    }
}
?>
<html>
   <head>
      <title></title>
   </head>
   <body>
        <h3>Modifier le produit : <?php echo $GLOBALS['name'] ?></h3>
        <div>
            <div>
                <?php
                    echo $GLOBALS['img'];
                ?>
            </div>
            <div>
                <p>Nom du produit : <?php echo $GLOBALS['name'] ?><p>
            </div>
            <div>
                <p>Prix du produit : <?php echo $GLOBALS['price'] ?><p>
            </div>
            <div>
                <p>Catégorie du produit : <?php
                    $array[0]="mascara";
                    $array[1]="rouge à lèvre";
                    $array[2]="fond de teint";
                    $array[3]="gel hydratant";
                    $array[4]="autre"; 
                    echo $array[$GLOBALS['cat']] ?>
                <p>
            </div>
        </div>
        <form action=<?php echo "edit_product_id.php?id=" . $_GET['id'];?> method="post"><!-- enctype="multipart/form-data" afin que le navigateur du client transfère les données binaires correctement-->
            <input type="text" name="name" >
            <input type="number" name="price" >
            <select name="category">
                <option value="0" name="0">0</option>
                <option value="1" name="1">1</option>
                <option value="2" name="2">2</option>
                <option value="3" name="3">3</option>
            </select>
            <input type="submit" value="Modifier" />
        </form>
        <form enctype="multipart/form-data" action=<?php echo "edit_product_id.php?id=" . $_GET['id'];?>  method="post">/<!-- enctype="multipart/form-data" afin que le navigateur du client transfère les données binaires correctement-->
            <input type="hidden" name="MAX_FILE_SIZE" value="250000" /><!--MAX_FILE_SIZE permet d'empêcher la taille supérieur à 250 000 octet-->
            <input type="file" name="img" id="img" size=50 />
            <input type="submit" value="Modifier l'image" />
        </form>
        <form method="post" action=<?php echo "edit_product_id.php?id=" . $_GET['id'];?> >
            <input type="submit" name="supprimer" id="supprimer" value="supprimer" /><br/>
        </form>
            <button id="supprimer-2" onclick="delete_product(<?php echo $_GET['id'];?>)">supprimer en js</button>
            <br/>
        <p id="response_server"></p>
   </body>
</html>

