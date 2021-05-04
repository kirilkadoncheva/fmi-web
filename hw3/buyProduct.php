<?php 
 
require_once("db.php");

function getProductQuantity($productId) {
    try {
        $db = new DB();
        $connection = $db->getConnection();
    
        $sql = "SELECT QUANTITY from products WHERE id=$productId";
    
        $stmt = $connection->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row["QUANTITY"];    
        }
    catch (PDOException $e) {
        echo $e->getMessage();
        return null;
    }
} 
  
function buyProduct($productId, $quantity) {
    $currentQuantity = getProductQuantity($productId);

    if($currentQuantity < $quantity || $quantity < 0) return false;

    try {

        $db = new DB();
        $connection = $db->getConnection();

        $sql = "UPDATE products SET quantity=quantity-$quantity WHERE id=$productId";

        $stmt = $connection->prepare($sql);
        $connection->beginTransaction();
        $stmt->execute();
        $connection->commit();

        return true;

    } catch (PDOException $e) {
        $connection->rollBack();
        echo $e->getMessage();
        return false;
    }
}


if(isset($_POST["productId"]) && isset($_POST["quantity"])) {
    
    $productId = $_POST["productId"];
    $quantity = $_POST["quantity"];
   
    buyProduct($productId, $quantity);

}

header("Location: index.php");
exit;
?>