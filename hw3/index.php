<?php 
 
 require_once("db.php");


 function fetchProducts() {
    $db = new DB();
    $connection = $db->getConnection();
    $sql = "SELECT * FROM products";
    $result = $connection->query($sql);
    
    $products = $result->fetchAll(PDO::FETCH_ASSOC);
   
   
    foreach($products as $row) {
        echo "<tr>";
        echo "<td>" . $row["ID"] . "</td>";
        echo "<td>" . $row["PRODUCT_NAME"]  . "</td>";
        echo "<td>" . $row["QUANTITY"] . "</td>";
        echo "</tr>";
    }
 }

 ?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            th,td {
                border: 1px solid black;
            }

            table, h3, form {
                padding-left: 20px;
            }

        </style>
    </head>
    <body>
        <h3>Available Products:</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>QUANTITY</th>
            </tr>
            <?php fetchProducts() ?>
        </table>

        <h3>Add new product:</h3>
        <form action="addProduct.php" method="post">
            <input type="text" placeholder="ID" name="productId" />
            <input type="text" placeholder="Name" name="name" />
            <input type="text" placeholder="Quantity" name="quantity" />
            <input type="submit" />
        </form>

        <h3>Add product:</h3>
        <form action="changeProductQuantity.php" method="post">
            <input type="text" placeholder="ID" name="productId" />
            <input type="text" placeholder="Quantity" name="quantity" />
            <input type="submit" />
        </form>

        <h3>Buy product:</h3>
        <form action="buyProduct.php" method="post">
            <input type="text" placeholder="ID" name="productId" />
            <input type="text" placeholder="Quantity" name="quantity" />
            <input type="submit" />
        </form>
    </body>
</html>



