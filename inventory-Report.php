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
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php
    // Include the database connection file here
    include 'php/config.php';

    // Query for revenue by order table
    $sql = "SELECT 
        O.Order_ID as oid,
        I.Name as pname,
        C.Customer_ID as cid,
        P.Transaction_id as tid,
        O.Quantity as qty,
        O.Order_Date as odate,
        P.Payment_amount as amount
    FROM Orders O, Customer_account C, Inventory I , Payments P
    where O.Customer_ID = C.Customer_ID AND O.Product_ID = I.Product_ID AND O.Payment_ID = P.Payment_ID AND O.Status!='Cancelled';";

    $result = $conn->query($sql);

    $revenue_sql = "SELECT 
        I.Name as pname, 
        I.Price as pprice, 
        SUM(O.Quantity) AS qtysold, 
        SUM(P.Payment_amount) AS income FROM Inventory I, Orders O, Payments P
    WHERE I.Product_ID = O.Product_ID AND O.Payment_ID = P.Payment_ID AND O.Status !='Cancelled'  AND (I.Name='Hoodie' OR I.Name='Joggers' OR I.Name='T-Shirt' OR I.Name='Long Sleeve T')
    GROUP BY I.Name";
    $revenue_result =$conn->query($revenue_sql);

    
    
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Dashboard</title>
    <link rel="stylesheet" href="companysidecopy.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- social media icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    

    <!-- Questrial Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">



</head>

<body>
    <header>
        <div class="top-container">
            <div class="logo-notification" >
                <div class="logo-content">
                    <a href="Index.html"> <img src="./images/versori 2.png" alt="logo" > </a>
                </div>
            
                <div class="notification">
                    <i class="fa fa-bell" style="font-size:30px"></i>
                </div>
            </div>

            <div class="title">
                <h1>Inventory Manager Dashboard</h1>
            </div>

            <div class="profile-container" >
                <i class="fa fa-user-circle-o profile-icon" onclick="toggleDropdown()"></i>
                
                <p><?php echo$_SESSION['name']?></p>
                <button id="logout-btn" ><a href="adminlogout.php">Logout</a></button>
            </div>

            


            
        </div>
    </header>
   
    <main class="dashboard-container">
        <section class="im-page-links" >
            <ul> 
                <li class="im-page"><a href="inventory-Dashboard.php">Home</a></li>
                <li class="im-page"><a href="inventory-Inventory.php">Inventory</a></li>
                <li class="im-page"><a href="inventory-Production.php">Production</a></li>
                <li class="im-page"><a href="inventory-Orders.php">Orders</a></li>
                <li class="im-page"><a href="inventory-Supplier.php">Suppliers</a></li>
                <li class="im-page"><a href="inventory-Report.php"  style="background-color: #34495e; padding-left: 20px;">Report</a></li>
            </ul>
        </section>

        <section class="content" >
            <div style="float:right;">
                <button class="btn1" id="addSupplierBtn"><a href="inventory-addSupplier.php?>" >Add Supplier</a></button>
                <button class="btn1" id="manageSupplierBtn" onclick="manageSupplier()" >Manage Supplier</button>
                <button class="btn1" id="cancelBtn" style="display: none;" onclick="cancelSupplier()"  >Cancel Manage</button>
            </div>

            <div id="viewMode" class="table-container" >
                <h2>Report</h2>
                <ul id="tabs"> <!-- page tabs -->
                    <li><button class="tab1" id="summaryBtn" onclick="summary()"; >Summary</button></li>
                    <li><button class="tab1" id="rbpBtn" onclick="rbp()">Revenue by Products</button></li>
                    <li><button class="tab1" id="rboBtn" onclick="rbo()">Revenue by Orders</button></li>
                    <li><button class="tab1" id="cancelledOrderBtn" onclick="cancelOrder()">Cancelled Orders</button></li>
                    <li><button class="tab1" id="customOrderBtn" onclick="customOrder()">Custom Orders</button></li>
                </ul>
                

                <!-- Summary -->
                <div id="summaryTab" class="inner-table-container"> 
                <table class="table" >
                    <!-- <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                        </tr>
                    </thead> -->
                    <tbody>
                        <tr>
                            <td>Total Number of Products</td>
                            <td><?php echo '5000'; ?></td>
                        </tr>
                        <tr>
                            <td>Total Stock Value</td>
                            <td><?php echo '5000'; ?></td>
                        </tr>
                        <tr>
                            <td>Total Revenue Generated</td>
                            <td><?php echo '5000'; ?></td>
                        </tr>
                        <tr>
                            <td>Total Orders Received</td>
                            <td><?php echo '5000'; ?></td>
                        </tr>
                        <tr>
                            <td>Most Ordered Product</td>
                            <td><?php echo '5000'; ?></td>
                        </tr>
                        <tr>
                            <td>Leased Ordered Product</td>
                            <td><?php echo '5000'; ?></td>
                        </tr>
                    </tbody>
                </table>
                </div>
                
                <!-- Revenue by Products -->
                <div id="rbpTab" class="inner-table-container" style="display:none;"> 
                <table class="table" >
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity Sold</th>
                            <th>Price per unit</th>
                            <th>Total Income</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $revenue_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["pname"]; ?></td>
                            <td><?php echo $row["qtysold"]; ?></td>
                            <td><?php echo $row["pprice"]; ?></td>
                            <td><?php echo $row["income"]; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                </div>

                <!-- Revenue by Orders -->
                <div id="rboTab" class="inner-table-container" style="display:none; "> 
                <table class="table" >
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Customer ID</th>
                            <th>Transaction ID</th>
                            <th>Quantity</th>
                            <th>Order Date</th>
                            <th>Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["oid"]; ?></td>
                            <td><?php echo $row["pname"]; ?></td>
                            <td><?php echo $row["cid"]; ?></td>
                            <td><?php echo $row["tid"]; ?></td>
                            <td><?php echo $row["qty"]; ?></td>
                            <td><?php echo $row["odate"]; ?></td>
                            <td><?php echo $row["amount"]; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                </div>
                
                <
            </div>

            <!-- Manage inventory -->
            <div id="editMode" style="display: none;" class="table-container">
                <h2>Manage Orders</h2>
                <div class="inner-table-container" >
                <form action="" method="POST">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Customer ID</th>
                            <th>Quantity</th>
                            <th>Order Date</th>
                            <th>Delivery Date</th>
                            <th>Status</th>
                            <th>Manage</th> <!--  new column will appear to manage inventory -->
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    
                    $result->data_seek(0); // reset the result to display results again
                    while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["oid"]; ?></td>
                            <td><?php echo $row["pname"]; ?></td>
                            <td><?php echo $row["cid"]; ?></td>
                            <td><?php echo $row["qty"]; ?></td>
                            <td><?php echo $row["odate"]; ?></td>
                            <td><?php echo $row["ddate"]; ?></td>
                            <td><?php echo $row["sts"]; ?></td>
                            <td>
                                <button style="background-color: #0B2F9F; border-radius: 5px; border: none; padding: 5px;"><a href="inventory-updateOrder.php?updateid=<?php echo $row['oid']; ?>" style="text-decoration: none; color: white;">Update</a></button>
                                <button style="background-color: #B8001F; border-radius: 5px; border: none; padding: 5px;"><a href="inventory-deleteOrder.php?deleteid=<?php echo $row['oid']; ?>" style="text-decoration: none; color: white;">Delete</a></button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
                </form>
                </div>

                
            </div>

            
        </section>

        
    </main>


        




    <!-- Footer Section -->
    <footer>
        
        <div class="footer-links">
            <div class="social-media">
                <a href="Index.html"> <img src="./images/Versori.png" alt="logo" style="height: 90px; padding-left: 20px; "> </a>
                <ul style="list-style-type: none; display: flex; padding: 0; font-size: 30px;">
                    <li style="margin-left: 20px;"><a href="#" class="fa fa-facebook"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                    <li><a href="#" class="fa fa-instagram"></a></li>
                </ul>
            </div>
            <div class="footer-left">
                <ul>
                    <li style="font-weight: bolder; font-size: 1.5rem; letter-spacing: 0.04rem;">Versori</li>
                    <li><a href="policy.html">Privacy Policy</a></li>
                    <li><a href="terms.html">Terms and Conditions</a></li>
                </ul>
            </div>
            <div class="footer-middle">
                <ul>
                    <li style="font-weight: bolder; font-size: 1.2rem;">Our service</li>
                    <li><a href="manufacturing.html">Manufacturing</a></li>
                    <li><a href="consultancy.php">Consultancy</a></li>
                    <li><a href="sampling.html">Sampling</a></li>
                </ul>
            </div>
            <div class="footer-right">
                <ul>
                    <li style="font-weight: bolder; font-size: 1.2rem;">Useful Links</li>
                    <li><a href="about.html">About us</a></li>
                    <li><a href="contact.php">Contact us</a></li>
                    <li><a href="products.html">Products</a></li>
                    <li><a href="faq.html">FAQ</a></li>
                </ul>    
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; Versori 2024</p>
        </div>
    </footer>



    <script>
    
    // JavaScript to toggle between view and manage mode
    function manageSupplier() {
        document.getElementById('addSupplierBtn').style.display = 'none'; 
        document.getElementById('manageSupplierBtn').style.display = 'none'; 
        document.getElementById('cancelBtn').style.display = 'block'; 

        document.getElementById('viewMode').style.display = 'none';
        document.getElementById('editMode').style.display = 'block';
        
    }

    function cancelSupplier() {
        document.getElementById('addSupplierBtn').style.display = 'inline-block'; 
        document.getElementById('manageSupplierBtn').style.display = 'inline-block'; 
        document.getElementById('cancelBtn').style.display = 'none'; 

        document.getElementById('editMode').style.display = 'none';
        document.getElementById('viewMode').style.display = 'block';
        
    }

    function summary() {
        document.getElementById('summaryTab').style.display='block'
        document.getElementById('rbpTab').style.display='none'
        document.getElementById('rboTab').style.display='none'
        document.getElementById('cancelledOrdersTab').style.display='none'
        document.getElementById('customOrdersTab').style.display='none'
    }
    function rbp() {
        document.getElementById('summaryTab').style.display='none'
        document.getElementById('rbpTab').style.display='block'
        document.getElementById('rboTab').style.display='none'
        document.getElementById('cancelledOrdersTab').style.display='none'
        document.getElementById('customOrdersTab').style.display='none'
    }
    function rbo() {
        document.getElementById('summaryTab').style.display='none'
        document.getElementById('rbpTab').style.display='none'
        document.getElementById('rboTab').style.display='block'
        document.getElementById('cancelledOrdersTab').style.display='none'
        document.getElementById('customOrdersTab').style.display='none'
    }
    function cancelOrder() {
        document.getElementById('summaryTab').style.display='none'
        document.getElementById('rbpTab').style.display='none'
        document.getElementById('rboTab').style.display='none'
        document.getElementById('cancelledOrdersTab').style.display='block'
        document.getElementById('customOrdersTab').style.display='none'
    }
    function customOrder() {
        document.getElementById('summaryTab').style.display='none'
        document.getElementById('rbpTab').style.display='none'
        document.getElementById('rboTab').style.display='none'
        document.getElementById('cancelledOrdersTab').style.display='none'
        document.getElementById('customOrdersTab').style.display='block'
    }
    </script>
    
    
    <script src="index.js"></script>
</body>
</html>