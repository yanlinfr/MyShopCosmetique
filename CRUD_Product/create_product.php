<?php
//mettre un if admin = true.

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

  <link rel="stylesheet" type="text/css" href="../styleadmin.css" />
  <link rel="stylesheet" type="text/css" href="../style_1.css" />
  <link rel="icon" type="image/png" href="../img/yamavie-icon.png" />
</head>

<body>
  <header>
    <!--ci-dessous : Div logo, Div interface admin + se déconnecter, Form search bar admin-->
    <div id="ligne_haut" class="d-none d-lg-flex d-xl-flex">
      <img src="../img/yamavie-logo.png" id="logo">
      <div>
        <div id="compte">
          <p>Interface Administrateur</p>
          <a href="">Se déconnecter</a>
        </div>
        <form action="" method="GET">
          <!--Envoie le texte au fichier de recherche php-->
          <input type="text" name="recherche" id="search_bar" placeholder="recherche Administrateur">
          <input type="image" src="../img/search.png" alt="Submit" id="search_img">
        </form>
      </div>
    </div>
    <!-- DIV version mobile : logo, form search bar admin, interface admin-->
    <div id="ligne_haut_mobile" class="d-lg-none d-xl-none">
      <img src="../img/yamavie-logo.png" id="logo_mobile">
      <div>
        <form action="" method="GET">
          <!--Search bar, method :"get" : Envoie le texte au fichier de recherche php-->
          <input type="text" name="recherche" id="search_bar_mobile" placeholder="recherche">
          <input type="image" src="../img/search.png" alt="Submit" id="search_img_mobile">
        </form>
        <p>Interface Administrateur</p>
      </div>
    </div>
    <nav class="d-none d-lg-flex d-xl-flex">
      <ul class="menu">
        <li class="menu-item"><a href="admin.html">Tous les produits</a></li>
        <li class="menu-item"><a href="users.html">Tous les utilisateurs</a></li>
      </ul>
    </nav>
    <!--div avec MENU HAMBURGER VIEW MOBILE. Choix menu déroulant: se déconnecter, tous les produits, tous les utilisateurs-->
    <div class="btn-group dropleft d-lg-none d-xl-none" id="menu_mobile">
      <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        &#9776;
      </button>
      <div class="dropdown-menu">
        <!-- Dropdown menu links -->
        <a class="dropdown-item" href="#">Se déconnecter</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="admin.html">Tous les produits</a>
        <a class="dropdown-item" href="users.html">Tous les utilisateurs</a>
      </div>
    </div>
  </header>

  <main>
      <!--ligne3-->
      <div class="row3 titre_admin">
        <h2>Ajouter un produit</h2>
    </div>

    <!--BOUTON ajouter un produit-->

<?php
//cette page crée un produit dans la table products
include "../php_config.php";
if ($connection === true) {
    /*$_FILES pour récupérer le contenu binaire(img)*/
    /*stocker temporairement puis récuperer le fichier*/
    //blob => fichier
    if ($img = is_uploaded_file($_FILES['img']['tmp_name'])) { //stock l'image temporairement
        $img_blob = file_get_contents($_FILES['img']['tmp_name']); //retrouve l'image
        $sql = "INSERT INTO products (name, price, category_id, img_blob, description)
                    VALUES (?, ?, ?, ?, ?)"; //requête les "?" permettent de passer les argument par références avec un tableau et les varibles en $ dedans
        $querry = $pdo->prepare($sql); //prépare la requête
        $name = $_POST['name'];/*à récupérer du post */
        $price = $_POST['price'];/*à récupérer du post */
        $category = $_POST['category'];/*à récupérer du post */
        $description =$_POST['description'];
        if ($querry->execute([$name, $price, $category,  ($img_blob), $description]) === TRUE) { //éxectue la requête et si elle a réussi : éxéction du if
            echo "<p class='msg_php'>Nouveau produit enregistré</p>";
        } else { //si la requête n'a pas fonctionnée
            echo "Error: invalid picture <br>";
        }
    }
}
?>
    <form enctype="multipart/form-data" action="create_product.php" method="post" id="add_product">
        <!-- enctype="multipart/form-data" afin que le navigateur du client transfère les données binaires correctement-->
        <div><input type="hidden" name="MAX_FILE_SIZE" value="250000" />
        <label for="img">image :</label>
        <!--MAX_FILE_SIZE permet d'empêcher la taille supérieur à 250 000 octet-->
        <input type="file" name="img" id="img" size=50 />
      </div>
        <input type="text" name="name" placeholder="nom">
        <input type="number" name="price" placeholder="prix">
        <select name="category">
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
        <textarea type="test" name="description" >description"</textarea>
        <input type="submit" value="Envoyer">
        <a class='msg_php' href='../admin.php'>retour</a>
    </form>
    
  </main>
</body>

</html>

<style>
    #add_product{
      margin-top: 1.5em;
      display: flex;
      flex-direction: column;
    }
    #add_product input,#add_product label,#add_product textarea, #add_product select, #add_product div{
      display: flex;
        text-align: center;
        margin: auto;
        margin-bottom:1em;
          width: 300px;
      }
      #add_product textarea{
        height: 200px;
        width: 600px;
    }
    .titre_admin{
        text-align: center;
        margin-top: 1em;
    }
    .msg_php{
      text-align: center;
      margin: auto;
      margin-bottom: 2em;
      min-width: 100px;
    }
    </style>
