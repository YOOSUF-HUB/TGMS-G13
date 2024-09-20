<?php
session_start();  // Start session at the beginning

include('php/config.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, show a message or redirect to login
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];  // Get logged-in user's ID

// Fetch user information from database
$sql = "SELECT * FROM Customer_account WHERE Customer_ID = '$user_id'";
$result = mysqli_query($conn, $sql);

// If user exists, fetch the data
if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User not found.";
    exit;
}

// If the user has clicked the save button, update the data
if (isset($_POST['save'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_no = mysqli_real_escape_string($conn, $_POST['phoneno']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $update_query = "UPDATE Customer_account 
                     SET First_name = '$fname', Last_name = '$lname', Email = '$email'
                     WHERE Customer_ID = '$user_id'";

    if (mysqli_query($conn, $update_query)) {
        echo "<p class='success'>Profile updated successfully!</p>";
        // Refresh the page to load the updated data
        header("Refresh:0");
    } else {
        echo "<p class='error'>Error updating profile: " . mysqli_error($conn) . "</p>";
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Textile and Garment Management System</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- social media icons -->

    <!-- Questrial Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">



</head>

<body>

    <!-- Navigation Bar Section-->
    <header style="padding: 8px 20px;">
        <!-- Side Navigation Menu -->
        <nav id="mySidenav" class="sidenav">
            <!-- Close button -->
            <img onclick="closeNav()" src="images/close-google.svg" class="closebtn" style="width: 30px;">
            
            <!-- Navigation links -->
            <a href="index.html">Home</a>
            <a href="about.html">About</a>
            <a href="services.html">Services</a>
            <a href="contact.php">Contact</a>
            <a href="terms.html">Terms of Services</a>
        </nav>
        <!-- Menu icon (with open function)-->
        <img src="images/menu-google.svg" id="menuIcon" style="width:30px;cursor:pointer" onclick="openNav()">


        <!-- Search Bar section -->
        <section id="searchBar" style="position: relative;">
            <img src="images/search-google.svg" id="searchIcon" style="width: 30px;cursor: pointer;" onclick="opensearchBar()">
            
            <!-- Search bar container -->
            <div id="searchBarContainer">
                <input type="text" id="searchInput" placeholder="Search...">
                <button onclick="performSearch()">Search</button>
            </div>
        </section>



        <!-- Logo Section -->
        <section class="logo">

            <div class="logo-content">
                <a href="Index.html"> <img src="./images/Versori.png" alt="logo" style="height: 50px; padding-right: 90px;"> </a>
            </div>
    
        </section>

        <!-- Profile and Dropdown -->
        <div class="profile-container">
            <!-- Profile Image Icon; clicking on this toggles the dropdown -->
            <img src="images/profile-google.svg" alt="Profile Icon" class="profile-icon" onclick="toggleDropdown()">
            
            <!-- Dropdown Menu content; links for Login, Logout, and My Orders -->
            <div id="myDropdown" class="dropdown-content">
                <a href="#">Profile</a>
                <a href="#">Login</a>
                <a href="#">My Orders</a>
                <a href="#">Logout</a>
            </div>
        </div>


    </header>



    <main>
        <div class="profile-container">
            <div class="myaccount">
                <h1>My Account</h1>
            </div>
            <div>
                <div id="viewMode">
                    <ul>
                        <li><label for="fname">First Name</label> <?php echo htmlspecialchars($user['First_name']); ?></li>
                        <li><label for="lname">Last Name</label> <?php echo htmlspecialchars($user['Last_name']); ?></li>
                    </ul>
                    <ul>
                        <li><label for="phoneno">Contact Number</label> <?php echo htmlspecialchars($user['Phone_no']); ?></li>
                        <li><label for="dob">Date of Birth</label> <?php echo htmlspecialchars($user['Dob']); ?></li>
                    </ul>
                    <ul>
                        <li><label for="email">Email</label> <?php echo htmlspecialchars($user['Email']); ?></li>
                    </ul>
                    <ul>
                        <li><label for="address">Address</label> <?php echo htmlspecialchars($user['Address']); ?></li>
                    </ul>
                    <button onclick="showEditForm()">Edit</button>
                </div>
                <div id="editMode" style="display: none;">
                    <form action="" method="POST">
                        <ul>
                            <li>
                                <label for="fname">First Name:</label>
                                <input type="text" id="fname" name="fname" value="<?php echo htmlspecialchars($user['First_name']); ?>" required>
                            </li>
                            <li>
                                <label for="lname">Last Name:</label>
                                <input type="text" id="lname" name="lname" value="<?php echo htmlspecialchars($user['Last_name']); ?>" required>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <label for="phoneno">Contact Number</label> <?php echo htmlspecialchars($user['Phone_no']); ?>
                                <input type="text" id="phoneno" name="phoneno" value="<?php echo htmlspecialchars($user['Phone_no']); ?>" >
                            </li>
                            <li>
                                <label for="dob">Date of Birth:</label>
                                <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($user['Dob']); ?>" >
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <label for="email">Email:</label>
                                 <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['Email']); ?>" required>
                            </li>
                        </ul>
                        <ul>
                            <li><label for="address">Address</label> 
                            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['Address']); ?>" >
                            </li>
                        </ul>

                        <!-- <label for="fname">First Name:</label>
                        <input type="text" id="fname" name="fname" value="<?php echo htmlspecialchars($user['First_name']); ?>" required>
            
                        <label for="lname">Last Name:</label>
                        <input type="text" id="lname" name="lname" value="<?php echo htmlspecialchars($user['Last_name']); ?>" required>
            
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['Email']); ?>" required> -->
            
                        <button type="submit" name="save">Save Changes</button>
                        <button type="button" onclick="cancelEdit()">Cancel</button>  <!-- Cancel button to switch back to view mode  -->
                    </form>
                </div>
            </div>
        </div>
    </main>
    
    
    <!-- Footer Section -->
    <footer>
        
        <div class="footer-links">
            <div class="social-media">
                <a href="Index.html"> <img src="./images/Versori.png" alt="logo" style="height: 90px; padding-left: 20px; "> </a>
                <ul style="list-style-type: none; display: flex; padding: 0; font-size: 30px;">
                    <li style="margin-left: 20px;"><a href="#" class="fa fa-facebook"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                    <li><a href="#" class="fa fa-instagram"></a></li>
                </ul>
            </div>
            <div class="footer-left">
                <ul>
                    <li style="font-weight: bolder; font-size: 1.5rem; letter-spacing: 0.04rem;">Versori</li>
                    <li><a href="policy.html">Privacy Policy</a></li>
                    <li><a href="terms.html">Terms and Conditions</a></li>
                </ul>
            </div>
            <div class="footer-middle">
                <ul>
                    <li style="font-weight: bolder; font-size: 1.2rem;">Our service</li>
                    <li><a href="manufacturing.html">Manufacturing</a></li>
                    <li><a href="consultancy.php">Consultancy</a></li>
                    <li><a href="sampling.html">Sampling</a></li>
                </ul>
            </div>
            <div class="footer-right">
                <ul>
                    <li style="font-weight: bolder; font-size: 1.2rem;">Useful Links</li>
                    <li><a href="about.html">About us</a></li>
                    <li><a href="contact.php">Contact us</a></li>
                    <li><a href="products.html">Products</a></li>
                    <li><a href="faq.html">FAQ</a></li>
                </ul>    
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; Versori 2024</p>
        </div>
    </footer>

    <script>
    // JavaScript to toggle between view and edit mode
    function showEditForm() {
        document.getElementById('viewMode').style.display = 'none';
        document.getElementById('editMode').style.display = 'block';
    }

    function cancelEdit() {
        document.getElementById('editMode').style.display = 'none';
        document.getElementById('viewMode').style.display = 'block';
    }
    </script>



    <script src="index.js"></script>
</body>
</html>