<html>
    <?php
        include 'connect.php';
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylez.css">

    <title>Restaurant</title>
</head>
<body>
    <header>
		<nav>
			<a><img src="foodbear.png" style="max-width: 100px;max-width: 10
			0px"></a>
			<a href="register.php">Register </a>
			<a href="logout.php">Log Out</a>
			<a href="Contact Us.html">Contact Us</a>
			<a href="#">About Us</a>
            <a href="AccountSettings.php">Account</a>
            <a href="LocalRestaurants.php">Restaurants near you</a>
		</nav>
	</header>
		
    <?php
        $username = $_COOKIE['UserName'];
        echo "<h1> Welcome $username</h1>";

        $sql = "SELECT restaurant_name, restaurant_owner,restaurant_address, restaurant_contact FROM tblrestaurant";

        $result = $connection->query($sql);

        echo "<table border='1'>";
        // Table header
        echo "<tr><th>Restaurant Name</th><th>Restaurant Owner</th><th>Restaurant Address</th><th>Contact Number</th></tr>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $getowner = "SELECT username FROM tbluseraccount WHERE acctid = '" . $row["restaurant_owner"] . "'";
            $ownerquery = $connection->query($getowner);

            $account = $ownerquery->fetch_assoc();
            echo "<tr><td>".$row["restaurant_name"]."</td><td>".$account["username"]."</td><td>".$row["restaurant_address"]."</td><td>".$row["restaurant_contact"]."</td>";
        }
        // End table HTML
        echo "</table> User type: ".$_COOKIE['UserType'];

    ?>
    
    <footer>
        <p>Kevin Josh Atay</p>
        <p>BSCS-2</p>
    </footer>
    
</body>
</html>