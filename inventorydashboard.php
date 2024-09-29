<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: adminlogin.php");
    exit();
}
?>
<?php
    // Include the database connection file here
    include 'php/config.php';

    // SQL query to group by product Name and sum the quantities
    $group_query = "SELECT `Name`, SUM(`Quantity`) AS TotalQuantity FROM `Inventory` GROUP BY `Name`";
    $result = mysqli_query($conn, $group_query);

    // SQL query to fetch data
    // $sql = "SELECT Name, Quantity FROM Inventory";
    // $result = $conn->query($sql);
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
                <li class="im-page"><a href="inventorydashboard.php" style="background-color: #34495e; padding-left: 20px;">Home</a></li>
                <li class="im-page"><a href="inventorypage.php" >Inventory</a></li>
                <li class="im-page"><a href="production.html">Production</a></li>
                <li class="im-page"><a href="order.html">Orders</a></li>
                <li class="im-page"><a href="supplier.html">Suppliers</a></li>
                <li class="im-page"><a href="inventoryreport.html">Report</a></li>
            </ul>
        </section>

        <section class="content" >
            <div class="sales-target-container">
                <div style="display: flex; justify-content: space-between;">
                    <h2>Monthly Sales Target</h2>
                    <input type="button" value="Set-Target">
                </div>

                <div class="progress-bar-container">
                    <div class="progress-bar" id="progress-bar"></div>
                </div>
                
                <div class="text">
                    <p>Target: <span id="target-amount">$5000</span></p>
                    <p>Completed: <span id="completed-percentage">0%</span></p>
                </div>
            </div>

            <div class="table-container">
                <h2>Inventory</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Inventory</th>
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
                        <tr>
                            <td class="orders">Product A <span>Color,Size</span></td>
                            <td class="orderid">#O12134</td>
                            <td class="qty">40</td>
                            <td class="delivery">10/02/2024</td>
                            <td class="status">In-Progress</td>
                        </tr>
                        <tr>
                            <td class="orders">Product A <span>Color,Size</span></td>
                            <td class="orderid">#O12134</td>
                            <td class="qty">40</td>
                            <td class="delivery">10/02/2024</td>
                            <td class="status">In-Progress</td>
                        </tr>
                        <tr>
                            <td class="orders">Product A <span>Color,Size</span></td>
                            <td class="orderid">#O12134</td>
                            <td class="qty">40</td>
                            <td class="delivery">10/02/2024</td>
                            <td class="status">In-Progress</td>
                        </tr>
                        <tr>
                            <td class="orders">Product A <span>Color,Size</span></td>
                            <td class="orderid">#O12134</td>
                            <td class="qty">40</td>
                            <td class="delivery">10/02/2024</td>
                            <td class="status">In-Progress</td>
                        </tr>
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
        // Define target and completed sales
        const targetAmount = 5000;  // Sales target amount
        const completedSales = 1900;  // Sales completed so far

        // Calculate the percentage completed
        const completedPercentage = (completedSales / targetAmount) * 100;

        // Update the progress bar and percentage displayed
        document.addEventListener("DOMContentLoaded", () => {
            const progressBar = document.getElementById('progress-bar');
            const completedPercentageElement = document.getElementById('completed-percentage');

            // Set the width of the progress bar based on percentage
            progressBar.style.width = `${completedPercentage}%`;

            // Update the displayed completed percentage
            completedPercentageElement.textContent = `${Math.round(completedPercentage)}%`;
        });
    </script>


    <script src="index.js"></script>
</body>
</html>