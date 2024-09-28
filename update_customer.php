<?php
// Include the database connection file
include ('php/config.php');

// Check if Customer_ID is provided via POST
if (isset($_POST['Customer_ID'])) {
    $customer_id = $_POST['Customer_ID'];

    // SQL query to fetch the customer details
    $sql = "SELECT * FROM Customer_account WHERE Customer_ID = ?";
    
    // Prepare statement to prevent SQL injection
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $customer = $result->fetch_assoc(); // Fetch the customer details
        
        // If the customer is found, show the update form
        if ($customer) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer</title>
    <link rel="stylesheet" href="styles/Admin_dashboard.css">
    <style>
        /* Center the form on the page */
        form {
            width: 50%;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
            text-align: left;
        }

        /* Add spacing between the labels and inputs */
        form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            font-family: 'Arial', sans-serif;
        }

        /* Style the input fields */
        form input[type="text"],
        form input[type="email"],
        form input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        /* Style the submit button */
        form button {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Hover effect for the submit button */
        form button:hover {
            background-color: #218838;
        }

        /* Style the cancel button */
        .cancel-button {
            width: 100%;
            padding: 12px;
            background-color: #dc3545; /* Red color */
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px; /* Space between buttons */
        }

        /* Hover effect for the cancel button */
        .cancel-button:hover {
            background-color: #c82333;
        }

        /* Add focus effect on input fields */
        form input[type="text"]:focus,
        form input[type="email"]:focus,
        form input[type="date"]:focus {
            border-color: #80bdff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        #customer-id {
            margin-top: 20px;
            margin-bottom: 20px;
        }

    </style>
</head>
<body style="text-align:center">

    <h1 style="text-align:center">Update Customer Details</h1>
    
    <form method="POST" action="process_update.php" style="width:50%; margin:auto;">

        <div id="customer-id">
            <p>Customer ID: <?php  echo $customer['Customer_ID']; ?> </p>
        </div>
        <label for="First_name">First Name:</label>
        <input type="text" name="First_name" value="<?php echo $customer['First_name']; ?>" required><br><br>

        <label for="Last_name">Last Name:</label>
        <input type="text" name="Last_name" value="<?php echo $customer['Last_name']; ?>" required><br><br>

        <label for="Email">Email:</label>
        <input type="email" name="Email" value="<?php echo $customer['Email']; ?>" required><br><br>

        <label for="Password">Password:</label>
        <input type="text" name="Password" value="<?php echo $customer['Password']; ?>" required><br><br>

        <label for="Address">Address:</label>
        <input type="text" name="Address" value="<?php echo $customer['Address']; ?>" ><br><br>

        <label for="Phone_no">Phone No:</label>
        <input type="text" name="Phone_no" value="<?php echo $customer['Phone_no']; ?>" ><br><br>

        <label for="Dob">Date of Birth:</label>
        <input type="date" name="Dob" value="<?php echo $customer['Dob']; ?>" ><br><br>

        <button type="submit" style="background-color:green; color:white; padding:10px;">Update Customer</button>
        <button type="button" class="cancel-button" onclick="window.location.href='AdminDashboard.php';">Cancel</button>
    </form>

</body>
</html>

<?php
        } else {
            echo "<p>Customer not found.</p>";
        }
        $stmt->close();
    }
} else {
    echo "<p>No customer selected.</p>";
}

$conn->close();
?>
