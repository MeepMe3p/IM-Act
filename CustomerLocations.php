<html>
    <?php
        include 'connect.php';
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tables.css">

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
        echo "<h1> Customers who ordered French Fries</h1>";

        $sql = "SELECT COUNT(*) as number_of_orders, customerid,
        tbluserprofile.firstname as fname, tbluserprofile.lastname as lname,tblorder.Food as food
        FROM tblorder JOIN tbluserprofile ON tblorder.customerid = tbluserprofile.userid WHERE tblorder.Food = 'French Fries'
        GROUP BY customerid";
        $result = $connection->query($sql);

        echo "<table border='1'>";
        echo "<tr><th>Number of Orders</th><th>Customer First Name</th><th>Customer Last Name</th>><th>Food Ordered</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["number_of_orders"]."</td><td>".$row["fname"]."</td><td>".$row["lname"]."</td><td>".$row["food"]."</td>";
        }
        echo "</table> User type: ".$_COOKIE['UserType'];
    ?>
    
    <footer>
        <p>Elijah Rei Sabay</p>
        <p>Kevin Josh Atay</p>
        <p>BSCS-2</p>
    </footer>
    
</body>
</html>