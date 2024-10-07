<?php

session_start();
include("./php/config.php");

if (isset($_POST['login'])) {
    // Fetch form data
    $input_username = mysqli_real_escape_string($conn, $_POST['username']);
    $input_password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Query to check the email and password
    $login_query = "SELECT * FROM Staff_account WHERE username='$input_username' AND Password='$input_password'";
    $result = mysqli_query($conn, $login_query); //excute query
    $row = mysqli_fetch_assoc($result);

    

    

    // Check if user exists and verify password
    if (is_array($row) && !empty($row)) {

        $_SESSION['valid'] = $row['username'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['staff_role'] = $row['staff_role']; 
        $_SESSION['name'] = $row['Full_name'];


    } else {
        // If login fails, display error message
        $error_message = "Wrong Username or Password";
    }

    if(isset($_SESSION['valid'])){
        // Redirect based on role
        switch ($_SESSION['staff_role']) {
            case 'Admin':
                header("Location: AdminDashboard.php");
                break;
            case 'Inventory':
                header("Location: inventory-Dashboard.php");
                break;
            case 'Support':
                header("Location: CustomerSupportDashboard.php");
                break;
            
        }
    }

    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Login</title>
    <link rel="stylesheet" href="styles/inventory.css">

    <style>
        /* ADMIN LOGIN PAGE CSS */

        .container {
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 90vh;

        }
        .form-box {
            background-color: #ECDFCC;
            display: flex;
            flex-direction: column;
            padding: 30px 50px;
            border-radius: 10px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.3);
            width: 350px;
        }    
        .form-box h3{
            font-size: 2rem; 
            margin-top: 0;

        }    
        .form-box .field {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }

        .form-box .input input{
            height: 2rem;
            width: 100%;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none ;
        }

        .btn {
            height: 2.3rem;
            width: 100%;
            font-size: 1rem;
            color: #f1f1f1;
            background-color: #697565;
            border-radius: 5px;
            border: 0;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .form-box .link a{
            color: #000000;
        }
    </style>
    
</head>
<body>
    <header>
        <div class="top-container">
            <div class="logo-notification" >
                <div class="logo-content">
                    <a href="Index.html"> <img src="./images/versori 2.png" alt="logo" > </a>
                </div>
            </div>

            <div class="title">
                <h1>Admin</h1>
            </div>

            <div class="profile-container" >
                
            </div>

            


            
        </div>
    </header>

    <div class="container">
        <div class="form-box">

            <?php if (isset($error_message)): ?>
                <div class="errormessage">
                    <p><?php echo $error_message; ?></p>
                </div>
            <?php endif; ?>


            <h3>Admin Login</h3>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="field input">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="field">
                    <input class="btn" type="submit" name="login" value="Login" required>
                </div>

                
            </form>
        </div>
        
    </div>




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
</body>
</html>
