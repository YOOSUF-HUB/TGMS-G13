<?php
include('php/config.php');

// Get the customer ID from the URL
$Product_ID = $_GET['updateid'];

// Check if the form is submitted
if (isset($_POST['save'])) {
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

<link rel="stylesheet" href="styles/update_admin.css">

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
        <input class="btn" type="submit" name="save" value="Update">
    </div>
</form>
