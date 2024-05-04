<html>
    <?php
        include 'connect.php';
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylez.css">

    <title>Index</title>
</head>
<body>
    <header>
		<nav>
			<a><img src="foodbear.png" style="max-width: 100px;max-width: 10
			0px"></a>
			<a href="register.php">Register </a>
			<a href="login.php">Log In</a>
			<a href="Contact Us.html">Contact Us</a>
			<a href="#">About Us</a>
		</nav>
	</header>
		
    <h1>Login</h1>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit" name="btnLogin" value="Login">Login</button>
    </form>

    <footer>
        <p>Elijah Rei Sabay</p>
        <p>BSCS-2</p>
        <p>Kevin Josh Atay</p>
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
            echo "<script language='javascript'>
						alert('Log in successfully. welcome $username');
				  </script>";

            if($row['userType'] === "customer"){
                header("Location: UserDashboard.php");
            }else{
                header("Location: RestaurantDashboard.php");
            }
                
        } else {
            echo "<script language='javascript'>
						alert('Invalid credentials  .');
				  </script>";
        }

        
    
        // Close the database connection
        mysqli_close($connection);
    }
?>