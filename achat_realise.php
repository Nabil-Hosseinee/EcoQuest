<?php 
session_start();

if (isset($_POST['itemId'])) {
    $id_item = $_POST['itemId'];
    $date = date('Y-m-d');

    include('connect_bdd.php');

    if (isset($_SESSION['id_number'])) {
        $user_id = $_SESSION['id_number'];

        // on récup sa monnaie
        $demandeMonnaie = "SELECT Monnaie FROM user WHERE Id_user = $user_id";
        $resultMonnaie = $db->prepare($demandeMonnaie);
        $resultMonnaie->execute();
        $defMonnaie = $resultMonnaie->fetchAll(PDO::FETCH_ASSOC);

        foreach ($defMonnaie as $defMonnaies) {
            $argent = $defMonnaies['Monnaie'];
        }

        // on récup le prix de l'item
        $demandePrix = "SELECT Prix FROM item WHERE Id_item = $id_item";
        $resultPrix = $db->prepare($demandePrix);
        $resultPrix->execute();
        $defPrix = $resultPrix->fetchAll(PDO::FETCH_ASSOC);

        foreach ($defPrix as $defPrixs) {
            $prix = $defPrixs['Prix'];
        }

        // condition d'achat
        if ($argent >= $prix) {
            $sql_insert_acquisition = "INSERT INTO acquisition (user_Id, item_Id, `Date achat`, Obtenu) VALUES (:user_id, :item_id, :date_achat, 1)";
            $result_insert_acquisition = $db->prepare($sql_insert_acquisition);
            $result_insert_acquisition->bindParam(':user_id', $user_id);
            $result_insert_acquisition->bindParam(':item_id', $id_item);
            $result_insert_acquisition->bindParam(':date_achat', $date);
            $result_insert_acquisition->execute();
            // header("Location: shop.php");

            // condition après achat pour réduire l'argent
            if ($result_insert_acquisition->execute() == true) {
                $sql_update_user_monnaie = "UPDATE user SET Monnaie = Monnaie - $prix WHERE Id_user = $user_id";
                $result_update_user_monnaie = $db->prepare($sql_update_user_monnaie);
                $result_update_user_monnaie->execute();
                header("Location: shop.php");
            }
        }
        else {
            echo "<script>alert('Vous n'avez pas assez d'argent pour acheter cet item.');</script>";
            header("Location: shop.php");
        }
    }
    else {
        echo "Sessions utilisatuer non trouvée. Veuillez vous connecter.";
    }
}
else {
    echo "Identifiant de l'item non reçu.";
}

?>