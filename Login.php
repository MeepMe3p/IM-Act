<html>
    <?php
        include 'connect.php';

        session_start();
        $message = '';
        if(isset($_SESSION['incorrect'])){
            $message = "Incorrect username or password";
        }
    

    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylezz.css">

    <title>Index</title>
</head>
<body>
    <header>
        <div class="nav-bar">
            <nav>
                <a><img src="foodbear.png" style="max-width: 100px;max-width: 10
                0px"></a>
                <a href="register.php">Register </a>
                <a href="login.php">Log In</a>
                <a href="Contact Us.html">Contact Us</a>
                <a href="#">About Us</a>
            </nav>
        </div>
	</header>
	<div class="login-container">
        <div class="form-box">
            <h1>Login</h1>
	    	<h4 style = "color: red"><?php echo $message ?> </h4>

            <form method="POST" id = "login-form">
                <div class = "input-group">
                    <div class="input-field" id = "emailField">
                        <i class="fa-solid fa-lock"></i>
                        <input type="text" id="username" name="username" required placeholder = "Enter Username" id = "user" >
                    </div>
                    <div class = "input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password" name="password" required placeholder = "Enter Password">
                    </div>
                </div>
                <div class="btn-field">
                    
                    <button type="submit" name="btnLogin" value="Login" class = "input">Login</button>

                </div>
            </form>

        </div>
    </div>


    <footer>
        <p>Kevin Josh Atay</p>
        <p>Elijah Rei Sabay</p>
        <p>BSCS-2</p>
    </footer>
</body>
</html>

<?php
    if(isset($_POST['btnLogin'])){
        $username=$_POST['username'];
        $password=$_POST['password'];

        $accountsql = "SELECT * FROM tbluseraccount WHERE username = '$username' and upassword = '$password'";

        $result = mysqli_query($connection, $accountsql);
    
        if(mysqli_num_rows($result) == 1) {
            $getinfo = "select acctid, userType from tbluseraccount where username = '$username' and upassword = '$password'";
            $query = $connection->query($getinfo);

            $row = $query->fetch_assoc();
            setcookie('UserID', $row['acctid'], time() + (86400 * 30), "/");
            setcookie('UserName', $username, time() + (86400 * 30), "/");
            setcookie('UserType', $row['userType'], time() + (86400 * 30), "/");    
            echo "<script language='javascript'>
						alert('Log in successfully. welcome $username');
				  </script>";

            if($row['userType'] === "customer"){
                header("Location: UserDashboard.php");
            }else{
                header("Location: RestaurantDashboard.php");
            }
                
        } else {
            $_SESSION ['incorrect'] = '1';

            // echo "<script language='javascript'>
			// 			alert('Invalid credentials  .');
			// 	  </script>";
        }


        
    
        // Close the database connection
        mysqli_close($connection);
    }
?>