<?php
// Include the database connection file
include 'config.php';

// Check if Customer_ID is provided via POST
if (isset($_POST['Customer_ID'])) {
    $customer_id = $_POST['Customer_ID'];

    // SQL query to delete the customer with the given Customer_ID
    $sql = "DELETE FROM Customer_account WHERE Customer_ID = ?";
    
    // Prepare statement to prevent SQL injection
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $customer_id);  // Bind the Customer_ID to the query

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect back to AdminDashboard.php with a success message
            header("Location: ../AdminDashboard.php?message=Customer account deleted successfully");
        } else {
            // Redirect back with an error message
            header("Location: ../AdminDashboard.php?message=Error deleting customer account");
        }

        // Close statement
        $stmt->close();
    } else {
        header("Location: ../AdminDashboard.php?message=Failed to prepare SQL statement");
    }
} else {
    // Redirect if no Customer_ID is provided
    header("Location: ../AdminDashboard.php?message=No customer selected for deletion");
}

// Close the database connection
$conn->close();
?>
