<?php
include 'php/config.php';


if (isset($_GET['deleteid'])) {
    $Supplier_ID = $_GET['deleteid'];
    
    $delete_query = "DELETE FROM Supplier WHERE Supplier_ID = '$Supplier_ID'";

    // Execute the query
    if (mysqli_query($conn, $delete_query)) {
        header("Location: inventory-Supplier.php");
    } else {
        echo "<p style='color: red; text-align: center;'>Failed to Delete: " . mysqli_error($conn) . "</p>";
    }
}
?>


