<?php 
session_start();

if (isset($_POST['itemId'])) {
    $id_item = $_POST['itemId'];
    $date = date('Y-m-d');

    include('connect_bdd.php');

    if (isset($_SESSION['id_number'])) {
        $user_id = $_SESSION['id_number'];

        $sql_insert_acquisition = "INSERT INTO acquisition (user_Id, item_Id, `Date achat`, Obtenu) VALUES (:user_id, :item_id, :date_achat, 1)";
        $result_insert_acquisition = $db->prepare($sql_insert_acquisition);
        $result_insert_acquisition->bindParam(':user_id', $user_id);
        $result_insert_acquisition->bindParam(':item_id', $id_item);
        $result_insert_acquisition->bindParam(':date_achat', $date);
        $result_insert_acquisition->execute();

        header("Location: shop.php");
    }
    else {
        echo "Sessions utilisatuer non trouvée. Veuillez vous connecter.";
    }
}
else {
    echo "Identifiant de l'item non reçu.";
}

?>