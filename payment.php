<?php
session_start();
?>
<?php
include("php/config.php");
if (isset($_POST['pay'])){
    $user_id = $_SESSION['user_id']; 
    
    $currentDate = date('Y-m-d_H-i-s');
    $paymentAmount = $_COOKIE['grand_total'];
    $paymentMethod = $_COOKIE['payment_method'];
    
    function generateTransactionID() {
        return 'TX' . rand(1000, 9999);
    }
    $transactionID = generateTransactionID();


    $find = mysqli_query($conn, "SELECT MAX(Payment_ID) AS max_id FROM Payments");
    $row = mysqli_fetch_assoc($find);
          
    if ($row['max_id']) {
        $last_id = $row['max_id'];
        $num = intval(substr($last_id, 4)) + 1;  
         $payment_id = 'PAY-' . str_pad($num, 3, '0', STR_PAD_LEFT);
    } else {
        $payment_id = 'PAY-001'; 
    }

    

    //update payments
    $payment = "INSERT INTO `Payments`(`Payment_ID`, `Payment_date`, `Payment_amount`, `Payment_method`, `Transaction_id`)
    VALUES ('$payment_id','$currentDate','$paymentAmount','$paymentMethod','$transactionID')";
    
    $result= mysqli_query($conn, $payment);

    


    if ($result) {
        $shipping_info = $_COOKIE['shipping_info'];
        $result_shipping = mysqli_query($conn, $shipping_info);
        $buy_now = $_COOKIE['buy_now'];
        $result_buy = mysqli_query($conn, $buy_now);
        $order_id= $_COOKIE['orderid'];
        $updatePaymentID =mysqli_query($conn,"UPDATE `Orders` SET `Payment_ID`='$payment_id' WHERE `Order_ID`= '$order_id'");
        $productID = $_COOKIE['productID'];
        $balance_qty = $_COOKIE['balance_qty'];
        $updateNew_qty = mysqli_query($conn,"UPDATE `Inventory` SET `Quantity`='$balance_qty' WHERE `Product_ID`= '$productID'");
        
        //destroy cookies
        setcookie('buy_now', $buy_now, time() -3600, "/");
        setcookie('fprice', $fprice, time() - 3600, "/");
        setcookie('shippingPrice', $shipping, time() - 3600, "/");
        setcookie('productID', $productID, time() - 3600, "/"); 
        setcookie('orderid', $orderid, time() - 3600, "/"); 
        setcookie('grand_total',$grand_total, time() - 3600, "/");
        setcookie('balance_qty',$balance_qty, time() -3600, "/"); 
        header("Location: productpage.php");
        exit();
    } else {
        echo "<div class='errormessage'>
                <p>Error processing payment: " . mysqli_error($conn) . "</p>
            </div>";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="Index.css">
    <link rel="stylesheet" href="payment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- social media icons -->

    <!-- Questrial Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    
    <style>
        

        h1{
            text-align: center;
        }

        p{
            font-size: 18px;
        }

        .card_details-container{
            font-family: Questrial, sans-serif;
            border: 1px solid black;
            border-radius: 10px;
            width: 50%;
            height: 700px;
            padding: 10px 20px 10px 30px;
            background-color: white;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            border: none;
        }
        .card_details{
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .card_details input{
            height: 50px;
            width: 500px;
            font-family: Questrail, sans-serif;
            font-size: 18px;
            border-radius: 5px;
            border-color: black;
        }


        button{
            height: 50px;
            width: 200px;
            margin-top: 20px;
            font-size: 18px;
            font-family: arial, sans-serif;
            color: white;
            padding: 2px;
            background-color: red;
            border: none;
            border-radius: 10px;
        }

        .order_details{
            border: 1px solid black;
            height: 200px;
            width: 400px;
            padding: 20px;
            font-family: Questrial, sans-serif;
            border: 1px solid black;
            border-radius: 10px;
            padding: 10px 20px 10px 30px;
            background-color: white;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            border: none;
        }


        .container{
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 20px;
        }

    </style>




</head>

<body>

    <!-- Navigation Bar Section-->
    <header style="padding: 8px 20px;">
        <!-- Side Navigation Menu -->
        <nav id="mySidenav" class="sidenav">
            <!-- Close button -->
            <img onclick="closeNav()" src="images/close-google.svg" class="closebtn" style="width: 30px;">
            
            <!-- Navigation links -->
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="productpage.php">Products</a>
            <a href="consultation.php">Consultations</a>
            <a href="contact us page.php">Contact</a>
            <a href="termspage.php">Terms of Services</a>
        </nav>
        <!-- Menu icon (with open function)-->
        <img src="images/menu-google.svg" id="menuIcon" style="width:30px;cursor:pointer" onclick="openNav()">

        <!-- Logo Section -->
        <section class="logo">

            <div class="logo-content">
                <a href="Index.php"> <img src="./images/Versori.png" alt="logo" style="height: 50px; padding-right: 90px;"> </a>
            </div>
    
        </section>

        <!-- Profile and Dropdown -->
        <div class="profile-container">
            <!-- Profile Image Icon; clicking on this toggles the dropdown -->
            <img src="images/profile-google.svg" alt="Profile Icon" class="profile-icon" onclick="toggleDropdown()">
            
            <!-- Dropdown Menu content; links for Login, Logout, and My Orders -->
            <?php 
            if (isset($_SESSION['user_id'])) {
            ?>    
                <div id="myDropdown" class="dropdown-content">
                    <a href="./myaccount.php">My Account</a>
                    <a href="myorders.php">My Orders</a>
                    <a href="./logout.php">Logout</a>
                </div>
            <?php }else{?>
                <div id="myDropdown" class="dropdown-content">
                    <a href="./login.php">Login</a>
                    <a href="./register.php">Create Account</a>
                </div>

            <?php }?>
            
        </div>


    </header>
    



    <main>
        <h1 style="font-family: Questrial, sans-serif;">Payment</h1>

        <div class="container">
        <form class="card_details-container" id="paymentForm" action="" method="POST" onsubmit="return storeFinalPrice()">

                <h2>Card Details</h2>

                <div class="card_details">
                    <label for="crd_name">Card holder's name:</label><br><br>
                    <input id="crd_name" type="text" name="name" placeholder="Name on card" required>
                </div>

                <div class="card_details">
                    <label for="crd_num">Card Number:</label><br><br>
                    <input id="crd_num" type="text" name="card_number" placeholder="Card Number" required pattern="\d{16}" title="Please enter a valid 16-digit card number">
                </div>

                <div class="card_details">
                    <label for="exp_date">Expiry Date:</label><br><br>
                    <input id="exp_date" type="month" name="exp_date" required>
                </div>

                <div class="card_details">
                    <label for="cvv">CVV:</label><br><br>
                    <input id="cvv" type="text" name="CVV" placeholder="Code" required pattern="\d{3}" title="Please enter a valid 3-digit CVV">
                </div>

                <button type="submit" name="pay" style="margin-top: 10px; margin-bottom:30px; cursor:pointer;">Proceed to Checkout</button>

            </form>

            <div class="order_details">
                <h2>Order summary</h2>
                <p style="font-size:30px;">Sub total: Rs. <?php echo $_COOKIE['grand_total'];?></p>
            </div>

        </div>
    </main>

    <!-- Footer Section -->
    <footer>
        
        <div class="footer-links">
            <div class="social-media">
                <a href="index.php"> <img src="./images/Versori.png" alt="logo" style="height: 90px; padding-left: 20px; "> </a>
                <ul style="list-style-type: none; display: flex; padding: 0; font-size: 30px;">
                    <li style="margin-left: 20px;"><a href="#" class="fa fa-facebook"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                    <li><a href="#" class="fa fa-instagram"></a></li>
                </ul>
            </div>
            <div class="footer-left">
                <ul>
                    <li style="font-weight: bolder; font-size: 1.5rem; letter-spacing: 0.04rem;">Versori</li>
                    <li><a href="Policy.php">Privacy Policy</a></li>
                    <li><a href="termspage.php">Terms and Conditions</a></li>
                </ul>
            </div>
            <div class="footer-middle">
                <ul>
                    <li style="font-weight: bolder; font-size: 1.2rem;">Our service</li>
                    <li><a href="help.php" >Manufacturing</a></li>
                    <li><a href="consultation.php">Consultancy</a></li>
                    <li><a href="help.php">Sampling</></li>
                </ul>
            </div>
            <div class="footer-right">
                <ul>
                    <li style="font-weight: bolder; font-size: 1.2rem;">Useful Links</li>
                    <li><a href="about.php">About us</a></li>
                    <li><a href="contact us page.php">Contact us</a></li>
                    <li><a href="productpage.php">Products</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                </ul>    
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; Versori 2024</p>
        </div>
    </footer>


    <script src="index.js"></script>

    <script>
        
        // Retrieve the final price from sessionStorage and display it
        const finalPrice = sessionStorage.getItem('finalPrice'); // Corrected key to match what was used in storeFinalPrice
        // Assuming there is a span or input field for displaying the total price
        if (finalPrice) {
            document.getElementById('totalPrice').textContent = finalPrice; // Set the total price in the order summary
        } else {
            console.log('No final price found in sessionStorage.');
        }

        // function storeFinalPrice() {
        //     let finalPriceElement = document.getElementById('totalPrice');

        //     if (finalPriceElement) {
        //         let finalPrice = finalPriceElement.innerText; 
        //         finalPrice = finalPrice.replace(/[^\d.-]/g, ''); 

        //         sessionStorage.setItem('finalPrice', finalPrice);

        //         window.location.href = 'checkout.php'; 
        //         return false; // Prevent default form submission
        //     } else {
        //         console.log('Total price element not found.'); 
        //         return false; // Prevent default form submission
        //     }
        // }



        // Example: Call this function when the payment method is selected or on button click
        document.getElementById('paymentButton').addEventListener('click', storeFinalPrice); // Replace 'paymentButton' with the actual button ID




    </script>

</body>
</html>