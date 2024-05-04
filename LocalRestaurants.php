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
			<a href="#">Contact Us</a>
			<a href="#">About Us</a>
            <a href="AccountSettings.php">Account</a>
            <a href="LocalRestaurants.php">Restaurants near you</a>
		</nav>
	</header>
		
    <?php
        $username = $_COOKIE['UserName'];
        echo "<h1> Restaurants in Cebu</h1>";

        $sql = "SELECT tblrestaurant.restaurant_name as name, tbluseraccount.username as owner, tblrestaurant.restaurant_address as location FROM tblrestaurant INNER JOIN tbluseraccount 
        WHERE tblrestaurant.restaurant_address='Cebu' AND tbluseraccount.acctid=tblrestaurant.restaurant_owner";

        $result = $connection->query($sql);

        echo "<table border='1'>";
        // Table header
        echo "<tr><th>Restaurant Name</th><th>Restaurant Owner</th><th>Restaurant Address</th></tr>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["name"]."</td><td>".$row["owner"]."</td><td>".$row["location"]."</td>";
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