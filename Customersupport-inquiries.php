<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: adminlogin.php");
    exit();
}
if($_SESSION['staff_role']!=='Support'){ //condition make sure admin user redirect to correct page
    header("Location: adminlogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Support Dashboard</title>
    <link rel="stylesheet" href="styles/Admin_Dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- social media icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>

    <header>
        <div class="top-container">
            <div class="logo-notification">
                <div class="logo-content">
                    <a href="Index.html"><img src="images/versori 2.png" alt="logo"></a>
                </div>
                <div class="notification">
                    <i class="fa fa-bell" style="font-size:30px"></i>
                </div>
            </div>

            <div class="title">
                <h1>Customer Support Dashboard</h1>
            </div>

            <div class="profile-container">
                <img src="images/profile-google.svg" alt="Profile Icon" class="fa fa-user-circle-o profile-icon" onclick="toggleDropdown()">
                <p style="font-family: 'Questrial', sans-serif;"><?php echo$_SESSION['name']?></p>
                <a href="adminlogout.php"><button id="logout-btn">Logout</button></a>
            </div>
        </div>
    </header>

    <main class="dashboard-container">
        <section class="im-page-links">
            <ul>
                <li class="im-page"><a href="CustomerSupportDashboard.php">Home</a></li>
                <li class="im-page"><a href="Customersupport-inquiries.php">Inquiries</a></li>
                <li class="im-page"><a href="#">Staff Management</a></li>
            </ul>
        </section>


            <div style="width:100%;">

            <div id="overviewContainer">
                <h1 style="text-align:center">Inquiries</h1>
            </div>

            </div>


            <section class="content">
        <div>
                            <!-- Customer Accounts Section -->
            <h1 style="text-align:left; margin-left:25px;">Inquiries</h1>
            <div style="float:right; margin-bottom: 10px;">

            </div>




            <div id="viewMode" class="table-container">
                <div >

                    <?php if ($customer_result->num_rows > 0): ?>
                        <table class="customer_table" style="justify-content:center; ">
                            <thead>
                                <tr>
                                    <th>Customer ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Address</th>
                                    <th>Phone No</th>
                                    <th>Date of Birth</th>
                                    <th>Date Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $customer_result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row["Customer_ID"]; ?></td>
                                    <td><?php echo $row["First_name"]; ?></td>
                                    <td><?php echo $row["Last_name"]; ?></td>
                                    <td><?php echo $row["Email"]; ?></td>
                                    <td><?php echo $row["Password"]; ?></td>
                                    <td><?php echo $row["Address"]; ?></td>
                                    <td><?php echo $row["Phone_no"]; ?></td>
                                    <td><?php echo $row["Dob"]; ?></td>
                                    <td><?php echo $row["Date_created"]; ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No customer records found.</p>
                    <?php endif; ?>

                </div>

            </div>







            <div class="table-container" id="editMode" style="display: none;">

            <?php
            // SQL query to fetch data from customer account table
            $customer_sql = "SELECT Customer_ID, First_name, Last_name, Email, Password, Address, Phone_no, Dob, Date_created FROM Customer_account";
            $customer_result = $conn->query($customer_sql);
            ?>

            <table class="customer_table" style="justify-content:center;">
                    <thead>
                        <tr>
                            <th>Customer ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Address</th>
                            <th>Phone No</th>
                            <th>Date of Birth</th>
                            <th>Date Created</th>
                            <th>Action</th> <!-- column for the Update & Delete button -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $customer_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["Customer_ID"]; ?></td>
                            <td><?php echo $row["First_name"]; ?></td>
                            <td><?php echo $row["Last_name"]; ?></td>
                            <td><?php echo $row["Email"]; ?></td>
                            <td><?php echo $row["Password"]; ?></td>
                            <td><?php echo $row["Address"]; ?></td>
                            <td><?php echo $row["Phone_no"]; ?></td>
                            <td><?php echo $row["Dob"]; ?></td>
                            <td><?php echo $row["Date_created"]; ?></td>
                            <td>
                                <button style="background-color: #0B2F9F; border-radius: 5px; border: none; padding: 5px;"><a href="update_customer.php?updateid=<?php echo $row['Customer_ID']; ?>" style="text-decoration: none; color: white;">Update</a></button>
                                <button style="background-color: #B8001F; border-radius: 5px; border: none; padding: 5px;"><a href="delete_customer.php?deleteid=<?php echo $row['Customer_ID']; ?>" style="text-decoration: none; color: white;">Delete</a></button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

            </div>

            <?php $conn->close(); // Close the connection ?>
        </div>

        </section>

    </main>

    <script src="Index.js"></script>
    


</body>
</html>
