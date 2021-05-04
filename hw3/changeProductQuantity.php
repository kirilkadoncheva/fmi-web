<?php 
 
require_once("db.php");

function addProduct($productId, $quantity) {

    try {

        $db = new DB();
        $connection = $db->getConnection();

        $sql = "UPDATE products SET quantity=quantity+$quantity WHERE id=$productId";

        $stmt = $connection->prepare($sql);
        $connection->beginTransaction();
        $stmt->execute();
        $connection->commit();

    } catch (PDOException $e) {
        $connection->rollBack();
        echo $e->getMessage();
    }
}

if(isset($_POST["productId"]) && isset($_POST["quantity"])) {
    $productId = $_POST["productId"];
    $quantity = $_POST["quantity"];
    if($quantity > 0) {
        addProduct($productId, $quantity);
    }
    
}

header("Location: index.php");
exit;
?>