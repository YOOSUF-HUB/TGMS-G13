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

    // SQL query to fetch data
    $sql = "SELECT `Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity` FROM Inventory";
    $result = $conn->query($sql);
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
                    <a href="Index.html"> <img src="./images/versori 2.png" alt="logo" > </a>
                </div>
            </div>

            <div class="title">
                <h1>Inventory Manager Dashboard</h1>
            </div>

            <div class="profile-container" >
                <i class="fa fa-user-circle-o profile-icon"></i>
                
                <p><?php echo$_SESSION['name']?></p>
                <button id="logout-btn" ><a href="adminlogout.php">Logout</a></button>
            </div>

            


            
        </div>
    </header>
   
    <main class="dashboard-container">
        <section class="im-page-links" >
            <ul>
                <li class="im-page"><a href="inventory-Dashboard.php">Home</a></li>
                <li class="im-page"><a href="inventory-Inventory.php" style="background-color: #34495e; padding-left: 20px;">Inventory</a></li>
                <li class="im-page"><a href="inventory-Production.php">Production</a></li>
                <li class="im-page"><a href="inventory-Orders.php">Orders</a></li>
                <li class="im-page"><a href="inventory-Supplier.php">Suppliers</a></li>
                <li class="im-page"><a href="inventory-Report.php">Report</a></li>
            </ul>
        </section>

        <section class="content" >
            <div style="float:right;">
                <button class="btn1" id="addInventoryBtn"><a href="inventory-addInventory.php?>" >Add Inventory</a></button>
                <button class="btn1" id="manageInventoryBtn" onclick="manageInventory()" >Manage Inventory</button>
                <button class="btn1" id="cancelBtn" style="display: none;" onclick="cancelInventory()"  >Cancel Manage</button>
            </div>

            <div id="viewMode" class="table-container" >
                <h2>Inventory</h2>
                <div class="inner-table-container" style="height: 85vh; overflow:auto; "> 
                <table class="table" >
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Colour</th>
                            <th>Size</th>
                            <th>Type</th>
                            <th>Inventory</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["Product_ID"]; ?></td>
                            <td><?php echo $row["Name"]; ?></td>
                            <td><?php echo $row["Colour"]; ?></td>
                            <td><?php echo $row["Size"]; ?></td>
                            <td><?php echo $row["Type"]; ?></td>
                            <td><?php echo $row["Quantity"]; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                </div>
            </div>

            <!-- Manage inventory -->
            <div id="editMode" style="display: none;" class="table-container">
                <h2>Manage Inventory</h2>
                <div class="inner-table-container" style="height: 85vh; overflow:auto; ">
                <form action="" method="POST">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Colour</th>
                            <th>Size</th>
                            <th>Type</th>
                            <th>Inventory</th>
                            <th>Manage</th> <!--  new column will appear to manage inventory -->
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    
                    $result->data_seek(0); // Reset the result pointer to reuse the data for the duplicated table
                    while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["Product_ID"]; ?></td>
                            <td><?php echo $row["Name"]; ?></td>
                            <td><?php echo $row["Colour"]; ?></td>
                            <td><?php echo $row["Size"]; ?></td>
                            <td><?php echo $row["Type"]; ?></td>
                            <td><?php echo $row["Quantity"]; ?></td>
                            <td>
                                <button style="background-color: #0B2F9F; border-radius: 5px; border: none; padding: 5px;"><a href="inventory-updateInventory.php?updateid=<?php echo $row['Product_ID']; ?>" style="text-decoration: none; color: white;">Update</a></button>
                                <button style="background-color: #B8001F; border-radius: 5px; border: none; padding: 5px;"><a href="inventory-deleteInventory.php?deleteid=<?php echo $row['Product_ID']; ?>" style="text-decoration: none; color: white;">Delete</a></button>
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
    function manageInventory() {
        document.getElementById('addInventoryBtn').style.display = 'none'; 
        document.getElementById('manageInventoryBtn').style.display = 'none'; 
        document.getElementById('cancelBtn').style.display = 'block'; 

        document.getElementById('viewMode').style.display = 'none';
        document.getElementById('editMode').style.display = 'block';
        
    }

    function cancelInventory() {
        document.getElementById('addInventoryBtn').style.display = 'inline-block'; 
        document.getElementById('manageInventoryBtn').style.display = 'inline-block'; 
        document.getElementById('cancelBtn').style.display = 'none'; 

        document.getElementById('editMode').style.display = 'none';
        document.getElementById('viewMode').style.display = 'block';
        
    }
    </script>
    
    <script src="index.js"></script>
</body>
</html>