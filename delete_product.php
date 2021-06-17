<?php
function delete_product($id){
    echo "delete function id is $id <br>";
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=my_shop;port=3360', "vincent" , "root");//crée l'instance de PDO pour pouvoir l'utiliser.
        if($pdo instanceof PDO){      //vérifie si l'instance est bien crée    
            $sql = "DELETE FROM products WHERE id=$id";                  
            if($pdo->query($sql)===true){
                echo "Operation was a succes !";
                //ouvrir une autre page HTML cebloque foncitonne
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
delete_product($_GET['id']);
?>