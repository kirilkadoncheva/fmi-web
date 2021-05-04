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

    if($currentQuantity < $quantity || $quantity < 0) {
        displayError("There is not enough stock of product with id: " . $productId . "!");
        return false;
    }
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
        displayError($e->getMessage());
        return false;
    }
}

function displayError($errorMessage) {
    echo $errorMessage;

    echo "<form method=\"POST\" action=\"index.php\"> <input value=\"Go Back\" type=\"submit\"/> </form>";
}

if(isset($_POST["productId"]) && isset($_POST["quantity"])) {
    
    $productId = $_POST["productId"];
    $quantity = $_POST["quantity"];
   
    if (buyProduct($productId, $quantity)) {
        header("Location: index.php");
    }


} else {
    displayError("ProductId or quantity was not set!");
}


?>