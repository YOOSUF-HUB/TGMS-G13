<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
    $productID = $_POST['productID'];
    $productName = $_POST['productName'];
    $productColour = $_POST['productColour'];
    $productSize = $_POST['productSize'];
    $productType = $_POST['productType'];
    $productQuantity = $_POST['productQuantity'];
    $productPrice = $_POST['productPrice'];

    

    $idcheck = mysqli_query($conn,"SELECT * FROM Inventory WHERE Product_ID = '$productID'");
    if (mysqli_num_rows($idcheck) > 0) {
        // If exists, display error message
        $error_message = "Already existing product ID";
    } else {
        // insert query
        $newproduct = "INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`, `Price`) 
        VALUES ('$productID','$productName','$productColour','$productSize','$productType','$productQuantity', $productPrice)";

        if (mysqli_query($conn, $newproduct)) {
            header("Location: inventory-Inventory.php"); 
            exit();
        } else {
            echo "<p style='color: red; text-align: center;'>Failed to Update: " . mysqli_error($conn) . "</p>";
        }


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

    .errormessage{
        color: red;
    }

    

</style>
    



</head>

<body>

    <form action="" method="post">
    <div>
        <h2>Add Product </h2>
    </div>
            <?php 
            if (isset($error_message)): ?>
                <div class="errormessage">
                    <p><?php echo $error_message; ?></p>
                </div>
            <?php endif; ?>
    <div class="field input">
        <label for="productID">Product ID:</label>
        <input type="text" name="productID" placeholder="Product ID"  required>
    </div>
    <div class="field input">
        <label for="productName">Name:</label>
        <input type="text" name="productName" placeholder="Product Name" required>
    </div>

    <div class="field input">
        <label for="productColour">Colour:</label>
        <input type="text" name="productColour" placeholder="Product Colour" required>
    </div>

    <div class="field input">
        <label for="productSize">Size:</label>
        <input type="text" name="productSize" placeholder="Product Size"  required>
    </div>

    <div class="field input">
        <label for="productType">Type:</label>
        <input type="text" name="productType"  placeholder="Product Type" required>
    </div>

    <div class="field input">
        <label for="productQuantity">Quantity:</label>
        <input type="text" name="productQuantity" placeholder="Product Quantity" required>
    </div>

    <div class="field input">
        <label for="productPrice">Price:</label>
        <input type="number" name="productPrice" placeholder="Product Price" required>
    </div>


    <div class="field">
        <input class="btn" type="submit" name="submit" value="Create">
        <input class="btn" id="cancelBtn" type="button" value="Cancel" onclick="goBack()">
    </div>
    <div class="instructions" style="color: #303030;">
            <h3>Instruction:</h3>
            <ul>
                <li>Set a unique product id according to your product.</li>
                <ol>
                    <li>Hoodie : VR-H-XXX</li>
                    <li>Joggers : VR-J-XXX</li>
                    <li>T-Shirt : VR-TS-XXX</li>
                    <li>Long Sleeve T : VR-LT-XXX</li>
                </ol>
            </ul>
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