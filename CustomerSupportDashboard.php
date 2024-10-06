<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: adminlogin.php");
    exit();
}
if ($_SESSION['staff_role'] !== 'Support') { // Ensure admin user is redirected to the correct page
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
                <div class="notification">
                    <i class="fa fa-bell" style="font-size:30px"></i>
                </div>
            </div>

            <div class="title">
                <h1>Customer Support Dashboard</h1>
            </div>

            <div class="profile-container">
                <img src="images/profile-google.svg" alt="Profile Icon" class="fa fa-user-circle-o profile-icon" onclick="toggleDropdown()">
                <p style="font-family: 'Questrial', sans-serif;"><?php echo $_SESSION['name']; ?></p>
                <a href="adminlogout.php"><button id="logout-btn">Logout</button></a>
            </div>
        </div>
    </header>

    <?php
    // Include the database connection file here
    include 'php/config.php';

    // SQL query to fetch data from customer account table
    $customer_sql = "SELECT Inquiry_ID, Inquiry_Date, First_name, Last_name, Email, Phone_no, Topic, Other, Customer_ID, Status FROM Inquiries";
    $customer_result = $conn->query($customer_sql);

    // SQL query to count active inquiries
    $customer_count_sql = "SELECT COUNT(*) as status_active FROM Inquiries WHERE Status = 'Active'";
    $customer_count_result = $conn->query($customer_count_sql);
    $customer_count_row = $customer_count_result->fetch_assoc();
    $status_active = $customer_count_row['status_active'];

    // SQL query to count closed inquiries
    $staff_count_sql = "SELECT COUNT(*) as status_closed FROM Inquiries WHERE Status = 'Closed'";
    $staff_count_result = $conn->query($staff_count_sql);
    $staff_count_row = $staff_count_result->fetch_assoc();
    $status_closed = $staff_count_row['status_closed'];

    $conn->close(); // Close the connection
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

        <div style="width:100%;">
            <div id="overviewContainer">
                <h1 style="text-align:center">Support Dashboard Overview</h1>
            </div>

        <!-- Account Creation Chart -->
        <div id="chartContainer" style="background-color: white; width:70vw; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding: 20px; margin-left:7%;margin-top:7%;">
            <h1 style="text-align:center">Account Creation Overview</h1>
            <canvas id="accountCreationChart" width="800" height="200" style="margin-right: 30px; margin-left: 30px;"></canvas>
        </div>

        </div>


    </main>

    <script src="Index.js"></script>

    <script>
        // Declaring variables
        const customerCount = <?php echo $status_active; ?>;
        const staffCount = <?php echo $status_closed; ?>;
        const totalCount = customerCount + staffCount;

        const ctx = document.getElementById('accountCreationChart').getContext('2d');

        // Create the chart
        const accountCreationChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Active Inquiries', 'Closed Inquiries', 'Total Inquiries'],
                datasets: [{
                    label: 'Total Inquiries',
                    data: [customerCount, staffCount, totalCount],
                    backgroundColor: [
                        'rgba(255, 120, 120, 1)', // Color for active inquiries
                        'rgba(103, 255, 188, 1)', // Color for closed inquiries
                        'rgba(100, 163, 150, 1)' // Color for total inquiries
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true, // Start the y-axis at zero
                        ticks: { stepSize: 1 } // y-axis increases in increments of 1
                    }
                }
            }
        });
    </script>
</body>
</html>
