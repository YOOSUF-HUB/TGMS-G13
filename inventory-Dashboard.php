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
    // Include the database connection file here
    include 'php/config.php';

    $sql = "SELECT 
        O.Order_ID as oid,
        I.Name as pname,
        I.Colour as pcolour,
        I.Size as psize,
        O.Quantity as qty,
        O.Delivery_Date as ddate,
        O.Status as sts
    FROM Orders O, Customer_account C, Inventory I
    where O.Customer_ID = C.Customer_ID AND O.Product_ID = I.Product_ID AND O.Status ='In-Progress' ORDER BY O.Delivery_Date ASC LIMIT 4;";

    $order_result = $conn->query($sql);

    // SQL query to group by product Name and sum the quantities(Only our main 4 products will be displayed)
    $group_query = "SELECT `Name`, SUM(`Quantity`) AS TotalQuantity FROM `Inventory` 
    WHERE `Name`='Hoodie' || `Name`='Joggers' || `Name`='T-Shirt' || `Name`='Long Sleeve T' GROUP BY `Name`";
    $result = mysqli_query($conn, $group_query);


    $curMonth_sql = "SELECT DATE_FORMAT(Payment_date, '%M') as month, SUM(Payment_amount) as mtotal FROM Payments GROUP BY `month`";
    $curMonth_result = mysqli_query($conn, $curMonth_sql); //excute query

    while ($curMonth_row = mysqli_fetch_assoc($curMonth_result)){
        if($curMonth_row['month'] == date('F')){    
            $curMonth = $curMonth_row['month'];
            $curMonth_revenue = $curMonth_row['mtotal'];
        }
    }

    $find_target = mysqli_query($conn,"SELECT target_amount FROM sales_target WHERE id =1 ");
    $fetch_target = mysqli_fetch_assoc($find_target);
    $targetAmount = $fetch_target['target_amount'];

    if(isset($_GET['submit'])){
        $newtargetAmount = $_GET['targetValue'];

        $target_sql = "UPDATE sales_target SET `month`='$curMonth', target_amount = $newtargetAmount, achieved_amount = $curMonth_revenue where id =1";
        $target_result = mysqli_query($conn, $target_sql);




    }
    $find_target = mysqli_query($conn,"SELECT target_amount FROM sales_target WHERE id =1 ");
    $fetch_target = mysqli_fetch_assoc($find_target);
    $targetAmount = $fetch_target['target_amount'];
    

    
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Dashboard</title>
    <link rel="stylesheet" href="./styles/companyside.css">
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
                    <a href="homepage.php"> <img src="./images/versori 2.png" alt="logo" > </a>
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
                <li class="im-page"><a href="inventory-Dashboard.php" style="background-color: #34495e; padding-left: 20px;">Home</a></li>
                <li class="im-page"><a href="inventory-Inventory.php" >Inventory</a></li>
                <li class="im-page"><a href="inventory-Production.php">Production</a></li>
                <li class="im-page"><a href="inventory-Orders.php">Orders</a></li>
                <li class="im-page"><a href="inventory-Supplier.php">Suppliers</a></li>
                <li class="im-page"><a href="inventory-Report.php">Report</a></li>
            </ul>
        </section>

        <section class="content" >
            <div class="sales-target-container">
                <div style="display: flex; justify-content: space-between;">
                    <h2>Monthly Sales Target : <?php echo $curMonth?></h2>
                    <div>
                        <form action="" method="GET" id="targetValue" style="display: none;">
                            <input type="number" name="targetValue" class="target_field" style="height: 2rem; font-size:1.3rem;">
                            <input type="submit" name="submit" class="btn1" value="submit" onclick="close_setTarget()">
                        </form>
                        <input type="button" class="btn1" value="Set-Target" onclick="setTarget()" id="on_targetValue">
                    </div>
                </div>

                <div class="progress-bar-container">
                    <div class="progress-bar" id="progress-bar"></div>
                </div>
                
                <div class="text">
                    <p>Target: <span id="target-amount">Rs.<?php echo $targetAmount?></span></p>
                    <p>Completed: <span id="completed-percentage">0%</span></p>
                </div>
            </div>

            <div class="table-container">
                <h2>Inventory</h2>
                <table class="table">
                    <thead>
                        <tr style="height: 1rem;">
                            <th>Product Name</th>
                            <th><h5 style="margin: 0; font-size:1rem;">Inventory</h5><h6 style="font-size:0.6rem; line-height:0.3rem; margin:0;">All sizes and colours</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["Name"]; ?></td>
                            <td><?php echo $row["TotalQuantity"]; ?></td>
                        
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <div class="table-container">
                <h2>Orders</h2>
                <table class="table product-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Order ID</th>
                            <th>Quantity</th>
                            <th>Expected Delivery</th>
                            <th>Order Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $order_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["pname"];?><br><p class="insideRow" style="font-size:smaller; margin:0;"><?php echo $row["pcolour"]; echo ", "; echo $row["psize"];?> </p></td>
                            <td><?php echo $row["oid"]; ?></td>
                            <td><?php echo $row["qty"]; ?></td>
                            <td><?php echo $row["ddate"]; ?></td>
                            <td><?php echo $row["sts"]; ?></td>
                        </tr>
                        
                        <?php endwhile; ?>
                    </tbody>
                </table>
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
        function setTarget() { // to display input field and submit btn
            document.getElementById('targetValue').style.display='block';
            document.getElementById('on_targetValue').style.display='none';    
        }
        function close_setTarget() { // to display input field and submit btn
            document.getElementById('targetValue').style.display='none';
            document.getElementById('on_targetValue').style.display='block';    
        }

        const targetAmount = <?php echo $targetAmount?>;  //  target amount
        const completedSales = <?php echo $curMonth_revenue?>;  //  completed sales

        const completedPercentage = (completedSales / targetAmount) * 100;// calculate completed percentage

        // update the progress bar and percentage
        document.addEventListener("DOMContentLoaded", () => {
            const progressBar = document.getElementById('progress-bar');
            const completedPercentageElement = document.getElementById('completed-percentage');

            progressBar.style.width = `${completedPercentage}%`;//width of the progress bar

            // update completed percentage
            completedPercentageElement.textContent = `${Math.round(completedPercentage)}%`;
        });
        
    </script>

    <script src="index.js"></script>
</body>
</html>