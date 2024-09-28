<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('php/config.php'); // Database connection

    // Get form data
    $customer_id = $_POST['Customer_ID'];
    $first_name = $_POST['First_name'];
    $last_name = $_POST['Last_name'];
    $email = $_POST['Email'];
    $password = $_POST['Password']; // In a real system, you should hash passwords
    $address = $_POST['Address'];
    $phone_no = $_POST['Phone_no'];
    $dob = $_POST['Dob'];

    // Prepare SQL query to update customer
    $sql = "UPDATE Customer_account 
            SET First_name = ?, Last_name = ?, Email = ?, Password = ?, Address = ?, Phone_no = ?, Dob = ? 
            WHERE Customer_ID = ?";

    // Prepare statement to avoid SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $first_name, $last_name, $email, $password, $address, $phone_no, $dob, $customer_id);

    if ($stmt->execute()) {
        header("Location: AdminDashboard.php?message=Customer+Updated+Successfully");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
