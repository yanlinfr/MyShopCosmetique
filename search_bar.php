<?php
function getDatabaseConnexion()
{
   try {
      $user = "vincent";
      $pass = "root";
      $pdo = new PDO('mysql:host=localhost;dbname=my_shop', $user, $pass);
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
<form method="GET">
<input type="search" name="search" placeholder="Search..." value="<?php echo $_GET['search']?>"/>
   <div class="form-group">
      <label for="filter">Trier par</label>
      <select class="form-control" name="sort">
         <option value="1">NAME ascendant</option>
         <option value="2">NAME descendant</option>
         <option value="3">prix ascendant</option>
         <option value="4">prix descendant</option>
      </select>
   </div>
   <input type="submit" value="valider" />
</form>
<?php if (isset($products) && $products->rowCount() > 0) { ?>
   <ul>
      <?php while ($a = $products->fetch()) { ?>
         <li><?= $a['name'] ?></li>
      <?php } ?>
   </ul>
<?php } else {  ?>
   Aucun résultat pour: <?= $_GET['search'] ?>...
<?php }