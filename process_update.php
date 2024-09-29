<?php
// Include the database connection file
include 'php/config.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $customer_id = isset($_POST['Customer_ID']) ? trim($_POST['Customer_ID']) : null;
    $first_name = isset($_POST['First_name']) ? trim($_POST['First_name']) : '';
    $last_name = isset($_POST['Last_name']) ? trim($_POST['Last_name']) : '';
    $email = isset($_POST['Email']) ? trim($_POST['Email']) : '';
    $address = isset($_POST['Address']) ? trim($_POST['Address']) : '';
    $phone_no = isset($_POST['Phone_no']) ? trim($_POST['Phone_no']) : '';
    $dob = isset($_POST['Dob']) ? trim($_POST['Dob']) : null;

    // Validate required fields
    if (empty($customer_id) || empty($first_name) || empty($last_name) || empty($email)) {
        echo "Please fill in all required fields.";
        exit;
    }

    // Prepare SQL statement to update customer details
    $sql = "UPDATE Customer_account SET First_name = ?, Last_name = ?, Email = ?, Address = ?, Phone_no = ?, Dob = ? WHERE Customer_ID = ?";
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared correctly
    if ($stmt === false) {
        die("Failed to prepare statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssssi", $first_name, $last_name, $email, $address, $phone_no, $dob, $customer_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the admin dashboard with a success message
        header("Location: AdminDashboard.php?message=Customer details updated successfully.");
        exit; // Ensure no further code is executed after redirect
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
