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
   <!-- <link rel="stylesheet" href="styles/Admin_Dashboard.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- social media icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Questrial Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">


    <style>
        html{
    background-color: #ECDFCC ;
}

/* General Styles */
body {
    font-family: Arial, sans-serif; 
    margin: 0;
    padding: 0;
}

header {
    background-color: #697565;
    padding: 20px 0px;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 120px;
}




/* HEADER */
/* HEADER */
.top-container{
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}

.logo-notification {
    display: flex;
    padding-left: 20px;
}

.logo-notification .logo-content img{
    height: 80px;
    padding-left: 5px;
}

.logo-notification .notification {
    padding-right: 0;
}

.title {
    color: #ECDFCC
}

.profile-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-right: 20px;
}

.profile-container i{
    font-size:36px;
    padding-bottom: 10px;
}

.profile-container p{
    font-family: Questrial,sans-serif;
    margin-top: 0px; color: #ECDFCC;
}

#logout-btn{
    border: none;
    height: 30px;
    width: 90px;
    border-radius: 10px;

}








/* END OF HEADER */
/* END OF HEADER */

/* FOOTER */
/* FOOTER */

/* Footer Section */
footer {
    background-color: #697565;
    color: white;
    padding: 40px 0px;
    bottom: 0;
    left: 0;
    width: 100%;
}

.social-media{
    margin-right: 100px;
}

.fa {
    padding: 20px;
    font-size: 30px;
    width: 30px;
    text-align: center;
    text-decoration: none;
    border-radius: 50%;
    color: #ECDFCC;
}

.footer-links {
    font-family: questrial, sans-serif;
    display: flex;
    justify-content: space-around;
    margin-bottom: 20px;
}

.footer-links ul {
    margin: 10px;
    list-style-type: none;
}

.footer-links ul a {
    color: #fff;
    text-decoration: none;
}

.footer-links ul a:hover {
    color: #ECDFCC;
}

.footer-links li {
    margin-bottom: 0.5rem;
}

.footer-bottom {
    text-align: center;
    padding-top: 10px;
}


/* END OF FOOTER */
/* END OF FOOTER */



/* MAIN CONTENT  */
/* MAIN CONTENT  */
/* MAIN CONTENT  */







.dashboard-container {
    display: flex;
    height: 110%;
}

/* Navigation Bar */
.im-page-links{
    width: 270px;
    background-color: #2c3e50;
    padding-top: 40px;
}
.im-page-links ul{
    list-style-type: none;
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin: 0;
    padding: 0px;
}
.im-page-links li {
    padding: 10px;
    text-align: left;
}
.im-page a{
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    padding: 10px 8px 10px 32px;
    text-decoration: none;
    font-size: 1.1rem;
    color: #e0e0e0;
    display: block;
    transition: 0.3s;
}
.im-page-links li a:hover {
    background-color: #34495e;
    padding-left: 20px;
    transition: 0.3s;
}


.customer_table{
    width: 1400px;
    border-collapse: collapse;
    font-size: 15px;
    text-align: left;
    margin-right: 20px;
    margin-left: 20px;
    
}

.staff_table{
    width: 1400px;
    border-collapse: collapse;
    font-size: 15px;
    text-align: left;
    margin-right: 20px;
    margin-left: 20px;
}

th, td {
    padding: 12px 15px;
    border: 1px solid #ddd;
}

thead {
    background-color: #f2f2f2;

}

tbody tr{
    background-color: white;
}

tbody tr:hover {
    background-color: #f1f1f1;
    cursor: pointer;
}

th {
    background-color: #3672ae;
    color: white;
}

tbody td {
    vertical-align: middle;
}

p {
    font-size: 18px;
    font-weight: bold;
    text-align: center;
    margin-top: 20px;
}

.overview_buttons{
    text-align: center;
    width: 100%;
    height: 250px;
    justify-content: center;
    display: flex;
    justify-content: center;
    gap: 50px;
    margin-top: 20px;
}

.overview_buttons button{
    transition: transform .2s;
    border: none;
    border-radius: 10px;
    font-size: 40px;
    height: 200px;
    width: 400px;
}

.overview_buttons button:hover{
    box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.2);
    transform: scale(1.05);

}


.btn1 {
    background-color: #2c3e50;
    color: white;
    font-weight:200;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s;
    margin-right: 20px;
}
.btn1 a {
    text-decoration: none;
    color: white;
    padding: 8px;

}
 .btn1:hover {
    background-color: #34495e;
}

#chartContainer{
    margin-bottom: 100px;
}
    </style>

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

        <section class="content"></section>

        <div style="width:100%;  margin-bottom: 100px;">

            <div id="overviewContainer">
                <h1 style="text-align:center">Admin Dashboard Overview</h1>

            </div>

            <div class="overview_buttons">
                <button style="background-color:white;"><text style="font-size: 30px; font-family: 'Questrial', sans-serif;">Staff Accounts</text><br><br><?php echo $staff_count; ?></button>
                <button style="background-color:white;"><text style="font-size: 30px; font-family: 'Questrial', sans-serif;">Customer Accounts</text><br><br><?php echo $customer_count; ?></button>
            </div>


            <!-- Account Creation Chart -->
            <div id="chartContainer" style=" height: 70vh; overflow:auto; background-color: white; width:70vw; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding: 20px;margin-left:7%;">
               <h1 style="text-align:center; font-family: 'Questrial', sans-serif;">Account Creation Overview</h1>
                <canvas id="accountCreationChart" width="200" height="100" style="margin-right: 30px; margin-left: 30px;"></canvas>
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
            type: 'line', 
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
