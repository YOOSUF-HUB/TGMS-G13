<?php
// Include the database connection file here
include 'db_connect.php'; // Assuming you save the connection file as db_connect.php

// SQL query to fetch data
$sql = "SELECT Customer_ID, First_name, Last_name, Email, Address, Phone_no, Dob, Date_created FROM Customer_account";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Accounts</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Customer Accounts</h1>
    
    <?php if ($result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone No</th>
                <th>Date of Birth</th>
                <th>Date Created</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row["Customer_ID"]; ?></td>
                <td><?php echo $row["First_name"]; ?></td>
                <td><?php echo $row["Last_name"]; ?></td>
                <td><?php echo $row["Email"]; ?></td>
                <td><?php echo $row["Address"]; ?></td>
                <td><?php echo $row["Phone_no"]; ?></td>
                <td><?php echo $row["Dob"]; ?></td>
                <td><?php echo $row["Date_created"]; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>No customer records found.</p>
    <?php endif; ?>

    <?php $conn->close(); // Close the connection ?>
</body>
</html>
