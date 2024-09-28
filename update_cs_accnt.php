<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account</title>
</head>
<body>




    <main>

            <h2>Update Customer Account</h2>
            <form action="" method="post">
                <div class="field input">
                    <!-- <label for="fname">First Name</label> -->
                    <input type="text" name="fname" id="fname" placeholder="First Name" required>
                </div>

                <div class="field input">
                    <!-- <label for="lname">Last Name</label> -->
                    <input type="text" name="lname" id="lname" placeholder="Last Name" required>
                </div>
                
                <div class="field input">
                    <!-- <label for="email">Email</label> -->
                    <input type="email" name="email" id="email" placeholder="Email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <!-- <label for="password">Password</label> -->
                    <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" required>
                </div>

                <div class="field input">
                    <!-- <label for="password">Password</label> -->
                    <input type="text" name="address" id="address" placeholder="Address" autocomplete="off" required>
                </div>

                <div class="field input">
                    <!-- <label for="password">Password</label> -->
                    <input type="text" name="phone" id="phone" placeholder="Phone Number" autocomplete="off" required>
                </div>

                <div class="field input">
                    <!-- <label for="password">Password</label> -->
                    <input type="date" name="dob" id="dob" placeholder="Date of Birth" autocomplete="off" required>
                </div>

                <div class="field">
                    <input class="btn" type="submit" name="submit" value="Update" required>
                </div>

                <div class="link">
                    <p>Already have an account? <a href="login.php"> Login</a></p>
                </div>
            </form>
    </main>
    
</body>
</html>