<?php 
 
require_once("db.php");

function addNewProduct($productId, $quantity, $name) {

    if($quantity < 0) {
        displayError("Product quantity must be >= 0!");
        return false;
    } 
    try {
        $db = new DB();
        $connection = $db->getConnection();

        $sql = "INSERT into products VALUES (\"$productId\", \"$name\", $quantity)";

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

if(isset($_POST["productId"]) && isset($_POST["quantity"]) && isset($_POST["name"])) {
    
    $productId = $_POST["productId"];
    $quantity = $_POST["quantity"];
    $name = $_POST["name"];
    
    if(addNewProduct($productId, $quantity, $name)) {
        header("Location: index.php");
    }
}

function displayError($errorMessage) {
    echo $errorMessage;

    echo "<form method=\"POST\" action=\"index.php\"> <input value=\"Go Back\" type=\"submit\"/> </form>";
}


?>