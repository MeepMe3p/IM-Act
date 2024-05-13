<html>
    <?php    
        include 'connect.php';    
    ?>
    <head>
		<title>FoodBear</title>
		<link rel="stylesheet" href="stylezz.css">

	</head>
	
	<body>
		<header>
			<!-- <div class="nav-bar"> -->
				<nav>
					<a href="index.html"><img src="foodbear.png" style="max-width: 100px;max-width: 10
					0px"></a>
					<a href="#">Register </a>
					<a href="login.php">Log In</a>
					<a href="Contact Us.html">Contact Us</a>
					<a href="#">About Us</a>
				</nav>
			<!-- </div> -->

		</header>

		<div class="login-container">
			<div class="form-box">
				<h1> Register </h1>
				<form method="POST" id = "login-form">
					<!-- <h2>Account</h2> -->
					<div class="input-group">
						<div class="input-field">
                       		<i class="fa-solid fa-lock"></i>
							<input type="text" id="email" name="email" placeholder = "Enter Email">
						</div>
						<div class="input-field">
                       		<i class="fa-solid fa-lock"></i>
							<input type="text" id="Username" name="Username" placeholder = "Enter Username"><br>
						</div>
						<div class="input-field">
                       		<i class="fa-solid fa-lock"></i>
							<input type="password" id="password" name="password" placeholder = "Enter Password"><br>
						</div>
						<div class="input-field">
							<p>Select User Type:</p>
							<input type="radio" name="UserType" value="customer" onclick="DisplayCustomerForm()">Customer</button>
							<input type="radio" name="UserType" value="restaurant" onclick="DisplayRestaurantForm()">Restaurant</button><br><br>
						</div>

						<div id="CustomerForm" style="display:none">
							<h2>Customer</h2>
							<div class="input-field">
								<i class="fa-solid fa-lock"></i>
								<input type="text" name='fname' placeholder="Enter first name"><br>
							</div>
							<div class="input-field">
								<i class="fa-solid fa-lock"></i>
								<input type="text" name='lname' placeholder="Enter last name"> <br>
							</div>
						</div>
						<div id="RestaurantForm" style="display:none">
							<h2>Restaurant</h2>
							<!-- <label>Restaurant Name</label> -->
							<div class="input-field">
								<i class="fa-solid fa-lock"></i>
								<input type="text" name='rname' placeholder="Enter Restaurant name"><br>
							</div>
						</div>
						<div class="input-field">
							<i class="fa-solid fa-lock"></i>
							<input type="text" name='address' placeholder="Enter Address"> <br>
						</div>
						<div class="input-field">
							<i class="fa-solid fa-lock"></i>
							<input type="text" name="ContactNum" placeholder="Enter Contact Number"><br>
						</div>
					</div>

					<div class="btn-field">
						<input type="submit" name="btnRegister" value="Register" class = "input">
					</div>
				</form>

			</div>
		</div>
		
	
		
		<footer style="margin-top: 10px">
			Kevin Josh Atay <br>
			Elijah Rei Sabay <br>
			BSCS - 2
		</footer>
	</body>
</html>

<script>
function DisplayCustomerForm() {
  var x = document.getElementById("CustomerForm");
  var y = document.getElementById("RestaurantForm");
  var formBox = document.querySelector('.form-box');

  if (x.style.display === "none") {
    x.style.display = "block";
	y.style.display = "none";
	formBox.style.height = "auto"; 
  } else {
    formBox.style.height = "calc(50% + 150px)"; // Adjust height when hiding customer form
  }
}

function DisplayRestaurantForm() {
	var x = document.getElementById("CustomerForm");
	var y = document.getElementById("RestaurantForm");
	var formBox = document.querySelector('.form-box');

	if (y.style.display === "none") {
		y.style.display = "block";
		x.style.display = "none";
		formBox.style.height = "auto"; // Reset height to auto when displaying restaurant form
  } else {
    formBox.style.height = "calc(50% + 150px)"; // Adjust height when hiding restaurant form
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