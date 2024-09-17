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



    <div class="container">
        <div class="form-box">

        <?php

        include("./php/config.php");
        if(isset($_POST['submit'])){
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            // Query to check the email and password
            $login_query = "SELECT * FROM users WHERE Email='$email' AND Password='$password'";
            $result = mysqli_query($conn, $login_query);
            $row = mysqli_fetch_assoc($result);

            if(is_array($row) && !empty($row)){
                $_SESSION['valid'] = $row['Email'];
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['firstname'] = $row['Firstname'];

                
                
            }else{
                // user details doesn't exists, show error
                echo "<div class= 'errormessage'>
                        <p> Wrong Username or Password</p>
                    </div> <br>";
                echo "<a href='login.php'><button class='btn'>Go back</button></a>";
                
            }

            if(isset($_SESSION['valid'])){
                header("Location: home.php");
            }

            


        }else{
        
        
        ?>
            <h3>Login</h3>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input class="btn" type="submit" name="submit" value="Login" required>
                </div>

                <div class="link">
                    <p> <a href="register.php">Create new account</a></p>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>

    
    


    <script src="./script/home.js"></script>
</body>
</html>