<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/home.css">
</head>
<body>
    <header>
        <!-- Side Navigation Menu -->
        <div id="mySidenav" class="sidenav">
            <!-- Close button -->
            <img onclick="closeNav()" src="images/close-google.svg" class="closebtn" style="width: 30px;">
            
            <!-- Navigation links -->
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>
            <a href="#">Terms of Services</a>
        </div>
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
                <p>Logo</p>
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


    <!-- REGISTRATION FORM -->
    <div class="container">
        <div class="form-box">

            <?php

            include("./php/config.php");
            if(isset($_POST['submit'])){
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                //verifying the unique email
                $verify_query = mysqli_query ($conn, "SELECT Email FROM users WHERE Email='$email'");
                
                if(mysqli_num_rows($verify_query) != 0){
                    // Email already exists, show error
                    echo "<div class= 'errormessage'>
                            <p>This email is already registered. Please use a different email.</p>
                        </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go back</button></a>";
                }
                else{

                    $insert_query = "INSERT INTO users (Firstname, Lastname, Email, Password) VALUES ('$fname', '$lname', '$email', '$password')";
                    $result = mysqli_query($conn, $insert_query);
                    

                    if($result){
                        echo "<div class= 'successmessage'>
                            <p>Registration Successfully!.</p>
                            </div> <br>";
                        echo "<a href='login.php'><button class='btn'>Login now</button></a>";
                    }else{
                        echo "<div class= 'errormessage'>
                            <p>This email is already registered. Please use a different email.</p>
                            </div> <br>";
                        echo "<a href='javascript:self.history.back()'><button class='btn'>Go back</button></a>";
                    }

                    
                }
            }else{

            

            ?>
            <h3>Create Account</h3>
            <form action="" method="post">
                <div class="field input">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" id="fname"  required>
                </div>

                <div class="field input">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" id="lname" required>
                </div>
                
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input class="btn" type="submit" name="submit" value="Create" required>
                </div>

                <div class="link">
                    <p>Already have an account? <a href="login.php"> Login</a></p>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>

    
    


    <script src="./script/home.js"></script>
</body>
</html>