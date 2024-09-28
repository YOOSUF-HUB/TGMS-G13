<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Dashboard</title>
    <link rel="stylesheet" href="styles/Admin_dashboard.css">
    <!-- Questrial Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- social media icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
                <h1>System Administrator Dashboard</h1>
            </div>

            <div class="profile-container">
                <img src="images/profile-google.svg" alt="Profile Icon" class="fa fa-user-circle-o profile-icon" onclick="toggleDropdown()">
                <p style="font-family: 'Questrial', sans-serif;">System Administrator</p>
                <a href="logout.php"><button id="logout-btn">Logout</button></a>
            </div>
        </div>
    </header>

    <?php
    // Include the database connection file here
    include 'php/config.php';

    // SQL query to fetch data
    $sql = "SELECT Customer_ID, First_name, Last_name, Email, Password, Address, Phone_no, Dob, Date_created FROM Customer_account";
    $result = $conn->query($sql);
    ?>

    <!-- Display message after deletion -->
    <?php if (isset($_GET['message'])): ?>
        <p style="color: green; text-align:center;"><?php echo $_GET['message']; ?></p>
    <?php endif; ?>

    <main class="dashboard-container">
        <section class="im-page-links">
            <ul>
                <li class="im-page"><a href="AdminDashboard.php">Home</a></li>
                <li class="im-page"><a href="#">ADD TEXT</a></li>
            </ul>
        </section>

        <div>
            <h1 style="text-align:center">Customer Accounts</h1>

            <?php if ($result->num_rows > 0): ?>
                <table class="customer_table" style="justify-content:center">
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
                            <th>Action</th> <!-- New column for the Update button -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
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
                            <!-- Add Update button -->
                            <td>
                                <form method="POST" action="update_customer.php">
                                    <input type="hidden" name="Customer_ID" value="<?php echo $row['Customer_ID']; ?>">
                                    <button type="submit" style="background-color:blue; color:white; border:none; padding:5px 10px; cursor:pointer;">Update</button>
                                </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>


            <?php else: ?>
                <p>No customer records found.</p>
            <?php endif; ?>

            <?php $conn->close(); // Close the connection ?>
        </div>
    </main>

    <script src="Index.js"></script>

</body>
</html>
