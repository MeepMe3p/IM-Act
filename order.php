<html>
    <?php
        include 'connect.php';
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylez.css">

    <title>User</title>
</head>
<body>
    <header>
		<nav>
			<a><img src="foodbear.png" style="max-width: 100px;max-width: 10
			0px"></a>
			<a href="register.php">Register </a>
			<a href="logout.php">Log Out</a>
			<a href="Contact Us.html">Contact Us</a>
			<a href="updateDeleteOrder.php">Change Order</a>
            <a href="AccountSettings.php">Account</a>
            <a href="CustomerCount.php">Customer Orders</a>
		</nav>
	</header>

    <form method = "POST">
        <label for="">Select A Promo</label><br>
        <input type="radio" name = "Price"  value = "100"> <label for="">P 100 Potato Salad</label><br>
        <input type="radio" name = "Price" value = "200"> <label for="">P 200 HashBrown</label><br>
        <input type="radio" name = "Price" value = "300"> <label for="">P 300 French Fries</label><br>
        <input type="submit" name = "btnOrder" value="Order">
    </form>
		
    <?php
        if(isset($_POST['btnOrder'])){
            $price = $_POST['Price'];
            $username = $_COOKIE['UserID'];
            $food = "test";

            switch($price){
                case "100":
                    $food = "Potato Salad";
                    break;
                case "200":
                    $food = "HashBrown";
                    break;
                case "300":
                    $food = "French Fries";
                    break;
            }

            $getCustomerID = "SELECT userid FROM tbluserprofile WHERE acctid='".$username."'";
            $result = mysqli_query($connection, $getCustomerID);
            $row = mysqli_fetch_assoc($result);
            $customerid = $row['userid'];
            
            if($customerid){
                echo "<script language='javascript'>
						alert('New record saved.');
				  </script>";
                
                $OrderQuery = "INSERT INTO tblorder (totalAmount, customerid, Food,status) VALUES ('$price','$customerid', '$food','1')";
                $connection->query($OrderQuery);
            }
        }

    ?>
    
    <?php?>
    
    <footer>
        <p>Elijah Rei Sabay</p>
        <p>BSCS-2</p>
        <p>Kevin Josh Atay</p>
        <p>BSCS-2</p>
    </footer>
    
</body>
</html>