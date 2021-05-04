<?php 
 
require_once("db.php");

function addProduct($productId, $quantity) {

    if($quantity < 0) {
        displayError("Product quantity you want to add is < 0!");
        return false;
    } 
    try {

        $db = new DB();
        $connection = $db->getConnection();

        $sql = "UPDATE products SET quantity=quantity+$quantity WHERE id=$productId";

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

if(isset($_POST["productId"]) && isset($_POST["quantity"])) {
    $productId = $_POST["productId"];
    $quantity = $_POST["quantity"];

    if(addProduct($productId, $quantity)) {
        header("Location: index.php");
    }
    
}

function displayError($errorMessage) {
    echo $errorMessage;

    echo "<form method=\"POST\" action=\"index.php\"> <input value=\"Go Back\" type=\"submit\"/> </form>";
}


?>