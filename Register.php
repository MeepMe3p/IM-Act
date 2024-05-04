<html>
    <?php    
        include 'connect.php';    
    ?>
    <head>
		<title>FoodBear</title>
	</head>
	
	<body>
		<header>
			<nav>
				<a href="index.html"><img src="foodbear.png" style="max-width: 100px;max-width: 10
				0px"></a>
				<a href="#">Register </a>
				<a href="login.php">Log In</a>
				<a href="Contact Us.html">Contact Us</a>
				<a href="#">About Us</a>
			</nav>
		</header>
		
		<h1> Register </h1>
		<div id="Content" style="border: 2px solid black; padding: 25px">
			<form method="POST">
				<h2>Account</h2>
				<label for="email">Email:</label><br>
				<input type="text" id="email" name="email"><br>
				<label for="Username">Username:</label><br>
				<input type="text" id="Username" name="Username"><br>
				<label for="password">Password:</label><br>
				<input type="text" id="password" name="password"><br>
                <p>Select User Type:</p>
				<input type="radio" name="UserType" value="customer" onclick="DisplayCustomerForm()">Customer</button>
				<input type="radio" name="UserType" value="restaurant" onclick="DisplayRestaurantForm()">Restaurant</button><br><br>

				<div id="CustomerForm" style="display:none">
					<h2>Customer</h2>
					<label>First Name</label>
					<input type="text" name='fname' placeholder="Enter first name"><br>
					<label>Last Name</label>
					<input type="text" name='lname' placeholder="Enter last name"> <br>
				</div>

				<div id="RestaurantForm" style="display:none">
					<h2>Restaurant</h2>
					<label>Restaurant Name</label>
					<input type="text" name='rname' placeholder="Enter Restaurant name"><br>
					
				</div>

				<label>Address</label>
				<input type="text" name='address' placeholder="Enter Address"> <br>
				<label>Contact Number</label>
				<input type="text" name="ContactNum" placeholder="Enter Contact Number"><br>

				<input type="submit" name="btnRegister" value="Register">
			</form>
		</div>
		
		<footer style="margin-top: 10px">
			Kevin Josh Atay <br>
			BSCS - 2
		</footer>
	</body>
</html>

<script>
function DisplayCustomerForm() {
  var x = document.getElementById("CustomerForm");
  var y = document.getElementById("RestaurantForm");
  if (x.style.display === "none") {
    x.style.display = "block";
	y.style.display = "none";
  }
}

function DisplayRestaurantForm() {
	var x = document.getElementById("CustomerForm");
	var y = document.getElementById("RestaurantForm");
	if (y.style.display === "none") {
		y.style.display = "block";
		x.style.display = "none";
	}
}
</script>

<?php	 
	if(isset($_POST['btnRegister'])){		
		//retrieve data from form and save the value to a variable
		
		//for tbluseraccount
		$email=$_POST['email'];		
		$uname=$_POST['Username'];
		$pword=$_POST['password'];
        $type=$_POST['UserType'];
		$acctid = null;

		//Check tbluseraccount if username is already existing. Save info if false. Prompt msg if true.
		$sql2 ="Select * from tbluseraccount where username='".$uname."'";
		$result = mysqli_query($connection,$sql2);
		$row = mysqli_num_rows($result);
		if($row == 0){
			$accountsql ="Insert into tbluseraccount(emailadd, username, upassword, userType) values('".$email."','".$uname."','".$pword."','".$type."')";
            mysqli_query($connection,$accountsql);
			echo "<script language='javascript'>
						alert('New record saved.');
				  </script>";
			//header("location: index.php");

			$result = mysqli_query($connection,$sql2);
			$row = mysqli_fetch_assoc($result);

			$acctid = $row['acctid'];
        	// Now you have the acctid, you can use it as needed
        	echo "Account ID: " . $acctid;

		}else{
			echo "<script language='javascript'>
						alert('Username already existing');
				  </script>";
		}

		

		if(isset($acctid)){
			$address=$_POST['address'];		
			$contact=$_POST['ContactNum'];
			if($type == "restaurant"){	
				$rname=$_POST['rname'];		

				$ChildAccountSQL = "INSERT INTO tblrestaurant (restaurant_name, restaurant_owner, restaurant_address, restaurant_contact, restaurant_rating)
                    VALUES ('$rname', '$acctid', '$address', '$contact', 0)";
					mysqli_query($connection,$ChildAccountSQL);
			}else{
				$fname=$_POST['fname'];		
				$lname=$_POST['lname'];

				$ChildAccountSQL = "INSERT INTO tbluserprofile (firstname, lastname, customer_address, customer_contact, acctid) VALUES ('$fname', '$lname', '$address', '$contact', '$acctid')";
				mysqli_query($connection,$ChildAccountSQL);
			}
		}
		
		
			
	}
		

?>