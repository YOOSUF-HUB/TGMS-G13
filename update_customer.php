<?php
include('php/config.php');

// Get the customer ID from the URL
$Customer_ID = $_GET['updateid'];

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Collect form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];

    // Prepare the SQL update query
    $sql = "UPDATE Customer_account 
            SET First_name = '$fname', 
                Last_name = '$lname', 
                Email = '$email', 
                Password = '$password', 
                Address = " . (!empty($address) ? "'$address'" : "NULL") . ", 
                Phone_no = " . (!empty($phone) ? "'$phone'" : "NULL") . ", 
                Dob = " . (!empty($dob) ? "'$dob'" : "NULL") . " 
            WHERE Customer_ID = '$Customer_ID'";

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
    // Fetch the current customer data to display in the form
    $sql = "SELECT * FROM Customer_account WHERE Customer_ID = '$Customer_ID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>
<html>

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
        <h2>Customer ID: <?php echo $row['Customer_ID']; ?></h2>
    </div>
    <div class="field input">
        <input type="text" name="fname" id="fname" placeholder="First Name" value="<?php echo htmlspecialchars($row['First_name']); ?>" required>
    </div>

    <div class="field input">
        <input type="text" name="lname" id="lname" placeholder="Last Name" value="<?php echo htmlspecialchars($row['Last_name']); ?>" required>
    </div>

    <div class="field input">
        <input type="email" name="email" id="email" placeholder="Email" value="<?php echo htmlspecialchars($row['Email']); ?>" required>
    </div>

    <div class="field input">
        <input type="password" name="password" id="password" placeholder="Password" value="<?php echo htmlspecialchars($row['Password']); ?>" required>
    </div>

    <div class="field input">
        <input type="text" name="address" id="address" placeholder="Address" value="<?php echo htmlspecialchars($row['Address']); ?>">
    </div>

    <div class="field input">
        <input type="text" name="phone" id="phone" placeholder="Phone" value="<?php echo htmlspecialchars($row['Phone_no']); ?>">
    </div>

    <div class="field input">
        <input type="date" name="dob" id="dob" placeholder="Date of Birth" value="<?php echo htmlspecialchars($row['Dob']); ?>">
    </div>

    <div class="field">
        <input class="btn" type="submit" name="submit" value="Update">
    </div>
    <div class="field">
        <input class="cancel-btn" type="button" value="Cancel" onclick="window.location.href='AdminDashboard-user.php';">
    </div>
</form>

</html>
