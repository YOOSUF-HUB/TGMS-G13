<?php

include('php/config.php');

// Get the staff ID from the URL
$Staff_ID = $_GET['updateid'];

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Collect form data
    $fname = $_POST['fname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $staff_role = $_POST['staff_role'];
    $password = $_POST['password'];

    // Prepare the SQL update query
    $sql = "UPDATE Staff_account 
            SET Full_name = '$fname', 
                username = '$username', 
                Email = '$email', 
                staff_role = '$staff_role', 
                Password = '$password' 
            WHERE Staff_ID = '$Staff_ID'";

    // Print the query to debug
    echo $sql;

    // Execute the query and check if successful
    if (mysqli_query($conn, $sql)) {
        header("Location: AdminDashboard.php"); // Redirect to dashboard
        exit(); // Ensure script ends after redirect
    } else {
        echo "<p style='color: red; text-align: center;'>Failed to Update: " . mysqli_error($conn) . "</p>";
    }
} else {
    // Fetch the current staff data to display in the form
    $sql = "SELECT * FROM Staff_account WHERE Staff_ID = '$Staff_ID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff Account</title>
    <link rel="stylesheet" href="styles/Admin_dashboard.css">
</head>
<body>

<link rel="stylesheet" href="styles/update_admin.css">

<style>
    /* Center the form on the page */
    form {
        margin: 50px auto;
        width: 300px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: #f9f9f9;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    /* Style the label */
    label {
        font-size: 18px;
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
    }

    /* Style the input fields */
    .field.input input {
        width: 100%;
        height: 40px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 10px;
        font-size: 16px;
        background-color: #fff;
        margin-bottom: 20px;
        outline: none;
        transition: border-color 0.3s ease;
    }

    /* Change border color on focus */
    .field.input input:focus {
        border-color: #007BFF;
    }

    /* Style the submit button */
    .btn {
        width: 100%;
        padding: 10px;
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    /* Change button color on hover */
    .btn:hover {
        background-color: #0056b3;
    }

    /* Style the cancel button */
    .cancel-btn {
        width: 100%;
        padding: 10px;
        background-color: #FF0000;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-top: 10px;
    }

    /* Change button color on hover */
    .cancel-btn:hover {
        background-color: #CC0000;
    }

    /* Style the error message */
    p {
        color: red;
        font-size: 14px;
    }

    /* Add responsive design */
    @media (max-width: 600px) {
        form {
            width: 90%;
        }
    }
</style>

<form action="" method="post">

    <div>
        <h2>Staff ID: <?php echo $row['Staff_ID']; ?></h2>
    </div>
    <div class="field input">
        <input type="text" name="fname" id="fname" placeholder="First Name" value="<?php echo htmlspecialchars($row['Full_name']); ?>" required>
    </div>

    <div class="field input">
        <input type="text" name="username" id="username" placeholder="User Name" value="<?php echo htmlspecialchars($row['username']); ?>" required>
    </div>
                
    <div class="field input">
        <input type="email" name="email" id="email" placeholder="Email" value="<?php echo htmlspecialchars($row['Email']); ?>" autocomplete="off" required>
    </div>

    <div class="field input">
        <select name="staff_role" id="staff_role" required>
            <option value="" disabled>Select Permission</option>
            <option value="Admin" <?php echo $row['staff_role'] === 'Admin' ? 'selected' : ''; ?>>Admin</option>
            <option value="Inventory" <?php echo $row['staff_role'] === 'Inventory' ? 'selected' : ''; ?>>Inventory</option>
            <option value="Support" <?php echo $row['staff_role'] === 'Support' ? 'selected' : ''; ?>>Support</option>
        </select>
    </div>

    <div class="field input">
        <input type="password" name="password" id="password" placeholder="Password" value="<?php echo htmlspecialchars($row['Password']); ?>" required>
    </div>

    <div class="field">
        <input class="btn" type="submit" name="submit" value="Update" required>
    </div>
    <div class="field">
        <input class="cancel-btn" type="button" value="Cancel" onclick="window.location.href='AdminDashboard-staff.php;">
    </div>
</form>

</body>
</html>
