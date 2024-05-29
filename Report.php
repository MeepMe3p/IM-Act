<?php
    include 'connect.php';
?>

<head>
    <meta charset="UTF-8">
    <title>Customers who ordered French Fries</title>
</head>
<body>
    
    <form method="POST" action="">
        <label for="username">Enter Username:</label>
        <input type="text" id="username" name="username" required>
        <input type="submit" value="Submit">
    </form>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the submitted username from the form
        $username = $_POST['username'];




        //====== THIS PART IS WHERE SECOND TABLE IS WHICH DISPLAYS THE AVERAGE AMOUNT PURCHASED BY CUSTOMER ==========

        $getID= "SELECT acctid FROM tbluseraccount WHERE username = '$username'";
        $res = $connection->query($getID);
        $id = $res->fetch_assoc();
        $acctid = $id["acctid"]; 
        $sql = "SELECT tbluserprofile.firstname, tbluserprofile.lastname, AVG(tblorder.totalAmount) AS avg_amount, COUNT(*) AS num_of_orders
        FROM tbluserprofile
        INNER JOIN tblorder  ON tbluserprofile.userid = tblorder.customerid
        WHERE tbluserprofile.acctid = $acctid
        GROUP BY tbluserprofile.userid";
        $result = $connection->query($sql);
        
        echo "<table border='1'>";
        echo("<h2>Total Average of Amount purchased by $username</h2>");

        echo "<table border='1'>";
        echo "<tr><th>Average Amount</th><th>Customer First Name</th><th>Customer Last Name</th><th>Number of Orders</th></tr>";
        while($res = $result->fetch_assoc()) {
            echo "<tr><td>".$res["avg_amount"]."</td><td>".$res["firstname"]."</td><td>".$res["lastname"]."</td><td>".$res["num_of_orders"]."</td></tr>";
        }
        echo("</table>");
        //====== THIS PART IS WHERE THIRD TABLE IS WHICH DISPLAYS THE TOTAL AMOUNT PURCHASED BY CUSTOMER ==========

        $sql = "SELECT tbluserprofile.firstname, tbluserprofile.lastname, SUM(o.totalAmount) AS total_amount,  COUNT(*) AS num_of_orders
        FROM tbluserprofile
        INNER JOIN tblorder o ON tbluserprofile.userid = o.customerid
        WHERE tbluserprofile.acctid = $acctid
        GROUP BY tbluserprofile.acctid";
        $result = $connection->query($sql);

        echo "<table border='1'>";
        echo("<h2>Total Amount purchased by $username</h2>");

        echo "<table border='1'>";
        echo "<tr><th>Average Amount</th><th>Customer First Name</th><th>Customer Last Name</th><th>Number of Orders</th></tr>";
        while($res = $result->fetch_assoc()) {
            echo "<tr><td>".$res["total_amount"]."</td><td>".$res["firstname"]."</td><td>".$res["lastname"]."</td><td>".$res["num_of_orders"]."</td></tr>";
        }
        echo("</table>");

        //====== THIS PART IS WHERE FIRST TABLE IS WHICH DISPLAYS THE AMOUNT OF FOOD PURCHASED BY CUSTOMER ==========
        echo("<h2>Total number of French Fries Ordered by $username</h2>");
        $sql = "SELECT COUNT(*) as number_of_orders, customerid,
        tbluserprofile.firstname as fname, tbluserprofile.lastname as lname,tblorder.Food as food
        FROM tblorder JOIN tbluserprofile ON tblorder.customerid = tbluserprofile.userid WHERE tblorder.Food = 'French Fries' AND
        tbluserprofile.acctid = '$acctid'
        GROUP BY customerid";

        // Prepare and bind
        $result = $connection->query($sql);

        echo "<table border='1'>";
        echo "<tr><th>Number of Orders</th><th>Customer First Name</th><th>Customer Last Name</th><th>Food Ordered</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["number_of_orders"]."</td><td>".$row["fname"]."</td><td>".$row["lname"]."</td><td>".$row["food"]."</td>";
        }
        echo "</table>";
        //====== THIS PART IS WHERE FIFTH TABLE IS WHICH DISPLAYS THE PLACES IN CEBU==========


        echo "<h2> Orders of French Fries</h2>";

        $sql = "SELECT tbluserprofile.firstname as name, tbluserprofile.lastname as lname, tblorder.Food as ordered FROM tbluserprofile INNER JOIN tblorder 
        ON tblorder.customerid = tbluserprofile.userid 
        WHERE tblorder.Food ='French Fries'";

        $result = $connection->query($sql);

        echo "<table border='1'>";
        // Table header
        echo "<tr><th>First Name</th><th>Last Name</th><th>Food Ordered</th></tr>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["name"]."</td><td>".$row["lname"]."</td><td>".$row["ordered"]."</td>";
        }
        echo "</table>";

        //====== THIS PART IS WHERE FOURTH TABLE IS WHICH DISPLAYS THE ORDERS PER CUSTOMERS ==========

        echo "<h2> Total Number of Orders per Customer</h2>";

        $getCustomerID = "SELECT userid FROM tbluserprofile WHERE acctid='".$acctid."'";
        $result = mysqli_query($connection, $getCustomerID);
        $row = mysqli_fetch_assoc($result);
        // $customerid = $row['userid'];

        $sql = "SELECT COUNT(*) as Number_of_orders, customerid, tbluserprofile.firstname as fname, tbluserprofile.lastname as lname 
        FROM tblorder 
        INNER JOIN tbluserprofile ON tblorder.customerid = tbluserprofile.userid 
        GROUP BY customerid";

        $result = $connection->query($sql);

        echo "<table border='1'>";
        // Table header
        echo "<tr><th>Number of orders</th><th>First Name</th><th>Last Name</th></tr>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["Number_of_orders"]."</td><td>".$row["fname"]."</td><td>".$row["lname"]."</td>";
        }
        echo("</table>");


        //====== THIS PART IS WHERE FIFTH TABLE IS WHICH DISPLAYS THE PLACES IN CEBU==========


        echo "<h2> Restaurants in Cebu</h2>";

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
        echo "</table>";

        //
        echo "<h2>Total number users grouped by user type</h2>
        <img src='Images/pie1.PNG'>";
        

        $sql = "SELECT userType, COUNT(userType) as UTcount
        FROM tbluseraccount
        GROUP BY userType";

        $result = $connection->query($sql);
        echo "<table border='1'>";
        // Table header
        echo "<tr><th>userType</th><th>Count</th></tr>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["userType"]."</td><td>".$row["UTcount"]."</td>";
        }
        echo "</table>";

        echo "<h2>Most Ordered Food Overall</h2>
        <img src='Images/pie3.PNG'>";

        $sql = "SELECT Food, COUNT(Food) as Fcount
        FROM tblorder
        GROUP BY Food";

        $result = $connection->query($sql);
        echo "<table border='1'>";
        // Table header
        echo "<tr><th>Food</th><th>Count</th></tr>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["Food"]."</td><td>".$row["Fcount"]."</td>";
        }
        echo "</table>";
        $connection->close();
    }
    ?>

</body>