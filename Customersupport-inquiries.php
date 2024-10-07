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
    $customer_sql = "SELECT Inquiry_ID, Inquiry_Date, First_name, Last_name, Email, Phone_no, Topic, Other, Customer_ID,Status FROM Inquiries";
    $customer_result = $conn->query($customer_sql);
    ?>

    <main class="dashboard-container" >
        <section class="im-page-links">
            <ul>
                <li class="im-page"><a href="CustomerSupportDashboard.php">Home</a></li>
                <li class="im-page"><a href="Customersupport-inquiries.php">Inquiries</a></li>
                <li class="im-page"><a href="Customersupport-consultations.php">Consultations</a></li>
                <li class="im-page"><a href="Customersupport-helpcentre.php">Help Centre</a></li>
            </ul>
        </section>


        <section class="content" >
        <div >

            <div id="viewMode" class="table-container">

            <div id="overviewContainer">
                <h1 style="text-align:center">Inquiries</h1>
            </div>

                <div style=" margin-top: 100px;height: 85vh; overflow:auto;">

                    <?php if ($customer_result->num_rows > 0): ?>
                        <table class="customer_table" style="width: 1400px;border-collapse: collapse;text-align: left;margin-right: 20px;margin-left: 20px; font-size:12px;margin-bottom:100px;box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);">
                            <thead>
                                <tr>
                                    <th>Inquiry ID</th>
                                    <th>Inquiry Date</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone No</th>
                                    <th>Topic</th>
                                    <th>Other Details</th>
                                    <th>Customer ID</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $customer_result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row["Inquiry_ID"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["Inquiry_Date"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["First_name"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["Last_name"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["Email"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["Phone_no"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["Topic"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["Other"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["Customer_ID"]); ?></td>
                                    <td style="background-color: <?php echo $row["Status"] == 'Active' ? 'rgba(255, 97, 97, 1)' : ($row["Status"] == 'Closed' ? 'rgba(103, 255, 188, 1)' : ''); ?>;">
                                            <?php echo htmlspecialchars($row["Status"]); ?>
                                    </td>
                                    <td>
                                    <button style="background-color: #0B2F9F; border-radius: 5px; border: none; padding: 5px;"><a href="update_inquiry.php?updateid=<?php echo $row['Inquiry_ID']; ?>" style="text-decoration: none; color: white;">Update</a></button>
                                    <button style="background-color: #B8001F; border-radius: 5px; border: none; padding: 5px;  margin-top: 10px"><a href="delete-inquiries.php?deleteid=<?php echo $row['Inquiry_ID']; ?>" style="text-decoration: none; color: white;">Delete</a></button>
                                    </td>
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

    <script>
        function updateSelectColor(selectElement) {
            if (selectElement.value === "Active") {
                selectElement.style.backgroundColor = "red";
            } else if (selectElement.value === "Closed") {
                selectElement.style.backgroundColor = "green";
            }
        }

        // Set initial colors based on current status
        document.addEventListener('DOMContentLoaded', function() {
            const selectElements = document.querySelectorAll('select[id^="Solved_"]');
            selectElements.forEach(selectElement => updateSelectColor(selectElement));
        });
    </script>

    


</body>
</html>
