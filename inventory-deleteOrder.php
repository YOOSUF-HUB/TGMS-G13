<?php
include 'php/config.php';


if (isset($_GET['deleteid'])) {
    $order_id = $_GET['deleteid'];
    
    $delete_query = "DELETE FROM Orders WHERE Order_ID = '$order_id'";

    // Execute the query
    if (mysqli_query($conn, $delete_query)) {
        header("Location: inventory-Orders.php");
    } else {
        echo "<p style='color: red; text-align: center;'>Failed to Delete: " . mysqli_error($conn) . "</p>";
    }
}
?>


