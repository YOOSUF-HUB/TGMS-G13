<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
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
                    <a href="index.php"><img src="images/versori 2.png" alt="logo"></a>
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

    // SQL queries to count active and closed inquiries
    $customer_count_sql = "SELECT COUNT(*) as status_active FROM Inquiries WHERE Status = 'Active'";
    $customer_count_result = $conn->query($customer_count_sql);
    $customer_count_row = $customer_count_result->fetch_assoc();
    $status_active = $customer_count_row['status_active'];

    $staff_count_sql = "SELECT COUNT(*) as status_closed FROM Inquiries WHERE Status = 'Closed'";
    $staff_count_result = $conn->query($staff_count_sql);
    $staff_count_row = $staff_count_result->fetch_assoc();
    $status_closed = $staff_count_row['status_closed'];

    // SQL queries for Help and Consultation
    $help_active_sql = "SELECT COUNT(*) as active_help FROM Help WHERE Status = 'Active'";
    $help_active_result = $conn->query($help_active_sql);
    $help_active_row = $help_active_result->fetch_assoc();
    $active_help = $help_active_row['active_help'];

    $help_closed_sql = "SELECT COUNT(*) as closed_help FROM Help WHERE Status = 'Closed'";
    $help_closed_result = $conn->query($help_closed_sql);
    $help_closed_row = $help_closed_result->fetch_assoc();
    $closed_help = $help_closed_row['closed_help'];

    $consultation_active_sql = "SELECT COUNT(*) as active_consultation FROM Consultation WHERE Status = 'Active'";
    $consultation_active_result = $conn->query($consultation_active_sql);
    $consultation_active_row = $consultation_active_result->fetch_assoc();
    $active_consultation = $consultation_active_row['active_consultation'];

    $consultation_closed_sql = "SELECT COUNT(*) as closed_consultation FROM Consultation WHERE Status = 'Closed'";
    $consultation_closed_result = $conn->query($consultation_closed_sql);
    $consultation_closed_row = $consultation_closed_result->fetch_assoc();
    $closed_consultation = $consultation_closed_row['closed_consultation'];

    $conn->close(); // Close the connection
    ?>

    <main class="dashboard-container">
        <section class="im-page-links" style="height:180vh;">
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

        <!-- Inquiries Overview Chart -->
        <div id="chartContainer" style="background-color: white; width:70vw; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding: 20px; margin-left:7%;margin-top:7%;">
            <h1 style="text-align:center">Inquiries Overview</h1>
            <canvas id="accountCreationChart" width="800" height="200" style="margin-right: 30px; margin-left: 30px;"></canvas>
        </div>

        <!-- Help Requests Chart -->
        <div id="chartContainer" style="background-color: white; width:70vw; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding: 20px; margin-left:7%;margin-top:7%;">
            <h1 style="text-align:center">Help Requests Overview</h1>
            <canvas id="helpChart" width="800" height="200" style="margin-right: 30px; margin-left: 30px;"></canvas>
        </div>

        <!-- Consultation Requests Chart -->
        <div id="chartContainer" style="background-color: white; width:70vw; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding: 20px; margin-left:7%;margin-top:7%;">
            <h1 style="text-align:center">Consultation Requests Overview</h1>
            <canvas id="consultationChart" width="800" height="200" style="margin-right: 30px; margin-left: 30px;"></canvas>
        </div>

        </div>

    </main>

    <script src="Index.js"></script>

    <script>
        // Declaring variables
        const customerCount = <?php echo $status_active; ?>;
        const staffCount = <?php echo $status_closed; ?>;
        const totalCount = customerCount + staffCount;

        const helpActive = <?php echo $active_help; ?>;
        const helpClosed = <?php echo $closed_help; ?>;
        const totalhelp = helpActive + helpClosed;

        const consultationActive = <?php echo $active_consultation; ?>;
        const consultationClosed = <?php echo $closed_consultation; ?>;

        // Chart for Inquiries Overview
        const ctx = document.getElementById('accountCreationChart').getContext('2d');
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

        // Chart for Help Requests Overview
        const ctxHelp = document.getElementById('helpChart').getContext('2d');
        const helpChart = new Chart(ctxHelp, {
            type: 'line',
            data: {
                labels: ['Active Help Requests', 'Closed Help Requests', 'Total Help Requests'], // Add total to labels
                datasets: [{
                    label: 'Help Requests',
                    data: [helpActive, helpClosed, totalhelp], // Include totalhelp in the data
                    backgroundColor: [
                        'rgba(255, 120, 120, 1)', // Color for active help
                        'rgba(103, 255, 188, 1)', // Color for closed help
                        'rgba(100, 163, 150, 1)'  // Color for total help
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

        // Declare totalConsultation
        const totalConsultation = consultationActive + consultationClosed;

        // Chart for Consultation Requests Overview
        const ctxConsultation = document.getElementById('consultationChart').getContext('2d');
        const consultationChart = new Chart(ctxConsultation, {
            type: 'line',
            data: {
                labels: ['Active Consultation Requests', 'Closed Consultation Requests', 'Total Consultation Requests'], // Add total to labels
                datasets: [{
                    label: 'Consultation Requests',
                    data: [consultationActive, consultationClosed, totalConsultation], // Include totalConsultation in the data
                    backgroundColor: [
                        'rgba(255, 120, 120, 1)', // Color for active consultation
                        'rgba(103, 255, 188, 1)', // Color for closed consultation
                        'rgba(100, 163, 150, 1)'  // Color for total consultation
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
