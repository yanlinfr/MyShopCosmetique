<?php
function delete_category()
{
    include "./php_config.php"; {
        if ($connection === true && isset($_POST['id'])) {
            $id = $_POST['id'];
            $sql = "DELETE FROM categories WHERE id=$id";
            $querry = $pdo->prepare($sql);
            if ($querry->execute() === true) {
                echo "Operation was a succes !";
            } else {
                echo "error in querry request";
            }
        }
    }
}
