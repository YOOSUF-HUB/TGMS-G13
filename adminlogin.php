<?php

session_start();
include("./php/config.php");

if (isset($_POST['login'])) {
    // Fetch form data
    $input_username = mysqli_real_escape_string($conn, $_POST['username']);
    $input_password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Query to check the email and password
    $login_query = "SELECT * FROM users WHERE username='$input_username' AND password='$input_password'";
    $result = mysqli_query($conn, $login_query); //excute query
    $row = mysqli_fetch_assoc($result);

    

    

    // Check if user exists and verify password
    if (is_array($row) && !empty($row)) {
        $_SESSION['valid'] = $row['username'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role']; 


    } else {
        // If login fails, display error message
        echo "<div class='errormessage'>
                <p> Wrong Username or Password</p>
            </div> <br>";
        echo "<a href='login.html'><button class='btn'>Go back</button></a>";
    }

    if(isset($_SESSION['valid'])){
        // Redirect based on role
        switch ($row['role']) {
            case 'admin':
                header("Location: admindashboard.php");
                break;
            case 'inventory':
                header("Location: inventorydashboard.php");
                break;
            case 'support':
                header("Location: customerdashboard.php");
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
    <title>Inventory Login</title>
    <link rel="stylesheet" href="styles.css">
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
        padding: 20px;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 100px;
    }

    button{
        font-family: questrial, sans-serif;
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
    }
    .profile-container i{
        font-size:36px;
        padding-bottom: 10px;
    }
    .profile-container p{
        margin-top: 0px; color: #ECDFCC;
    }








    /* END OF HEADER */
    /* END OF HEADER */

    /* FOOTER */
    /* FOOTER */

    /* Footer Section */
    footer {
        background-color: #697565;
        color: white;
        padding: 40px 20px;
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
            
                <div class="notification">
                    <i class="fa fa-bell" style="font-size:30px"></i>
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
                    <!-- <button type="submit" name="login">Login</button> -->
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
