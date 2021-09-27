<!doctype html>
<html>
    <head>
        <title>Sales Report</title>
        <meta name="description" content="SalesReport">
        <meta name="keywords" content="SalesReport">
        <link rel="stylesheet" href="Style/style.css">
        <link rel="script" href="Scripts/UpdateStock.php">
    </head>
    <body>
    <ul class="topnav">
        <li><a href="index.php">Home</a></li>
        <li><a href="AddSales.html">Add Sales</a></li>
        <li><a href="UpdateStock.html">Update Stock</a></li>
        <li><a class="active" href="SalesReport.php">Sales Report</a></li>
        <li class="right" ><a href="About.html">About</a></li>
    </ul>

    <div><h1>Sales Report</h1></div>
    <form method="post">
        <input name="test" type="submit" value="test" /> 
    </form>

    <?php

	$query = "";
	require_once "settings.php";	// Load MySQL log in credentials
	$conn = mysqli_connect($host, $user, $pwd, $sql_db);	// Log in and use database

	if ($conn) { // connected

		echo "database connected!<br>";

		$query = "SELECT * FROM Warehouse;";

		$result = mysqli_query($conn, $query);
		if ($result) {	//   query was successfully executed

			$record = mysqli_fetch_assoc($result);
			if ($record) {		//   record exist
				echo "<table class='salesReportTable'>";
	?>
				<tr>
					<th><a class="colum_sort" id="id" data-order="'.$order.'" href="#">Item_ID</a></th>
					<th><a class="colum_sort" id="name" data-order="'.$order.'" href="#">Item_Name</a></th>
					<th><a class="colum_sort" id="quantity" data-order="'.$order.'" href="#">Quantity</a></th>
					<th><a class="colum_sort" id="description" data-order="'.$order.'" href="#">Item_Description</a></th>
					<th><a class="colum_sort" id="price" data-order="'.$order.'" href="#">Price</a></th>
					<th>Action</th>
				</tr>
	<?php
				while ($record) {
					echo "<tr><td>{$record['Item_ID']}</td>";
					echo "<td>{$record['Item_Name']}</td>";
					echo "<td>{$record['Quantity']}</td>";
					echo "<td>{$record['Item_Description']}</td>";
					echo "<td>{$record['Price']}</td>";
					echo "<td><a href='delete.php?id=" . $record['Item_ID'] . "'>Delete</a></td>				
					</tr>";

					$record = mysqli_fetch_assoc($result);
				}
				echo "</table>";
				mysqli_free_result($result);	// Free resources
			} else {
				echo "<p>No record retrieved.</p>";
			}
		} else {
			echo "<p>Orders table doesn't exist or select operation unsuccessful.</p>";
		}
		mysqli_close($conn);	// Close the database connection
	} else {
		echo "<p>Unable to connect to the database.</p>";
	}

	?>

    </body>
</html>