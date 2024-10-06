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
    <link rel="stylesheet" href="styles/Customersupportdashboard.css">
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


    <?php
    // Include the database connection file here
    include 'php/config.php';

    // SQL query to fetch data from customer account table
    $customer_sql = "SELECT Consultation_ID, Consultation_Date, Full_name, Email, Phone_no, Company_name, Company_website_URL, Company_scale, Brand_overview,Other,Customer_ID FROM Consultation";
    $customer_result = $conn->query($customer_sql);
    ?>


    <main class="dashboard-container">
        <section class="im-page-links">
            <ul>
                <li class="im-page"><a href="CustomerSupportDashboard.php">Home</a></li>
                <li class="im-page"><a href="Customersupport-inquiries.php">Inquiries</a></li>
                <li class="im-page"><a href="Customersupport-consultations.php">Consultations</a></li>
                <li class="im-page"><a href="Customersupport-helpcentre.php">Help Centre</a></li>
            </ul>
        </section>


            <section class="content">
        <div>

            <div id="viewMode" class="table-container">

            <div id="overviewContainer">
                <h1 style="text-align:center">Consultations</h1>
            </div>

                <div>

                    <?php if ($customer_result->num_rows > 0): ?>
                        <table class="customer_table" style="width: 1400px;border-collapse: collapse;text-align: left;margin-right: 20px;margin-left: 20px; font-size:12px;">
                            <thead>
                                <tr>
                                    <th>Consultation_ID</th>
                                    <th>Consultation_Date</th>
                                    <th>Full_name</th>
                                    <th>Email</th>
                                    <th>Phone_no</th>
                                    <th>Company_name</th>
                                    <th>Company_website_URL</th>
                                    <th>Company_scale</th>
                                    <th>Brand_overview</th>
                                    <th>Other</th>
                                    <th>Customer_ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $customer_result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row["Consultation_ID"]; ?></td>
                                    <td><?php echo $row["Consultation_Date"]; ?></td>
                                    <td><?php echo $row["Full_name"]; ?></td>
                                    <td><?php echo $row["Email"]; ?></td>
                                    <td><?php echo $row["Phone_no"]; ?></td>
                                    <td><?php echo $row["Company_name"]; ?></td>
                                    <td><?php echo $row["Company_website_URL"]; ?></td>
                                    <td><?php echo $row["Company_scale"]; ?></td>
                                    <td><?php echo $row["Brand_overview"]; ?></td>
                                    <td><?php echo $row["Other"]; ?></td>
                                    <td><?php echo $row["Customer_ID"]; ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No records found.</p>
                    <?php endif; ?>

                </div>

            </div>

            <?php $conn->close(); // Close the connection ?>
        </div>

        </section>

    </main>

    <script src="Index.js"></script>
    


</body>
</html>
