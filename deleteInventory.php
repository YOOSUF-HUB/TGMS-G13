<?php
include 'php/config.php';


if (isset($_GET['deleteid'])) {
    $Customer_ID = $_GET['deleteid'];
    
    $sql = "DELETE FROM Customer_account WHERE Customer_ID = '$Customer_ID'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "<p style='color: green; text-align: center;'>Successfully Deleted</p>";
        header("Location: AdminDashboard.php");
    } else {
        echo "<p style='color: red; text-align: center;'>Failed to Delete: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!-- Redirect to Dashboard Button -->
<div style="text-align: center; margin-top: 20px;">
    <a href="AdminDashboard.php">
        <button style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Return to Dashboard
        </button>
    </a>
</div>
