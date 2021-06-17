<?php
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
        var_dump($name);
            try{
                $update_querry = "UPDATE products SET name=$name ,price=$price ,category=$cat  WHERE id=$id";
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
?>