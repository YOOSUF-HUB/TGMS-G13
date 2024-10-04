<?php
include 'php/config.php';


if (isset($_GET['deleteid'])) {
    $Product_ID = $_GET['deleteid'];
    
    $delete_query = "DELETE FROM Inventory WHERE Product_ID = '$Product_ID'";

    // Execute the query
    if (mysqli_query($conn, $delete_query)) {
        header("Location: inventoryPage.php");
    } else {
        echo "<p style='color: red; text-align: center;'>Failed to Delete: " . mysqli_error($conn) . "</p>";
    }
}
?>


