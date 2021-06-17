<?php
include 'requetes_sql_user.php';
$host = "localhost";
$username = "vincent";
$password = "root";
$database = "my_shop";
$message  = "";

session_start();

try {
  $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
  $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if (isset($_POST["login"])) {
    if (empty($_POST["username"])  || empty($_POST["password"])) {
      $message = '<label>All field is required</lable>';
    } else {
      $usr =  $_POST["username"];
      $pwd = $_POST["password"];

      $query = "SELECT * FROM users WHERE username = :username";

      $statement = $connect->prepare($query);
      $statement->execute(
        array(
          'username'   =>  $usr
        )
      );
      $count = $statement->rowCount();
      $user = $statement->fetch();

      if ($count > 0) {

        if (password_verify($pwd, $user["password"])) {

          $_SESSION["username"] = $_POST["username"];
          if ($user["admin"] === "1") {
            $_SESSION["admin"] = 1;
            header("location:admin.php");
          } else {
            $_SESSION["admin"] = 0;
            header("location:index.php");
          }
        } else {
          header("HTTP/1.1 401 Unauthorized");
          $message = '<label>Username OR Password is wrong</label>';
        }
      } else {
        header("HTTP/1.1 401 Unauthorized");
        $message = '<label>Username OR Password is wrong</label>';
      }
    }
  }
} catch (PDOException $error) {
  $message = $error->getMessage();
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>S'identifier sur YamaVie</title>
  <!---->

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="stylesignup.css" />
  <link rel="stylesheet" type="text/css" href="style_1.css" />
  <link rel="icon" type="image/png" href="img/yamavie-icon.png" />
</head>

<body>
  <header>
    <div id="ligne_haut" class="d-none d-lg-flex d-xl-flex">
    <a href="index.php"><img src="img/yamavie-logo.png" id="logo"></a>
      <div>
        <div id="compte">
          <a href="signup.php">S'inscrire</a>
          <a href="signin.php">Se connecter</a>
          <a href="" id="cart"><img src="img/cart.png" />Mon panier</a>
        </div>
        <form action="search.php" method="GET">
          <!--Envoie le texte au fichier de recherche php-->
          <input type="search" name="search" id="search_bar" placeholder="recherche" value=<?php echo '"'.$_GET['search'].'"'; ?>>
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
          <input type="search" name="search" id="search_bar_mobile" placeholder="recherche" value=<?php echo '"'.$_GET['search'].'"'; ?>>
          <input type="hidden" name="sort" value="1">
          <input type="image" src="img/search.png" alt="Submit" id="search_img_mobile">
        </form>
        <a href="" id="cart_mobile"><img src="img/cart.png" /></a>
      </div>
    </div>
    <nav class="d-none d-lg-flex d-xl-flex">
      <ul class="menu">
        <li class="menu-item"><a href="#">Tous les produits</a></li>
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
        <a class="dropdown-item" href="signin.php">Se connecter</a>
        <a class="dropdown-item" href="signup.php">S'inscrire</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Tous les produits</a>
        <a class="dropdown-item" href="#">Soins du visage : <br>  <span class="sous">Nettoyants</span><br> <span class="sous">Crèmes</span><br><span class="sous">Masques</span></a>
        <a class="dropdown-item" href="#">Soins du corps : <br>  <span class="sous">Hydratants</span><br> <span class="sous">Huiles</span><br><span class="sous">Gels Douche</span></a>
        <a class="dropdown-item" href="#">Soins des cheveux : <br>  <span class="sous">Shampooings</span><br> <span class="sous">Après-Shampooings</span><br><span class="sous">Masques capillaires</span></a>
      </div>
    </div>
  </header>

  <main>

    <div class="signup-form">
      <form action="signin.php" method="post">
        <h3>Se connecter</h3>
        <?php
        if (isset($message)) {
          echo '<label class="text-danger">' . $message . '</label>';
        }
        ?>
        <hr>
        <div class="form-group">
        </div>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-paper-plane"></i></span>
            <input type="username" class="form-control" name="username" placeholder="Username " required="required">
          </div>
        </div>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            <input type="password" class="form-control" name="password" placeholder="Mot de passe" required="required">
          </div>
        </div>

        <div class="form-group">
          <button type="submit" name="login" class="btn btn-primary btn-lg">SE CONNECTER</button><br/>
          <p></p>
          <p class="text-center"> NOUVEAUX UTILISATEURS<br/>
            <a class="text-center" href="/signup.php">Enregistrez-vous et profitez des avantages clients!</a></p>
          
        </div>
      </form>
      <div class="text-center"><a href="#">Mot de passe oublié ?</a></div>
    </div>

  </main>



  <div class="ligne">
    <!--ligne5-->
    <div class="row4">VOS AVANTAGES :</div>
    <div class="row4">3 échantillons offerts</div>
    <div class="row4">Livraison sous 48h</div>
    <div class="row4">Paiement sécurisé</div>
  </div>
  </main>

  <footer>
    <div>
      <ul>
        <h6>BESOIN D'AIDE?</h6>
        <li><a href="">Contactez-nous</a></li>
        <li><a href="">FAQ</a></li>
        <li><a href="">Paiement</a></li>
        <li><a href="">Livraison</a></li>
        <li><a href="">Retour et échanges</a></li>
      </ul>
    </div>
    <div>
      <ul>
        <h6>MON COMPTE</h6>
        <li><a href="signup.php">S'inscrire</a></li>
        <li><a href="signin.php">Se connecter</a></li>
        <li><a href="">Suivi de mes commandes</a></li>
      </ul>
    </div>
    <div>
      <ul>
        <h6>NOTRE MARQUE</h6>
        <li><a href="">Qui sommes-nous?</a></li>
        <li><a href="">Nos engagements</a></li>
        <li><a href="">Contact</a></li>
      </ul>
    </div>
    <div>
      <ul>
        <h6>RESEAUX SOCIAUX</h6>
        <li>
          <a href=""><img src="" />Facebook</a>
        </li>
        <li>
          <a href=""><img src="" />Instagram</a>
        </li>
        <li>
          <a href=""><img src="" />YouTube</a>
        </li>
      </ul>
    </div>
  </footer>
</body>

</html>