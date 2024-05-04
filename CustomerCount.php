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
			<a href="#">About Us</a>
            <a href="AccountSettings.php">Account</a>
            <a href="#">Customer Orders</a>
		</nav>
	</header>
		
    <?php
        $username = $_COOKIE['UserName'];
        $acctid = $_COOKIE['UserID'];
        echo "<h1> Welcome $username</h1>";

        $getCustomerID = "SELECT userid FROM tbluserprofile WHERE acctid='".$acctid."'";
        $result = mysqli_query($connection, $getCustomerID);
        $row = mysqli_fetch_assoc($result);
        $customerid = $row['userid'];

        $sql = "SELECT COUNT(*) as Number_of_orders, customerid, tbluserprofile.firstname as fname, tbluserprofile.lastname as lname 
        FROM tblorder 
        INNER JOIN tbluserprofile ON tblorder.customerid = tbluserprofile.userid 
        GROUP BY customerid 
        HAVING Number_of_orders > 4";

        $result = $connection->query($sql);

        echo "<table border='1'>";
        // Table header
        echo "<tr><th>Number of orders</th><th>First Name</th><th>Last Name</th></tr>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["Number_of_orders"]."</td><td>".$row["fname"]."</td><td>".$row["lname"]."</td>";
        }
    ?>
    
    <footer>
        <p>Elijah Rei Sabay</p>
        <p>BSCS-2</p>
        <p>Kevin Josh Atay</p>
        <p>BSCS-2</p>
    </footer>
    
</body>
</html>