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



// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Collect form data
    $productName = $_POST['productName'];
    $productQuantity = $_POST['productQuantity'];
    // $productColour = $_POST['productColour'];
    // $productSize = $_POST['productSize'];
    // $productType = $_POST['productType'];
    // $productQuantity = $_POST['productQuantity'];

    // Assigning new supplierID
    if ($row['max_id']) {
        $last_id = $row['max_id'];
        $num = intval(substr($last_id, 1)) + 1;  
        $orderID = 'O' . str_pad($num, 5, '0', STR_PAD_LEFT); 
    } else {
        $orderID = 'O00001'; 
    }
    if ($row['max_id']) {
        $last_id = $row['max_id'];
        $num = intval(substr($last_id, 4)) + 1;  
        $custom_orderID = 'CusO' . str_pad($num, 5, '0', STR_PAD_LEFT); 
    } else {
        $custom_orderID = 'CusO00001'; 
    }

    // insert query
    $newproduct = "INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) 
                VALUES ('$productID','$productName','$productColour','$productSize','$productType','$productQuantity')";


    // execute the query and check if successful
    if (mysqli_query($conn, $newproduct)) {
        header("Location: inventoryPage.php"); 
        exit();
    } else {
        echo "<p style='color: red; text-align: center;'>Failed to Update: " . mysqli_error($conn) . "</p>";
    }
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
        <h2>Add Custom Order</h2>
    </div>
    <div class="field input">
        <label for="productName">Name:</label>
        <input type="text" name="productName" placeholder="productName"  required>
    </div>
    <!-- <div class="field input">
        <label for="productSize">Size:</label>
        <input type="text" name="productName" placeholder="Product Size" required>
    </div> -->

    <!-- <div class="field input">
        <label for="productColour">Colour:</label>
        <input type="text" name="productColour" placeholder="Product Colour" required>
    </div> -->

    <!-- <div class="field input">
        <label for="productType">Type:</label>
        <input type="text" name="productType"  placeholder="Product Type" required>
    </div> -->

    <div class="field input">
        <label for="productQuantity">Quantity:</label>
        <input type="text" name="productQuantity" placeholder="Product Quantity" required>
    </div>

    <!-- <div class="field input">
        <label for="productDescription">Describe:</label>
        <input type="textfield" name="productDescription" placeholder="Describe Product"  required>
    </div> -->


    <div class="field">
        <input class="btn" type="submit" name="submit" value="Create">
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