<?php
include('php/config.php');

// Get the Inquiry ID from the URL
$Inquiry_ID = $_GET['updateid'];

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Collect form data
    $status = mysqli_real_escape_string($conn, $_POST['status']); // Get the status from the form

    // Update the inquiry status
    $sql = "UPDATE Inquiries
            SET Status = '$status'
            WHERE Inquiry_ID = '$Inquiry_ID'";

    // Print the query to debug (optional)
    // echo $sql;

    // Execute the query and check if successful
    if (mysqli_query($conn, $sql)) {
        header("Location: Customersupport-inquiries.php"); // Redirect to dashboard
        exit(); // Ensure script ends after redirect
    } else {
        echo "<p style='color: red; text-align: center;'>Failed to Update: " . mysqli_error($conn) . "</p>";
    }
} else {
    // Fetch the current inquiry data to display in the form
    $sql = "SELECT * FROM Inquiries WHERE Inquiry_ID = '$Inquiry_ID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>
<html>

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

/* Style the dropdown select */
select {
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
select:focus {
    border-color: #007BFF;
}

/* Style the submit button */
input[type="submit"] {
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
input[type="submit"]:hover {
    background-color: #0056b3;
}

/* Style the cancel button */
input[type="button"] {
    width: 100%;
    padding: 10px;
    background-color: #FF0000;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top:10px;
}

/* Change button color on hover */
input[type="button"]:hover {
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

<link rel="stylesheet" href="styles/update_admin.css">

<form action="" method="post">
    <label><b>Status</b></label>
    <select name="status" style="width:100px; height:30px; border:none; border-radius:10px;" id="Solved_<?php echo $row["Inquiry_ID"]; ?>">
        <option value="Active" <?php if ($row["Status"] == 'Active') echo 'selected'; ?>>Active</option>
        <option value="Closed" <?php if ($row["Status"] == 'Closed') echo 'selected'; ?>>Closed</option>
    </select>
    <br><br>
    <input type="submit" name="submit" value="Update Status">
    <input type="button" value="Cancel" onclick="window.location.href='Customersupport-inquiries.php';">
</form>

</html>
