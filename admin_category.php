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
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="admin.php">Tous les produits <br></a><span class="sous"><a href="admin_category.php">Toutes les catégories</a></span><br>
        <a class="dropdown-item" href="users.php">Tous les utilisateurs</a>
      </div>
    </div>
  </header>

  <main>
  
      <!--ligne3-->
      <div class="row3 titre_admin">
        <h2>Gestion des catégories</h2>
      </div>

    <!--BOUTON ajouter un produit-->

    <section id="gestion_des_category">
      <?php
      include "./php_config.php";
      
include "./CRUD_category/create_category.php";
if (isset($_POST['category'])) {
    create_cat();
}
include "./CRUD_category/create_subcategory.php";
if (isset($_POST['subcategory'])) {
    create_subcat();
}
include "./CRUD_category/delete_category.php";
if (isset($_POST['id'])&& !isset($_POST['nouveau_parent_id'])) {
    delete_category();
}
include "./CRUD_category/update_category_parent.php";
if (isset($_POST['nouveau_parent_id'])) {
    update_category_parent();
}
include "./CRUD_category/update_category.php";
if (isset($_POST['parent_id_update'])) {
    update_category();
}
      ?>
      <div class="create_cat_div">
        <h5>Création</h5>
    <form  action="admin_category.php" method="post">
        <input type="text" name="category" placeholder="Nom de la catégorie">
        <input type="submit" value="créer une catégorie"/>
    </form>
    <form action="admin_category.php" method="post">
        <input type="text" name="subcategory" placeholder="Nom de la sous-catégorie">
        <select name="parent_id">
            <?php
                $sql = "SELECT category,id FROM categories WHERE parent_id = 0";
                foreach ($pdo->query($sql) as $row) {
                    $sub_category_name = $row['category'];
                    $id_cat = $row['id'];
                    echo "<option value=$id_cat >$sub_category_name</option>";
                }
            ?>
        </select>
        <input type="submit" value="créer une sous-catégorie" />
    </form>
      </div>
    <div class="modification_category_div">
      <h5>Modification</h5>
      <form action="admin_category.php" method="post">
        <label for="parent_id">Sélectionner la catégorie à déplacer :</label>
        <select name="parent_id">
            <?php
                $sql = "SELECT * FROM categories";
                foreach ($pdo->query($sql) as $row) {
                    $category_name = $row['category'];
                    $id_cat = $row['id'];
                    echo "<option value=$id_cat>$category_name</option>";
                }
            ?>
        </select>
        <label for="nouveau_parent_id">Sélectionne le nouveau parent : </label>
        <select name="nouveau_parent_id">
            <option value=0>aucun parent</option>
            <?php
                $sql = "SELECT * FROM categories";
                foreach ($pdo->query($sql) as $row) {
                    $category_name = $row['category'];
                    $id_new_cat = $row['id'];
                    echo "<option value=$id_new_cat>$category_name</option>";
                }
            ?>
        </select>
        <input type="submit" value="Valider" />
    </form>
    <form action="admin_category.php" method="post">
        <label for="parent_id_update">Sélectionner la catégorie à modifier :</label>
        <select name="parent_id_update">
            <?php
                $sql = "SELECT * FROM categories WHERE parent_id=0";
                foreach ($pdo->query($sql) as $row) {
                    $category_name = $row['category'];
                    $id_cat = $row['id'];
                    echo "<option value=$id_cat>$category_name</option>";
                }
            ?>
        </select>
        <input type="text" placeholder="Nouveau nom de catégorie" name="value">
        <input type="submit" value="Valider" />
    </form>
    <form action="admin_category.php" method="post">
        <label for="parent_id_update">Sélectionner la catégorie à modifier :</label>
        <select name="parent_id_update">
            <?php
                $sql = "SELECT * FROM categories WHERE NOT parent_id=0";
                foreach ($pdo->query($sql) as $row) {
                    $category_name = $row['category'];
                    $id_cat = $row['id'];
                    echo "<option value=$id_cat>$category_name</option>";
                }
            ?>
        </select>
        <input type="text" placeholder="Nouveau nom de sous-catégorie" name="value">
        <input type="submit" value="Valider" />
    </form>
    </div>
    <div class="delete_category_id">
      <h5>Suppression</h5>
    <form action="admin_category.php" method="post">
        <label for="id">Sélectionner la catégorie à supprimer :</label>
        <select name="id">
            <?php
                $sql = "SELECT * FROM categories";
                foreach ($pdo->query($sql) as $row) {
                    $category_name = $row['category'];
                    $id_cat = $row['id'];
                    echo "<option value=$id_cat>$category_name</option>";
                }
            ?>
        </select>
        <input type="submit" value="supprimer"/>
    </form>
    </div>
    
    </section>
  </main>

</body>

</html>







<style>
  .titre_admin{
        text-align: center;
        margin-top: 1em;
    }
    .create_cat_div form, .modification_category_div form, .delete_category_id form{
      margin: auto;
      display: flex;
      width: 50%;
    }
    .delete_category_id {
      padding-bottom: 2em;
    }
    #gestion_des_category h5{
      margin:auto;
      margin-top: 1em;
      width: 200px;
    }
    .create_cat_div form:nth-child(3), .modification_category_div form:nth-child(4){
      border-bottom: 1px solid grey;
      padding-bottom: 1em;
    }
    .modification_category_div form:nth-child(-n+3){
      border-bottom: 1px dashed grey;
      padding-bottom: 1em;
    }
    .create_cat_div input, .modification_category_div input, .delete_category_id input{
      margin:1em;
      height:35px;
    }
    .modification_category_div p, .modification_category_div label, .delete_category_id label{
      margin:1em;
    }
    .create_cat_div select, .modification_category_div select, .modification_category_div input, .delete_category_id select{
      height:35px;
      margin-top:auto;
      margin-bottom:auto;
    }
    </style>