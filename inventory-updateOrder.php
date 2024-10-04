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
$OrderID = $_GET['updateid'];

// Check if the form is submitted
if (isset($_POST['save'])) {
    // Collect form data
    //$productName = $_POST['productName'];
    $productQuantity = $_POST['productQuantity'];
    $newDeliveryDate = $_POST['newDeliveryDate'];
    $updateStatus = $_POST['updateStatus'];

    // Prepare the SQL update query
    $updateQuery = "UPDATE Orders 
            SET `Quantity` = '$productQuantity', 
                `Delivery_Date` = '$newDeliveryDate', 
                `Status` = '$updateStatus'
        WHERE `Order_ID` = '$OrderID'";



    // Execute the query and check if successful
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: inventory-Orders.php"); 
        exit();
    } else {
        echo "<p style='color: red; text-align: center;'>Failed to Update: " . mysqli_error($conn) . "</p>";
    }
} else {
    $sql = "SELECT * FROM Orders WHERE Order_ID = '$OrderID'";
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
        <h2>Order ID: <?php echo $OrderID; ?></h2>
    </div>
    <!-- <div class="field input">
        <label for="productName">Change Product:</label>
        <input type="text" name="productName" value="" required>
    </div> -->

    <div class="field input">
        <label for="productQuantity">Change Quantity:</label>
        <input type="text" name="productQuantity" value="<?php echo $row["Quantity"]; ?>" >
    </div>

    <div class="field input">
        <label for="newDeliveryDate">Change Delivery Date:</label>
        <input type="date" name="newDeliveryDate" value="<?php echo $row["Delivery_Date"]; ?>">
    </div>

    <div class="field input">
        <label for="currentStatus">Current Status: <?php echo $row["Status"]; ?></label>
    </div>

    <div class="field input">
        <label for="updateStatus">Update Status:</label>
        <select name="updateStatus" id="updateStatus">
            <option value="" disabled selected><?php echo $row["Status"]; ?></option>
            <option value="In-Progress">In-Progress</option>
            <option value="Shipped">Shipped</option>
            <option value="Delivered">Delivered</option>
            <option value="Cancelled">Cancelled</option>
        </select>
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