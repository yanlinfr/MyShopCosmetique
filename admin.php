<?php
session_start();
if (!$_SESSION["admin"]) {
  header("HTTP/1.1 403 Forbidden");
  header("location:403.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Cosmétique bio YaMaVie</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="styleadmin.css" />
  <link rel="stylesheet" type="text/css" href="style_1.css" />
  <link rel="icon" type="image/png" href="img/yamavie-icon.png" />
</head>

<body>
  <header>
    <!--ci-dessous : Div logo, Div interface admin + se déconnecter, Form search bar admin-->
    <div id="ligne_haut" class="d-none d-lg-flex d-xl-flex">
    <a href="index.php"><img src="img/yamavie-logo.png" id="logo"></a>
      <div>
        <div id="compte">
        <p>Interface Administrateur</p>
          <?php
          session_start();
          if (isset($_SESSION["username"])) {
            echo '<br><br><a class="dropdown-item" href="logout.php">Se déconnecter</a>';
          }
          ?>
        </div>
        <form action="" method="GET">
          <!--Envoie le texte au fichier de recherche php-->
          <input type="search" name="search" id="search_bar" placeholder="Recherche">
          <input type="image" src="img/search.png" alt="Submit" id="search_img">
        </form>
      </div>
    </div>
    <!-- DIV version mobile : logo, form search bar admin, interface admin-->
    <div id="ligne_haut_mobile" class="d-lg-none d-xl-none">
    <a href="index.php"><img src="img/yamavie-logo.png" id="logo_mobile"></a>
      <div>
        <form action="" method="GET">
          <!--Search bar, method :"get" : Envoie le texte au fichier de recherche php-->
          <input type="search" name="search" id="search_bar_mobile" placeholder="Recherche">
          <input type="image" src="img/search.png" alt="Submit" id="search_img_mobile">
        </form>
        <p>Interface Administrateur</p>
      </div>
    </div>
    <nav class="d-none d-lg-flex d-xl-flex">
      <ul class="menu">
        <li class="menu-item"><a href="admin.php">Tous les produits <br> </a><div class="sous-menus"><a href="admin_category.php">Toutes les catégories</a></div></li>
        <li class="menu-item"><a href="users.php">Tous les utilisateurs</a></li>
      </ul>
    </nav>
    <!--div avec MENU HAMBURGER VIEW MOBILE. Choix menu déroulant: se déconnecter, tous les produits, tous les utilisateurs-->
    <div class="btn-group dropleft d-lg-none d-xl-none" id="menu_mobile">
      <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        &#9776;
      </button>
      <div class="dropdown-menu">
        <!-- Dropdown menu links -->
        <?php
          session_start();
          if (isset($_SESSION["username"])) {
            echo '<br><br><a class="dropdown-item" href="logout.php">Se déconnecter</a>';
          }
          ?>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="admin.php">Tous les produits <br></a><span class="sous"><a href="admin_category.php">Toutes les catégories</a></span><br>
        <a class="dropdown-item" href="users.php">Tous les utilisateurs</a>
      </div>
    </div>
  </header>

  <main>
    <div class="ligne">
      <!--ligne3-->
      <div class="row3 titre_admin">
        <h2>Voici la liste de tous les produits</h2>
      </div>
    </div>

    <!--BOUTON ajouter un produit-->
    <a href="./CRUD_Product/create_product.php" id="ajout_produit"><span>+</span> Ajouter un produit</a>

    <section id="tableau_produits">
    <?php
      
      include "./CRUD_Product/edit_product_id.php";
      if (isset($_GET['var'])) {
          edit_product($_GET['var'],$_POST['value'],$_GET['id']);
      }
      include "./CRUD_Product/edit_img_product.php";
      if (isset($_GET['id_img'])) {
        update_img($_FILES['img']['tmp_name'], $_GET['id_img']);
      }
      include "./CRUD_Product/delete_product.php";
      if (isset($_GET['id']) && !isset($_GET['var'])) {
        delete_product($_GET['id']);
      }
            include "./php_config.php";
            if ($connection === true) {     //vérifie si l'instance est bien crée      
              $sql = "SELECT * FROM products"; //requête les "?" permettent de passer les argument par références avec un tableau et les varibles en $ dedans
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
                $img = '<img class="produit_photo" src="data:image/png;base64,' . base64_encode($row['img_blob']) . '" />';
                $id = $row['id'];
                $msg_glob = $GLOBAL["msg"];
                $supr_msg = "'Êtes-vous sûr de vouloir supprimer ce produit ?'";
                /* le lien envoie vers la page read a product_id avec l'id du produit via un get */
                echo '
              <article>
              <p>' . $msg_glob . '</p>
              <table>
                <tr class=table_column>
                  <td>Image</td>
                  <td>Nom</td>
                  <td>Catégorie</td>
                  <td>Descrpition</td>
                  <td>Prix</td>
                </tr>
                <tr>
                  <td>' . $img . '</td>
                  <td>'.$name.'</td> 
                  <td>'.$cat_name.'</td> 
                  <td> ' . $description . '</td> 
                  <td> '.$price.'€</td>               
                </tr>     
                <tr>
                  <td><form enctype="multipart/form-data" action="admin.php?id_img=' . $id . '" method="post"/>
                  <input type="hidden" name="MAX_FILE_SIZE" value="250000" />
                  <input type="file" name="img"  size=50 />
                  <input type="submit" class="button_input" value="Modifier image" />
                </form></td>
                  <td><form action="admin.php?id=' . $id .'&var=name" method="post">
                  <input type="text" name="value">
                  <input value="Modifier le nom" type="submit" class="button_input">
                  </form></td> 
                  <td><form action="admin.php?id=' . $id .'&var=category_id" method="post">
                  <select name="value">
                              <option value="4" name="4">nettoyants</option>
                              <option value="5" name="5">crèmes</option>
                              <option value="6" name="6">masques</option>
                              <option value="7" name="7">hydratant</option>
                              <option value="8" name="8">huiles</option>
                              <option value="9" name="9">gels douche</option>
                              <option value="10" name="10">shampoings</option>
                              <option value="11" name="11">après-shampoings</option>
                              <option value="12" name="12">masques capillaires</option>
                          </select>
                          <input type="submit" class="button_input" value="Modifier la categorie" />
                  </form></td> 
                  <td><form action="admin.php?id=' . $id . '&var=description" method="post">
                  <textarea name="value" >' . $description . '</textarea>
                  <input value="Modifier la description" type="submit" class="button_input">
              </form></td>
                  <td><form action="admin.php?id=' . $id . '&var=price" method="post">
                  <input type="text" name="value">
                  <input value="Modifier le prix" type="submit" class="button_input"></form> </td>    
                            
                </tr>                                                
              </table>
            
              <div class="delete"><form action="admin.php?id=' . $id . '" class="delete_p" method="post">
              <input type="submit" value="supprimer" onclick="return confirm('. $supr_msg . ');">
            </form>
            <div>
          </article>
              ';
              }
            }
            ?>
       
    </section>
  </main>

</body>

</html>
<style>
  .delete_p, .delete_p input{
    margin:auto;
    width: 200px;
  }
</style>