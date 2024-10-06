<?php
session_start();  // Start session at the beginning

include('php/config.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, show a message or redirect to login
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];  // Get logged-in user's ID

$sql = "SELECT 
    O.Order_ID as oid,
    I.Name as pname,
    I.Colour as pcolour,
    I.Size as psize,
    O.Quantity as qty,
    O.Order_Date as odate,
    O.Delivery_Date as ddate,
    O.Status as sts
FROM Orders O, Customer_account C, Inventory I
where O.Customer_ID = C.Customer_ID AND O.Product_ID = I.Product_ID AND C.Customer_ID='$user_id'";

$result = $conn->query($sql);





// If the user has clicked the save button, update the data
if (isset($_POST['save'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone_no = $_POST['phoneno'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];

    $update_query = "UPDATE Customer_account 
                     SET First_name = '$fname', 
                        Last_name = '$lname', 
                        Email = '$email', 
                        Address = " . (!empty($address) ? "'$address'" : "NULL") . ", 
                        Phone_no = " . (!empty($phone_no) ? "'$phone_no'" : "NULL") . ", 
                        Dob = " . (!empty($dob) ? "'$dob'" : "NULL") . " 
                     WHERE Customer_ID = '$user_id'";

    if (mysqli_query($conn, $update_query)) {
        echo "<p class='success'>Profile updated successfully!</p>";
        // Refresh the page to load the updated data
        header("Refresh:0");
    } else {
        echo "<p class='error'>Error updating profile: " . mysqli_error($conn) . "</p>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Textile and Garment Management System</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- social media icons -->

    <!-- Questrial Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">

    <style>
        .table {
            width: 1200px;
            border-collapse: collapse;
        }
        .table thead tr th {
            background-color: #697565;
            color: #f2f2f2;
        }
        .table th{
            text-align: left;
            padding: 12px;
        }
        .table td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 12px;
            font-family:Verdana, Geneva, Tahoma, sans-serif;
        }
        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .table tr:nth-child(odd) {
            background-color: #e6e6e6;
        }
        .insideRow{
            font-size: 0.7rem;
            margin: 0;
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
            <a href="homepage.php">Home</a>
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
        <!-- My Account Details with edit option-->
        <div id="externalContainer">
            <div id="myaccountContainer" >
                <div class="myaccount">
                    <h1>My Orders</h1>
                    <hr>
                </div>
                <div>
                    <table class="table" >
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Order Date</th>
                                <th>Delivery Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row["oid"]; ?></td>
                                <td><?php echo $row["pname"];?><br><p class="insideRow"><?php echo $row["pcolour"]; echo ", "; echo $row["psize"];?> </p></td>
                                <td><?php echo $row["qty"]; ?></td>
                                <td><?php echo $row["odate"]; ?></td>
                                <td><?php echo $row["ddate"]; ?></td>
                                <td><?php echo $row["sts"]; ?></td>
                                <td><a href="contact us page.php"><img src="PRODUCT IMAGES/delete-icon.svg"></a></td>
                                
                                
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>

    </main>
    
    
    <!-- Footer Section -->
    <footer>
        
        <div class="footer-links">
            <div class="social-media">
                <a href="homepage.php"> <img src="./images/Versori.png" alt="logo" style="height: 90px; padding-left: 20px; "> </a>
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
</body>
</html>