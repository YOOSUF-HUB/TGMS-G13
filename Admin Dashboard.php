
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Dashboard</title>
    <link rel="stylesheet" href="styles/Admin_dashboard.css"></lin>
    <style>

    </style>
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
                <h1>System Administrator Dashboard</h1>
            </div>

            <div class="profile-container" >
                <i class="fa fa-user-circle-o profile-icon" onclick="toggleDropdown()"></i>
                
                <p>Nivin Pauly</p>
                <button><a href="logout.php">Logout</a></button>
            </div>

            


            
        </div>
    </header>

    <?php
// Include the database connection file here
include 'php/config.php'; // Assuming you save the connection file as db_connect.php

// SQL query to fetch data
$sql = "SELECT Customer_ID, First_name, Last_name, Email, Password, Address, Phone_no, Dob, Date_created FROM Customer_account";
$result = $conn->query($sql);
?>

    <main class="dashboard-container">

        <section class="im-page-links" >
                <ul>
                    <li class="im-page"><a href="Admin Dashboard.php">Home</a></li>
                    <li class="im-page"><a href="#">ADD TEXT</a></li>

                </ul>
            </section>


        <div>


            <h1 style="text-align:center">Customer Accounts</h1>

            <table class="customer_table" style="justify-content:center">

                <?php if ($result->num_rows > 0): ?>
                <table>
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
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <p>No customer records found.</p>
                <?php endif; ?>

                <?php $conn->close(); // Close the connection ?>

            </table>

        </div>

        


    </main>


</body>
</html>
