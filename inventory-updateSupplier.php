<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: adminlogin.php");
    exit();
}
if($_SESSION['staff_role']!=='Inventory'){ //condition make sure admin user redirect to correct page
    header("Location: adminlogin.php");
    exit();
}
?>
<?php
include('php/config.php');

// Get the customer ID from the URL
$supplierID = $_GET['updateid'];

// Check if the form is submitted
if (isset($_POST['save'])) {
    // Collect form data
    $supplierName = $_POST['supplierName'];
    $companyName = $_POST['companyName'];
    $category = $_POST['category'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $supply = $_POST['supply'];

    // Prepare the SQL update query
    $updateQuery = "UPDATE Supplier 
            SET `Supplier_name` = '$supplierName', 
                `Company_name` = '$companyName', 
                `Category` = '$category', 
                `Email` = '$email', 
                `Phone_number` = '$phoneNumber',
                `Supply` = '$supply'
        WHERE `Supplier_ID` = '$supplierID'";



    // Execute the query and check if successful
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: inventory-Supplier.php"); 
        exit();
    } else {
        echo "<p style='color: red; text-align: center;'>Failed to Update: " . mysqli_error($conn) . "</p>";
    }
} else {
    $sql = "SELECT * FROM Supplier WHERE Supplier_ID = '$supplierID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Dashboard</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #ECDFCC;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    form {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 500px;
        display: flex;
        flex-direction: column;
        padding: 20px 50px ;
    }

    .field {
        margin-bottom: 15px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0px 10px;
    }

    .input input,
    .input select {
        width: 350px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        transition: border-color 0.3s;
    }

    .input input:focus,
    .input select:focus {
        border-color: #4CAF50;
        outline: none;
    }

    .btn {
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
        font-size: 1rem;
        transition: background-color 0.3s;
    }
     .btn:hover {
        background-color: #45a049;
    }

    #cancelBtn {
        background-color: #B43F3F;
        margin-left: 5px;
    }
    #cancelBtn:hover {
        background-color: #B8001F;
    }

    .field input::placeholder,
    .field select::placeholder {
        color: #999;
    }

    .field input:disabled,
    .field select:disabled {
        background-color: #e9ecef;
    }

    

</style>
    



</head>

<body>

    <form action="" method="post">
    <div>
        <h2>Supplier ID: <?php echo $supplierID; ?></h2>
    </div>
    <div class="field input">
        <label for="supplierName">Supplier Name:</label>
        <input type="text" name="supplierName" placeholder="Supplier Name" value="<?php echo $row["Supplier_name"]; ?>" required>
    </div>

    <div class="field input">
        <label for="companyName">Colour:</label>
        <input type="text" name="companyName" placeholder="Company Name" value="<?php echo $row["Company_name"]; ?>" required>
    </div>

    <div class="field input">
        <label for="category">Category:</label>
        <input type="text" name="category" placeholder="Category" value="<?php echo $row["Category"]; ?>" required>
    </div>

    <div class="field input">
        <label for="email">Email:</label>
        <input type="text" name="email"  placeholder="Email" value="<?php echo $row["Email"]; ?>">
    </div>

    <div class="field input">
        <label for="phoneNumber">Phone Number:</label>
        <input type="text" name="phoneNumber" placeholder="Phone Number" value="<?php echo $row["Phone_number"]; ?>">
    </div>

    <div class="field input">
        <label for="supply">Supply:</label>
        <input type="text" name="supply" placeholder="Supply" value="<?php echo $row["Supply"]; ?>">
    </div>

    <div class="field">
        <input class="btn" type="submit" name="save" value="Update">
        <input class="btn" id="cancelBtn" type="button" value="Cancel" onclick="goBack()">
    </div>
</form>
   
<script>
    //redirect to previous page
    function goBack() {
        window.history.back(); 
    }
</script>

</body>
</html>