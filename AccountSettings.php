<html>
    <?php
        include 'connect.php';
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylez.css">

    <title>Account Settings</title>
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
            <a href="#">Account</a>
		</nav>
	</header>
		
    <form method="POST">
        <label>Username: </label><br>
		<input type="text" name="username"><br>

        <?php
            if($_COOKIE['UserType'] === "restaurant"){
                echo('<label>Restaurant Name: </label><br>
                <input type="text" id="email" name="email"><br>');
            }
        ?>

        <label>Password: </label><br>
		<input type="text" name="password"><br>
        <button type="submit" name="btnUpdateUser" value="update">Save Changes</button>
        <button type="submit" name="btnDeleteUser" value="delete">Delete Account</button>
    </form>

    <!-- <form method="POST">
        
    </form> -->
    
    <footer>
        <p>Elijah Rei Sabay</p>
        <p>BSCS-2</p>
        <p>Kevin Josh Atay</p>
        <p>BSCS-2</p>
    </footer>
    
</body>
</html>

<?php
    $cookieID = $_COOKIE['UserID'];
    if(isset($_POST['btnUpdateUser'])){
        if(isset($_POST['username'])){
            $Updateusername = $_POST['username'];
            

            $UpdateSQLusername = "UPDATE tbluseraccount SET username = '$Updateusername' WHERE acctid = '$cookieID'";
            $result = mysqli_query($connection, $UpdateSQLusername);
            echo "<script language='javascript'>
						alert('Updating...');
				  </script>";
        }

        header("Location: AccountSettings.php");
        mysqli_close($connection);
    }

    if(isset($_POST['btnDeleteUser'])){
        echo "<script language='javascript'>
						alert('Deleting...');
				  </script>";
        if($_COOKIE['UserType'] === "customer"){
            $deleteCustomer = "DELETE FROM tbluserprofile WHERE acctid = '$cookieID'";
            mysqli_query($connection, $deleteCustomer);
        }else{
            $deleteRestaurant = "DELETE FROM tblrestaurant WHERE restaurant_owner = '$cookieID'";
            mysqli_query($connection, $deleteRestaurant);
        }

        $deleteUser = "DELETE FROM tbluseraccount WHERE acctid = '$cookieID'";
        mysqli_query($connection, $deleteUser);

        header("Location: AccountSettings.php");
        mysqli_close($connection);
    }

    
?>