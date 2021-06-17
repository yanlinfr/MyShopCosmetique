<?php
function getDatabaseConnexion()
{
   try {
      $user = "vincent";
      $pass = "root";
      $pdo = new PDO('mysql:host=;dbname=my_shop', $user, $pass);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
   } catch (PDOException $e) {
      print "error to connect to the database" . "<br/>";
      die();
   }
}

function getByFilters($search, $sort)
{
   $con = getDatabaseConnexion();
   if (isset($search) && !empty($search)) {
      $sorting = "";
      if ($sort == 1) {
         $sorting = "order by name asc";
      }
      if ($sort == 2) {
         $sorting = "order by name desc";
      }
      if ($sort == 3) {
         $sorting = "order by price asc";
      }
      if ($sort == 4) {
         $sorting = "order by price desc";
      }
      $q = htmlspecialchars($search);
      $products = $con->query("select * from products WHERE name LIKE '%$q%' OR price='$q' OR category_id IN(SELECT id from categories WHERE category LIKE '%$q%' OR parent_id IN(SELECT id from categories WHERE category LIKE '%$q%')) $sorting;");
      return $products;
   }
}

$products = getByFilters($_GET['search'], $_GET['sort']);

?>

<!DOCTYPE html>

<html lang="fr">
<!--PRODUITS "NOS PRODUITS PREFERES" A INSERER à partir de la ligne 83-->

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta name="description" content="Découvrez nos cosmétiques Bio concentrés. Des produits de soin et d’hygiène pour le visage et le corps." />
  <meta name="abstract" content="Des produits cosmétiques plus sains, plus durables, plus transparents. Pour une peau apaisée." />
  <meta name="keywords" content="bio, cosmétiques, naturel, peau délicate, crème, produits de beauté" />
  <title>Cosmétique bio YaMaVie</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">

  <link rel="stylesheet" type='text/css' href="style_1.css">

  <link rel="stylesheet" type='text/css' href="stylesearch.css">

  <link rel="icon" type="image/png" href="img/yamavie-icon.png" />
</head>

<body>
   
<header>
 <div id="ligne_haut" class="d-none d-lg-flex d-xl-flex">
   <img src="img/yamavie-logo.png" id="logo">
   <div>
     <div id="compte">
       <a href="">S'inscrire</a>
       <a href="">Se connecter</a>
       <a href="" id="cart"><img src="img/cart.png" />Mon panier</a>
     </div>
   </div>
 </div>
 <div id="ligne_haut_mobile" class="d-lg-none d-xl-none">
   <img src="img/yamavie-logo.png" id="logo_mobile">
   <div>
     <a href="" id="cart_mobile"><img src="img/cart.png" /></a>
   </div>
 </div>
 <nav class="d-none d-lg-flex d-xl-flex">
   <ul class="menu">
     <li class="menu-item"><a href="#">Tous les produits</a></li>
     <li class="menu-item"><a href="#">Soins du visage</a>
     </li>
     <li class="menu-item"><a href="#">Soins du corps</a></li>
     <li class="menu-item"><a href="#">Soins des cheveux</a></li>
   </ul>
 </nav>
 <div class="btn-group dropleft d-lg-none d-xl-none" id="menu_mobile">
   <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
     &#9776;
   </button>
   <div class="dropdown-menu">
     <!-- Dropdown menu links -->
     <a class="dropdown-item" href="#">Se connecter</a>
     <a class="dropdown-item" href="#">S'inscrire</a>
     <div class="dropdown-divider"></div>
     <a class="dropdown-item" href="#">Tous les produits</a>
     <a class="dropdown-item" href="#">Soins du visage</a>
     <a class="dropdown-item" href="#">Soins du corps</a>
     <a class="dropdown-item" href="#">Soins des cheveux</a>
   </div>
 </div>
</header>

<form action="search.php" method="GET">
   <input type="search" name="search" id="search_bar" placeholder="recherche" value=<?php echo '"'.$_GET['search'].'"'; ?>>
   <select name="sort">
      <option value="1">NOM Croissant</option>
      <option value="2">NOM Decroissant</option>
      <option value="3">PRIX Croissant</option>
      <option value="4">PRIX Decroissant</option>
   </select>
   <input type="image" src="img/search.png" alt="Submit" id="search_img">
</form>

<main class="contenu">
   <section id="resultat">
                        <?php if (isset($products) && $products->rowCount() > 0) {
                                 while ($a = $products->fetch()) {
                                    $img = '<img class ="img_produit" src="data:image/png;base64,' . base64_encode($a['img_blob']) . '" />';
                                    $cat = $a['category_id'];
                                    $sql = "SELECT category FROM categories WHERE id = $cat";
                                    $query_cat = $pdo->prepare($sql);
                                    $query_cat->execute();
                                    $array_cat = $query_cat->fetch(PDO::FETCH_ASSOC);
                                    $cat_name = $array_cat["category"];
                                    echo '
                                    <article class="produits">
                                    <div class="intermediaire_div">
                                    <div class="produit_div">
                                      <a href="">
                                      '. $img .'
                                        <h3>' . $a["name"] . '</h3>
                                        <h5>' . $cat_name . '</h5>
                                        </a>
                                    </div>
                                        <div class="achat">
                                            <p class="prix">' . $a["price"] . '€</p>
                                            <a href=""><img src="img/cart.png"></a>
                                            
                                        </div>
                                    </div>
                                    <p class="description_hidden">' . $a["description"] . '</p>
                                    </article>
                                    
                                    ';
                                 }
                              } else {  ?>
                           Aucun résultat pour: <?php $_GET['search'] ?>...
                     <?php } ?>
   </section>
</main>

</body>

</html>