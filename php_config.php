<?php
$host = "localhost"; /* Host name */
$user = "vincent"; /* User */
$password = "root"; /* Password */
$dbname = "my_shop"; /* Database name */

try {
    $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . ';port=3360', $user, $password); //crée l'instance de PDO pour pouvoir l'utiliser.
    if ($pdo instanceof PDO) {
        $connection = true; // Check connection
    } else { //si $pdo n'est pas une instance de PDO
        throw new Exception("erreur");
    }
} catch (Exception $e) {
    echo "PDO ERROR: " . $e->getMessage();
}
