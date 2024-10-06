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
    // Include the database connection file here
    include 'php/config.php';

    
    $sql = "SELECT 
        O.Order_ID as oid,
        I.Name as pname,
        I.Colour as pcolour,
        I.Size as psize,
        C.Customer_ID as cid,
        O.Quantity as qty,
        O.Order_Date as odate,
        O.Delivery_Date as ddate,
        O.Status as sts
    FROM Orders O, Customer_account C, Inventory I
    where O.Customer_ID = C.Customer_ID AND O.Product_ID = I.Product_ID;";

    $result = $conn->query($sql);

    $active_sql = "SELECT 
        O.Order_ID as oid,
        I.Name as pname,
        C.Customer_ID as cid,
        O.Quantity as qty,
        O.Order_Date as odate,
        O.Delivery_Date as ddate,
        O.Status as sts
    FROM Orders O, Customer_account C, Inventory I
    where O.Customer_ID = C.Customer_ID AND O.Product_ID = I.Product_ID AND O.Status ='In-Progress'";
    $active_result =$conn->query($active_sql);

    $completed_sql = "SELECT 
        O.Order_ID as oid,
        I.Name as pname,
        C.Customer_ID as cid,
        O.Quantity as qty,
        O.Order_Date as odate,
        O.Delivery_Date as ddate,
        O.Status as sts
    FROM Orders O, Customer_account C, Inventory I
    where O.Customer_ID = C.Customer_ID AND O.Product_ID = I.Product_ID AND O.Status ='Delivered'";
    $completed_result =$conn->query($completed_sql);

    $cancelled_sql = "SELECT 
        O.Order_ID as oid,
        I.Name as pname,
        C.Customer_ID as cid,
        O.Quantity as qty,
        O.Order_Date as odate,
        O.Delivery_Date as ddate,
        O.Status as sts
    FROM Orders O, Customer_account C, Inventory I
    where O.Customer_ID = C.Customer_ID AND O.Product_ID = I.Product_ID AND O.Status ='Cancelled'";
    $cancelled_result =$conn->query($cancelled_sql);

    $custom_sql = "SELECT 
        O.Order_ID as oid,
        O.Order_type as otype,
        C.Customer_ID as cid,
        O.Quantity as qty,
        O.Order_Date as odate,
        O.Delivery_Date as ddate,
        O.Status as sts
    FROM Orders O, Customer_account C, Inventory I
    where O.Customer_ID = C.Customer_ID AND O.Product_ID = I.Product_ID AND O.Order_type ='Custom'";
    $custom_result =$conn->query($custom_sql);
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
                <li class="im-page"><a href="inventory-Orders.php" style="background-color: #34495e; padding-left: 20px;">Orders</a></li>
                <li class="im-page"><a href="inventory-Supplier.php">Suppliers</a></li>
                <li class="im-page"><a href="inventory-Report.php">Report</a></li>
            </ul>
        </section>

        <section class="content" >
            <div style="float:right;">
                <button class="btn1" id="addSupplierBtn"><a href="inventory-addSupplier.php?>" >Add Supplier</a></button>
                <button class="btn1" id="manageSupplierBtn" onclick="manageSupplier()" >Manage Supplier</button>
                <button class="btn1" id="cancelBtn" style="display: none;" onclick="cancelSupplier()"  >Cancel Manage</button>
            </div>

            <div id="viewMode" class="table-container" >
                <h2>Orders</h2>
                <ul id="tabs"> <!-- page tabs -->
                    <li><button class="tab1" id="allOrderBtn" onclick="allOrder()"; >All Orders</button></li>
                    <li><button class="tab1" id="activeOrderBtn" onclick="activeOrder()">Active Orders</button></li>
                    <li><button class="tab1" id="completedOrderBtn" onclick="completedOrder()">Completed Orders</button></li>
                    <li><button class="tab1" id="cancelledOrderBtn" onclick="cancelOrder()">Cancelled Orders</button></li>
                    <li><button class="tab1" id="customOrderBtn" onclick="customOrder()">Custom Orders</button></li>
                </ul>

                <!-- All Orders List -->
                <div id="allOrdersTab" class="inner-table-container"> 
                <table class="table" >
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Customer ID</th>
                            <th>Quantity</th>
                            <th>Order Date</th>
                            <th>Delivery Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["oid"]; ?></td>
                            <td><?php echo $row["pname"];?><br><p class="insideRow"><?php echo $row["pcolour"]; echo ", "; echo $row["psize"];?> </p></td>
                            <td><?php echo $row["cid"]; ?></td>
                            <td><?php echo $row["qty"]; ?></td>
                            <td><?php echo $row["odate"]; ?></td>
                            <td><?php echo $row["ddate"]; ?></td>
                            <td><?php echo $row["sts"]; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                </div>
                
                <!-- Active Orders List -->
                <div id="activeOrdersTab" class="inner-table-container" style="display:none;"> 
                <table class="table" >
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Customer ID</th>
                            <th>Quantity</th>
                            <th>Order Date</th>
                            <th>Delivery Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $active_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["oid"]; ?></td>
                            <td><?php echo $row["pname"]; ?></td>
                            <td><?php echo $row["cid"]; ?></td>
                            <td><?php echo $row["qty"]; ?></td>
                            <td><?php echo $row["odate"]; ?></td>
                            <td><?php echo $row["ddate"]; ?></td>
                            <td><?php echo $row["sts"]; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                </div>

                <!-- Complted Orders List -->
                <div id="completedOrdersTab" class="inner-table-container" style="display:none; "> 
                <table class="table" >
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Customer ID</th>
                            <th>Quantity</th>
                            <th>Order Date</th>
                            <th>Delivery Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $completed_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["oid"]; ?></td>
                            <td><?php echo $row["pname"]; ?></td>
                            <td><?php echo $row["cid"]; ?></td>
                            <td><?php echo $row["qty"]; ?></td>
                            <td><?php echo $row["odate"]; ?></td>
                            <td><?php echo $row["ddate"]; ?></td>
                            <td><?php echo $row["sts"]; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                </div>
                
                <!-- Cancelled Orders List -->
                <div id="cancelledOrdersTab"  class="inner-table-container" style="display:none; "> 
                <table class="table" >
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Customer ID</th>
                            <th>Quantity</th>
                            <th>Order Date</th>
                            <th>Delivery Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $cancelled_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["oid"]; ?></td>
                            <td><?php echo $row["pname"]; ?></td>
                            <td><?php echo $row["cid"]; ?></td>
                            <td><?php echo $row["qty"]; ?></td>
                            <td><?php echo $row["odate"]; ?></td>
                            <td><?php echo $row["ddate"]; ?></td>
                            <td><?php echo $row["sts"]; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                </div>

                <!-- Custom Orders List -->
                <div id="customOrdersTab" class="inner-table-container" style="display:none; "> 
                <table class="table" >
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Customer ID</th>
                            <th>Quantity</th>
                            <th>Order Date</th>
                            <th>Delivery Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $custom_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["oid"]; ?></td>
                            <td><?php echo $row["otype"]; ?></td>
                            <td><?php echo $row["cid"]; ?></td>
                            <td><?php echo $row["qty"]; ?></td>
                            <td><?php echo $row["odate"]; ?></td>
                            <td><?php echo $row["ddate"]; ?></td>
                            <td><?php echo $row["sts"]; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                </div>
            </div>

            <!-- Manage orders -->
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

    function allOrder() {
        document.getElementById('allOrdersTab').style.display='block'
        document.getElementById('activeOrdersTab').style.display='none'
        document.getElementById('completedOrdersTab').style.display='none'
        document.getElementById('cancelledOrdersTab').style.display='none'
        document.getElementById('customOrdersTab').style.display='none'
    }
    function activeOrder() {
        document.getElementById('allOrdersTab').style.display='none'
        document.getElementById('activeOrdersTab').style.display='block'
        document.getElementById('completedOrdersTab').style.display='none'
        document.getElementById('cancelledOrdersTab').style.display='none'
        document.getElementById('customOrdersTab').style.display='none'
    }
    function completedOrder() {
        document.getElementById('allOrdersTab').style.display='none'
        document.getElementById('activeOrdersTab').style.display='none'
        document.getElementById('completedOrdersTab').style.display='block'
        document.getElementById('cancelledOrdersTab').style.display='none'
        document.getElementById('customOrdersTab').style.display='none'
    }
    function cancelOrder() {
        document.getElementById('allOrdersTab').style.display='none'
        document.getElementById('activeOrdersTab').style.display='none'
        document.getElementById('completedOrdersTab').style.display='none'
        document.getElementById('cancelledOrdersTab').style.display='block'
        document.getElementById('customOrdersTab').style.display='none'
    }
    function customOrder() {
        document.getElementById('allOrdersTab').style.display='none'
        document.getElementById('activeOrdersTab').style.display='none'
        document.getElementById('completedOrdersTab').style.display='none'
        document.getElementById('cancelledOrdersTab').style.display='none'
        document.getElementById('customOrdersTab').style.display='block'
    }
    </script>
    
    
    <script src="index.js"></script>
</body>
</html>