<?php
include 'php/config.php';

// Check if the deleteid parameter is set
if (isset($_GET['deleteid'])) {
    // Sanitize the input to prevent SQL injection
    $Customer_ID = mysqli_real_escape_string($conn, $_GET['deleteid']);

    // Use single quotes around the VARCHAR value in the query
    $sql = "DELETE FROM Customer_account WHERE Customer_ID = '$Customer_ID'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "<p style='color: green; text-align: center;'>Successfully Deleted</p>";
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
