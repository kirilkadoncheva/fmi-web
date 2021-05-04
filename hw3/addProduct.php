<?php 
 
require_once("db.php");

if(isset($_POST["productId"]) && isset($_POST["quantity"]) && isset($_POST["name"])) {
    
    $productId = $_POST["productId"];
    $quantity = $_POST["quantity"];
    $name = $_POST["name"];
    try {

        $db = new DB();
        $connection = $db->getConnection();

        $sql = "INSERT into products VALUES (\"$productId\", \"$name\", $quantity)";

        echo "start transaction";
        $stmt = $connection->prepare($sql);
        $connection->beginTransaction();
        $stmt->execute();
        $connection->commit();


    } catch (PDOException $e) {
        $connection->rollBack();
        echo $e->getMessage();
    }

}

header("Location: index.php");
exit;
?>