
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

function getAllUsers()
{
    $con = getDatabaseConnexion();
    $sql = 'SELECT id, username, email, admin FROM users';
    $rows = $con->query($sql);
    return $rows;
}

function readUser($id)
{
    $con = getDatabaseConnexion();
    $sql = "SELECT * FROM users WHERE id = $id";
    $statement = $con->query($sql);
    $row = $statement->fetchAll();
    if (!empty($row)) {
        return $row[0];
    }
}

function createUser($username, $password, $email, $admin)
{
    try {
        $con = getDatabaseConnexion();
        $sql = "INSERT INTO users (username, password, email, admin)
            VALUES ('$username', '$password', '$email', '$admin')";
        $con->exec($sql);
    } catch (PDOException $e) {
        echo $sql . "<br/>" . $e->getMessage();
    }
}

function updateUser($username, $password, $email, $admin, $id)
{

    try {
        $con = getDatabaseConnexion();
        $sql = "UPDATE users SET
                username = '$username',
                password = '$password',
                email = '$email',
                admin = '$admin'
                WHERE id = '$id'";
        $con->exec($sql); 
    } 
    catch (PDOException $e) {
        echo $sql . "<br/>" . $e->getMessage();
    }
}

function deleteUser($id)
{
    try{
    $con = getDatabaseConnexion();
        $sql = "DELETE FROM users WHERE id = '$id'";
        $statement =$con->query($sql);
    } 
    catch (PDOException $e) {
        echo $sql . "<br/>" . $e->getMessage();
    }
}
  
function getNewUser() {
    $user['id'] = "";
    $user['username'] = "";
    $user['email'] = "";
    $user['password'] = "";
    $user['admin'] = "";

    
}
