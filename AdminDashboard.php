<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: adminlogin.php");
    exit();
}
if($_SESSION['staff_role']!=='Admin'){ //condition make sure admin user redirect to correct page
    header("Location: adminlogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Dashboard</title>
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
                <h1>System Administrator Dashboard</h1>
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
    $customer_sql = "SELECT Customer_ID, First_name, Last_name, Email, Password, Address, Phone_no, Dob, Date_created FROM Customer_account";
    $customer_result = $conn->query($customer_sql);

    // SQL query to fetch data from Staff account table
    $staff_sql = "SELECT Staff_ID, Full_name, username, Staff_role, Email, Password, Date_created FROM Staff_account";
    $staff_result = $conn->query($staff_sql);

    // SQL query to count customer accounts
    $customer_count_sql = "SELECT COUNT(*) as customer_count FROM Customer_account";
    $customer_count_result = $conn->query($customer_count_sql);
    $customer_count_row = $customer_count_result->fetch_assoc();
    $customer_count = $customer_count_row['customer_count'];

    // SQL query to count staff accounts
    $staff_count_sql = "SELECT COUNT(*) as staff_count FROM Staff_account";
    $staff_count_result = $conn->query($staff_count_sql);
    $staff_count_row = $staff_count_result->fetch_assoc();
    $staff_count = $staff_count_row['staff_count'];
    ?>

    <main class="dashboard-container">



        <section class="im-page-links">
            <ul>
                <li class="im-page"><a href="AdminDashboard.php">Home</a></li>
                <li class="im-page"><a href="AdminDashboard-user.php">User Management</a></li>
                <li class="im-page"><a href="AdminDashboard-staff.php">Staff Management</a></li>
            </ul>
        </section>

        <div style="width:100%;">

            <div id="overviewContainer">
                <h1 style="text-align:center">Admin Dashboard Overview</h1>

            </div>

            <div class="overview_buttons">
                <button><text style="font-size: 30px;">Staff Accounts</text><br><br><?php echo $staff_count; ?></button>
                <button><text style="font-size: 30px;">Customer Accounts</text><br><br><?php echo $customer_count; ?></button>
            </div>


            <!-- Account Creation Chart -->
            <div id="chartContainer">
                <h1 style="text-align:center">Account Creation Overview</h1>
                <canvas id="accountCreationChart" width="100" height="25" style="margin-right: 30px; margin-left: 30px;"></canvas>
            </div>

            <?php $conn->close(); // Close the connection ?>
        </div>
    </main>

    <script src="Index.js"></script>
    
    <script>
        // declaring variables
        const customerCount = <?php echo $customer_count; ?>;
        const staffCount = <?php echo $staff_count; ?>;
        const totalCount = customerCount + staffCount;

        const ctx = document.getElementById('accountCreationChart').getContext('2d');

        // Create the chart
        const accountCreationChart = new Chart(ctx, {
            type: 'bar', 
            data: {
                labels: ['Customer Accounts', 'Staff Accounts','Total Accounts'],
                datasets: [{
                    label: 'Total Accounts Created',
                    data: [customerCount, staffCount, totalCount],
                    backgroundColor: [
                        'rgba(0, 36, 64, 1)', // Color for customer accounts
                        'rgba(150, 102, 123, 1)', // Color for staff accounts
                        'rgba(100, 163, 150, 1)' //COLOR FOR TOTAL ACCOUNTS
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true, // Start the y-axis at zero
                        ticks: {stepSize: 1} //y axis increases in increments of 1
                    }
                }
            }
        });
    </script>


</body>
</html>
