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
			<a href="#">Order</a>
            <a href="AccountSettings.php">Account</a>
            <a href="CustomerCount.php">Customer Orders</a>
		</nav>
	</header>

    <form method = "POST">
        <?php echo("
            <label >Select A Promo</label><br>
            <input type='radio' name = 'Price'  value = '200'> <label>P 200 Mas Puti Ito</label><br>
            <input type='radio' name = 'Price' value = '500'> <label >P 300 Potato Chips</label><br>
            <input type='radio' name = 'Price' value = '700'> <label >P 700 Potato Caviar</label><br>
            ");
            $acctid = $_COOKIE['UserID'];

            $getID= "SELECT userid FROM tbluserprofile WHERE acctid = '$acctid'";
            $res = $connection->query($getID);
            $id = $res->fetch_assoc();
            $custid = $id["userid"]; 
            $sql = "SELECT * FROM tblorder WHERE customerid = '$custid' AND status = '1'";
            $result = $connection->query($sql);

            echo "<table border='1'>";
            echo "<tr><th>Order Id </th><th>Food Ordered</th><th>Status</th><th>Update</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row["orderid"] . "</td>
                    <td>" . $row["Food"] . "</td>
                    <td>" . $row["status"] . "</td>
                    <td><input type='radio' name='Selected' value='".$row["orderid"]."'> </td>
                </tr>";
            }
            echo("</table>");

        ?>
        <button type="submit" name="btnUpdateOrder" value="update" onclick="return confirm('Are you sure you want to update?');">Update</button>
        <button type="submit" name="btnDeleteOrder" value="delete" onclick="return confirm('Are you sure you want to delete?');">Delete Order</button>
    </form>

		
    <?php
        if(isset($_POST['btnUpdateOrder'])){
            $price = $_POST['Price'];
            $food = "test";
            $selected = $_POST['Selected'];

            switch($price){
                case "200":
                    $food = "Mas Puti Ito";
                    break;
                case "500":
                    $food = "Potato Chips";
                    break;
                case "700":
                    $food = "Potato Caviar";
                    break;
            }
            $updateOrder = "UPDATE tblorder SET Food = '$food', totalAmount = '$price' 
            WHERE orderid = '$selected'";
            mysqli_query($connection, $updateOrder);

        }
        if(isset($_POST['btnDeleteOrder'])){
            $selected = $_POST['Selected'];
            echo("$selected");
            $deleteOrder = "UPDATE tblorder SET status = '0' WHERE orderid = '$selected'";
            // $deleteOrder = "DELETE FROM tblorder WHERE orderid = '$selected'";
            mysqli_query($connection, $deleteOrder);
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