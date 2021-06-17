<?php
include 'requetes_sql_user.php';
include 'requetes_user_table.php';

session_start();
if (!$_SESSION["admin"]) {
  header("HTTP/1.1 403 Forbidden");
  header("location:403.php");
  exit;
}

$id = $_GET["id"];
if ($id == 0) {
	$user = getNewUser();
	$action = "CREATE";
	$libelle = "Create";
} else {
	$user = readUser($id);
	$action = "UPDATE";
	$libelle = "Update";
}
?>

<html>
<header>
	<meta charset="UTF-8" />
  	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
  	<link rel="stylesheet" href="style_1.css">
  	<link rel="stylesheet" href="styleadmin.css">
  	<link rel="stylesheet" href="styleFormUsers.css">
</header>

<body>

<a href="users.php">Liste des utilisateurs</a>
	<form action="create_update_delete.php" method="get">
		<p>

			<input type="hidden" name="id" value="<?php echo $user['id'];  ?>" />
			<input type="hidden" name="action" value="<?php echo $action;  ?>" />
			<div>
				<label for="username">Utilisateur</label>
				<input type="text" id="username" name="username" value="<?php echo $user['username'];  ?>">
			</div>
			<div>
				<label for="password">Mot de passe</label>
				<input type="password" id="password" name="password" value="">
			</div>
			<div>
				<label for="email">Email</label>
				<input type="text" id="email" name="email" value="<?php echo $user['email'];  ?>">
			</div>
			<div>
				<label for="admin">Admin</label>
        <input type="checkbox" id="admin" name="admin" <?php if ($user['admin']) echo "checked=\"checked\"" ?>> 
			</div>
			<div class="button">
				<button type="submit"><?php echo "Enregistrer";  ?></button>
			</div>
		</p>
	</form>
	<br>

	<?php if ($action != "CREATE") { ?>
		<form action="create_update_delete.php" method="get">
			<input type="hidden" name="action" value="DELETE" />
			<input type="hidden" name="id" value="<?php echo $user['id'];  ?>" />
			<p>
				<div class="button">
					<button type="submit">Supprimer</button>
				</div>
			</p>
		</form>
	<?php } ?>

</body>

</html>