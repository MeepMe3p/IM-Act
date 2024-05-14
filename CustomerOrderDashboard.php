<?php
    include 'connect.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylez.css">
    <title>Renove Update Order</title>
</head>
<body>

    <?php
        $username = $_COOKIE['UserName'];
        $acctid = $_COOKIE['UserID'];
        echo "<h1> Welcome to your orders $username</h1>";

        $getCustomerID = "SELECT userid FROM tbluserprofile WHERE acctid = '".$acctid."'";
        $result = mysqli_query($connection,$getCustomerID);
        $row = mysqli_fetch_assoc($result);
        $customerid = $row["userid"];

        echo "<h1> Customer id: $customerid</h1>";

        echo "<table>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["product"] . "</td>";
                echo "<td>" . $row["quantity"] . "</td>";
                echo "<td><button onclick='confirmDelete(" . $row["id"] . ")'>Delete</button></td>";
                echo "</tr>";
            }
        echo "</table>";

    ?>
</body>
