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
    <a href="index.php"><img src="img/yamavie-logo.png" id="logo"></a>
      <div>
        <div id="compte">
          <a href="signup.php">S'inscrire</a>
          <?php
          session_start();
          if (isset($_SESSION["username"])) {
            echo '<br><br><a href="logout.php">Se déconnecter</a>';
          } else {
            echo '<br><br><a href="signin.php">Se connecter </a>';
          }
          ?>
          <a href="" id="cart"><img src="img/cart.png" />Mon panier</a>
        </div>
        <form action="search.php" method="GET">
          <!--Envoie le texte au fichier de recherche php-->
          <input type="text" name="recherche" id="search_bar" placeholder="recherche" value=<?php echo '"'.$_GET['search'].'"'; ?>>
          <input type="hidden" name="sort" value="1">
          <input type="image" src="img/search.png" alt="Submit" id="search_img">
        </form>
      </div>
    </div>
    <div id="ligne_haut_mobile" class="d-lg-none d-xl-none">
    <a href="index.php"><img src="img/yamavie-logo.png" id="logo_mobile"></a>
      <div>
        <form action="search.php" method="GET">
          <!--Envoie le texte au fichier de recherche php-->
          <input type="text" name="recherche" id="search_bar_mobile" placeholder="recherche" value=<?php echo '"'.$_GET['search'].'"'; ?>>
          <input type="hidden" name="sort" value="1">
          <input type="image" src="img/search.png" alt="Submit" id="search_img_mobile">
        </form>
        <a href="" id="cart_mobile"><img src="img/cart.png" /></a>
      </div>
    </div>
    <nav class="d-none d-lg-flex d-xl-flex">
      <ul class="menu">
        <li class="menu-item"><a href="index.php">Tous les produits</a></li>
        <li class="menu-item"><a href="#">Soins du visage</a><div class="sous-menus"><a href="">Nettoyants</a><a href="">Crèmes</a><a href="">Masques</a></div>
        </li>
        <li class="menu-item"><a href="#">Soins du corps</a><div class="sous-menus"><a href="">Hydratants</a><a href="">Huiles</a><a href="">Gels Douche</a></div></li>
        <li class="menu-item"><a href="#">Soins des cheveux</a><div class="sous-menus"><a href="">Shampooings</a><a href="">Après-Shampooings</a><a href="">Masques capillaires</a></div></li>
      </ul>
    </nav>
    <div class="btn-group dropleft d-lg-none d-xl-none" id="menu_mobile">
      <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        &#9776;
      </button>
      <div class="dropdown-menu">
        <!-- Dropdown menu links -->
        
        <a class="dropdown-item" href="signup.php">S'inscrire</a>
        <?php
          session_start();
          if (isset($_SESSION["username"])) {
            echo '<br><br><a class="dropdown-item" href="logout.php">Se déconnecter</a>';
          } else {
            echo '<br><br><a class="dropdown-item" href="signin.php">Se connecter </a>';
          }
          ?>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Tous les produits</a>
        <a class="dropdown-item" href="#">Soins du visage : <br>  <span class="sous">Nettoyants</span><br> <span class="sous">Crèmes</span><br><span class="sous">Masques</span></a>
        <a class="dropdown-item" href="#">Soins du corps : <br>  <span class="sous">Hydratants</span><br> <span class="sous">Huiles</span><br><span class="sous">Gels Douche</span></a>
        <a class="dropdown-item" href="#">Soins des cheveux : <br>  <span class="sous">Shampooings</span><br> <span class="sous">Après-Shampooings</span><br><span class="sous">Masques capillaires</span></a>
      </div>
    </div>
  </header>


<main class="contenu">

    <p class="titre_section">Votre coup de coeur : </p>
    <section id="produit_unique">
        <?php
            
            include "./php_config.php";
            if ($connection === true) {     //vérifie si l'instance est bien crée    
                $id = $_GET['id'];
                $sql = "SELECT * FROM products WHERE id = $id";
                foreach ($pdo->query($sql) as $row) {
                    $name = $row['name'];
                    $price = $row['price'];
                    $cat = $row['category_id'];
                    $description = $row['description'];
                    $sql = "SELECT category FROM categories WHERE id = $cat";
                    $query_cat = $pdo->prepare($sql);
                    $query_cat->execute();
                    $array_cat = $query_cat->fetch(PDO::FETCH_ASSOC);
                    $cat_name = $array_cat["category"];
                    $img = '<img class="img_produit_unique" src="data:image/png;base64,' . base64_encode($row['img_blob']) . '" />';
                        echo '
                        <article class="produit_id">'
                            . $img . 
                            '<div class="achat_unique">
                            <h3>'.$name.'</h3>
                            <h5>'.$cat_name.'</h5>
                           <p>' . $description . '</p>
                                <p class="prix">'.$price.'€</p>
                                <a href=""><img src="img/cart.png"></a>
                                
                            </div>
                            
                        </article>
                        ';
                        }
                }
                else{//si $pdo n'est pas une instance de PDO
                    throw new Exception("erreur");
                }

        ?>
    </section>



  <div class="ligne">
    <!--ligne4-->
    <div class="row3"><img src="cremejouvence.jpg" alt="Creme Jouvence Bio"></div>

  </div>

  <div class="ligne">
    <!--ligne5-->
    <div class="row4">VOS AVANTAGES : </div>
    <div class="row4">3 échantillons offerts</div>
    <div class="row4">Livraison sous 48h</div>
    <div class="row4">Paiement sécurisé</div>
  </div>

</main>

<footer>
  <div>
    <ul><h6>BESOIN D'AIDE?</h6>
    <li><a href="">Contactez-nous</a></li>
    <li><a href="">FAQ</a></li>
    <li><a href="">Paiement</a></li>
    <li><a href="">Livraison</a></li>
    <li><a href="">Retour et échanges</a></li>
    </ul>
  </div>
  <div>
    <ul><h6>MON COMPTE</h6>
    <li><a href="">S'inscrire</a></li>
    <li><a href="">Se connecter</a></li>
    <li><a href="">Suivi de mes commandes</a></li>
    </ul>
  </div>
  <div>
    <ul><h6>Notre marque</h6>
    <li><a href="">Qui sommes-nous?</a></li>
    <li><a href="">Nos engagements</a></li>
    <li><a href="">Contact</a></li>
    </ul>
  </div>
  <div>
    <ul><h6>Réseaux sociaux</h6>
    <li><a href=""><img src="" />Facebook</a>
    <li><a href=""><img src="" />Instagram</a>
    <li><a href=""><img src="" />YouTube</a>
    </ul>
  </div><br/>
<div><p>Copyright @2020 Marque</p></div>
</footer>
</body>
</html>

