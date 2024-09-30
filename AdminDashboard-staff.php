<?php
session_start();
if (!isset($_SESSION['username'])) {
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

    // SQL query to fetch data from Staff account table
    $staff_sql = "SELECT Staff_ID, Full_name, username, Staff_role, Email, Password, Date_created FROM Staff_account";
    $staff_result = $conn->query($staff_sql);
    ?>

    <main class="dashboard-container">
        <section class="im-page-links">
            <ul>
                <li class="im-page"><a href="AdminDashboard.php">Home</a></li>
                <li class="im-page"><a href="AdminDashboard-user.php">User Management</a></li>
                <li class="im-page"><a href="AdminDashboard-staff.php">Staff Management</a></li>
            </ul>
        </section>

        <div>

            <!-- Staff Accounts Section -->
            <h1 style="text-align:center; margin-top: 40px">Staff Accounts</h1>
            <a href="create_staff_account.php" style="text-decoration: none; color: white;"> <button style="cursor:pointer;text-decoration: none; color: white;background-color: green; border-radius: 5px; border: none; padding: 10px; margin-left: 20px; height: 40px; margin-bottom: 20px;">Create Staff Account</button></a>

            <?php if ($staff_result->num_rows > 0): ?>
                <table class="staff_table" style="justify-content:center">
                    <thead>
                        <tr>
                            <th>Staff ID</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Staff Role</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Date Created</th>
                            <th>Action</th> <!-- column for the Update & Delete button -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $staff_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["Staff_ID"]; ?></td>
                            <td><?php echo $row["Full_name"]; ?></td>
                            <td><?php echo $row["username"]; ?></td>
                            <td><?php echo $row["Staff_role"]; ?></td>
                            <td><?php echo $row["Email"]; ?></td>
                            <td><?php echo $row["Password"]; ?></td>
                            <td><?php echo $row["Date_created"]; ?></td>
                            <td>
                                <button style="background-color: blue; border-radius: 5px; border: none; padding: 5px;"><a href="staff_accn_update.php?updateid=<?php echo $row['Staff_ID']; ?>" style="text-decoration: none; color: white;">Update</a></button>
                                <button style="background-color: red; border-radius: 5px; border: none; padding: 5px;"><a href="delete_staff_accn.php?deleteid=<?php echo $row['Staff_ID']; ?>" style="text-decoration: none; color: white;">Delete</a></button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No staff records found.</p>
            <?php endif; ?>

            <?php $conn->close(); // Close the connection ?>
        </div>
    </main>

    <script src="Index.js"></script>

</body>
</html>
