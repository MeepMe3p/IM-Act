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
			<a href="order.php">Order</a>
            <a href="AccountSettings.php">Account</a>
            <a href="CustomerCount.php">Customer Orders</a>
		</nav>
	</header>
		
    <?php
        $username = $_COOKIE['UserName'];
        echo "<h1> Welcome $username</h1>";

        $sql = "SELECT firstname, lastname, customer_address, customer_contact FROM tbluserprofile";

        $result = $connection->query($sql);

        echo "<table border='1'>";
        // Table header
        echo "<tr><th>First Name</th><th>Last Name</th><th>Address</th><th>contact</th></tr>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["firstname"]."</td><td>".$row["lastname"]."</td><td>".$row["customer_address"]."</td><td>".$row["customer_contact"]."</td>";
        }
        // End table HTML
        echo "</table> User type: ".$_COOKIE['UserType'];
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