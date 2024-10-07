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
    include 'php/config.php';

    // Query for summary table
    //getting Total Number of Products and Total Stock Value
    $total_products = "SELECT Price, SUM(Quantity) as tproducts FROM Inventory GROUP BY Price";
    $tproducts_results = mysqli_query($conn, $total_products);
    while ($row = mysqli_fetch_assoc($tproducts_results)){
        $totalProducts += $row['tproducts'];
        $totalValue += $row['tproducts'] * $row['Price'];
    };

    //getting Total Revenue Generated
    $total_revenue = "SELECT SUM(Payment_amount) as tamount FROM Payments";
    $trevenue_results = mysqli_query($conn, $total_revenue);
    $rrow = mysqli_fetch_assoc($trevenue_results);
    $totalRevenue = $rrow['tamount'];

    //getting Total orders received, most ordered product and least orderd product
    $orders = "SELECT I.Name as `name`, SUM(O.Quantity) as qty, COUNT(Order_ID) as torders FROM Inventory I, Orders O
    WHERE I.Product_ID = O.Product_ID GROUP BY I.Name";
    $orders_results = mysqli_query($conn, $orders);
    while ($row = mysqli_fetch_assoc($orders_results)){
        $totalOrders += $row['torders'];
        if ($row['qty'] > $mostOrdered){
            $mostOrdered = $row['qty'];
            $mostOrdered_name = $row['name'];
        }
        if ($leastOrdered === null || $row['qty'] < $leastOrdered){
            $leastOrdered = $row['qty'];
            $leastOrdered_name = $row['name'];
        }
    };

    
    
    



    // Query for revenue by product table
    $rbp_sql = "SELECT 
        I.Name as pname, 
        I.Price as pprice, 
        SUM(O.Quantity) AS qtysold, 
        SUM(P.Payment_amount) AS income FROM Inventory I, Orders O, Payments P
    WHERE I.Product_ID = O.Product_ID AND O.Payment_ID = P.Payment_ID AND O.Status !='Cancelled'  AND (I.Name='Hoodie' OR I.Name='Joggers' OR I.Name='T-Shirt' OR I.Name='Long Sleeve T')
    GROUP BY I.Name";
    $rbp_result =mysqli_query($conn,$rbp_sql);

    // Query for revenue by order table
    $rbo_sql = "SELECT 
        O.Order_ID as oid,
        I.Name as pname,
        C.Customer_ID as cid,
        P.Transaction_id as tid,
        O.Quantity as qty,
        O.Order_Date as odate,
        P.Payment_amount as amount
    FROM Orders O, Customer_account C, Inventory I , Payments P
    where O.Customer_ID = C.Customer_ID AND O.Product_ID = I.Product_ID AND O.Payment_ID = P.Payment_ID AND O.Status!='Cancelled';";
    $rbo_result = mysqli_query($conn, $rbo_sql);

    // Query for monthly revenue table
    $curMonth_sql = "SELECT DATE_FORMAT(Payment_date, '%M %Y') as month, SUM(Payment_amount) as mtotal FROM Payments GROUP BY `month`";
    $curMonth_result = mysqli_query($conn, $curMonth_sql); //execute query

    
    
    
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Dashboard - Report</title>
    <link rel="stylesheet" href="./styles/inventory.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- social media icons -->
</head>

<body>
    <header>
        <div class="top-container">
            <div class="logo-notification" >
                <div class="logo-content">
                    <a href="Index.html"> <img src="./images/versori 2.png" alt="logo" > </a>
                </div>
            
            </div>

            <div class="title">
                <h1>Inventory Manager Dashboard</h1>
            </div>

            <div class="profile-container" >
                <i class="fa fa-user-circle-o profile-icon" ></i>
                
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
                <li class="im-page"><a href="inventory-Orders.php">Orders</a></li>
                <li class="im-page"><a href="inventory-Supplier.php">Suppliers</a></li>
                <li class="im-page"><a href="inventory-Report.php"  style="background-color: #34495e; padding-left: 20px;">Report</a></li>
            </ul>
        </section>

        <section class="content" >

            <div id="viewMode" class="table-container" >
                <h2>Report</h2>
                <ul id="tabs"> <!-- page tabs -->
                    <li><button class="tab1" id="summaryBtn" onclick="summary()"; >Summary</button></li>
                    <li><button class="tab1" id="rbpBtn" onclick="rbp()">Revenue by Products</button></li>
                    <li><button class="tab1" id="rboBtn" onclick="rbo()">Revenue by Orders</button></li>
                    <li><button class="tab1" id="rbmBtn" onclick="rbm()">Monthly Revenue</button></li>
                </ul>
                

                <!-- Summary -->
                <div id="summaryTab" class="inner-table-container"> 
                <table class="table" >
                    
                    <tbody>
                        <tr>
                            <td><strong>Total Number of Products</strong></td>
                            <td><?php echo $totalProducts; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Total Stock Value</strong></td>
                            <td><?php echo 'Rs. '.$totalValue .'.00'; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Total Revenue Generated</strong></td>
                            <td><?php echo 'Rs. '.$totalRevenue; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Total Orders Received</strong></td>
                            <td><?php echo $totalOrders; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Most Ordered Product</strong></td>
                            <td><?php echo $mostOrdered_name.' (' .$mostOrdered. ')'; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Least Ordered Product</strong></td>
                            <td><?php echo $leastOrdered_name.' (' .$leastOrdered. ')'; ?></td>
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
                    <?php while($row = mysqli_fetch_assoc($rbp_result)): ?>
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
                    <?php while($row = mysqli_fetch_assoc($rbo_result)): ?>
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

                <!-- monthly revenues -->
                <div id="rbmTab" class="inner-table-container" style="display:none; ">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Revenue </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = mysqli_fetch_assoc($curMonth_result)){?>
                        <tr>
                            <td><?php echo $row["month"]; ?></td>
                            <td><?php echo $row["mtotal"]; ?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
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
    
    

    function summary() {
        document.getElementById('summaryTab').style.display='block'
        document.getElementById('rbpTab').style.display='none'
        document.getElementById('rboTab').style.display='none'
        document.getElementById('rbmTab').style.display='none'
        document.getElementById('customOrdersTab').style.display='none'
    }
    function rbp() {
        document.getElementById('summaryTab').style.display='none'
        document.getElementById('rbpTab').style.display='block'
        document.getElementById('rboTab').style.display='none'
        document.getElementById('rbmTab').style.display='none'
        document.getElementById('customOrdersTab').style.display='none'
    }
    function rbo() {
        document.getElementById('summaryTab').style.display='none'
        document.getElementById('rbpTab').style.display='none'
        document.getElementById('rboTab').style.display='block'
        document.getElementById('rbmTab').style.display='none'
        document.getElementById('customOrdersTab').style.display='none'
    }
    function rbm() {
        document.getElementById('summaryTab').style.display='none'
        document.getElementById('rbpTab').style.display='none'
        document.getElementById('rboTab').style.display='none'
        document.getElementById('rbmTab').style.display='block'
        document.getElementById('customOrdersTab').style.display='none'
    }
   
    </script>
    
    
</body>
</html>