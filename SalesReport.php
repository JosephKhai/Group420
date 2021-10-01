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
		<li><a href="homepage.php">Home</a></li>
		<li><a href="AddSales.php">Add Sales</a></li>
		<li><a href="SalesReport.php">Sales Report</a></li>
		<li class="right"><a href="About.php">About</a></li>
	</ul>

	<div class="stockReport">

		<!--for Stock report-->
		<h3>Stock Report</h3>

		<?php

		require_once "settings.php";	// Load MySQL log in credentials
		$conn = mysqli_connect($host, $user, $pwd, $sql_db);	// Log in and use database

		if ($conn) { // connected

			//echo "database connected!<br>";

			$query = "SELECT * FROM PHPWarehouse;";

			$result = mysqli_query($conn, $query);
			if ($result) {	//   query was successfully executed

				$record = mysqli_fetch_assoc($result);
				if ($record) {		//   record exist
					echo "<table class='salesReportTable'>";
		?>
					<tr>
						<th><a class="colum_sort" id="id" data-order="'.$order.'">Item_ID</a></th>
						<th><a class="colum_sort" id="name" data-order="'.$order.'">Item_Name</a></th>
						<th><a class="colum_sort" id="quantity" data-order="'.$order.'">Quantity</a></th>
						<th><a class="colum_sort" id="description" data-order="'.$order.'">Item_Description</a></th>
						<th><a class="colum_sort" id="description" data-order="'.$order.'">Ordertime</a></th>
						<th><a class="colum_sort" id="description" data-order="'.$order.'">ItemStatus</a></th>
						<th><a class="colum_sort" id="price" data-order="'.$order.'">Price</a></th>
						<th>Action</th>
					</tr>
		<?php
					while ($record) {
						echo "<tr><td>{$record['Item_ID']}</td>";
						echo "<td>{$record['Item_Name']}</td>";
						echo "<td>{$record['Quantity']}</td>";
						echo "<td>{$record['Item_Description']}</td>";
						echo "<td>{$record['Ordertime']}</td>";
						echo "<td>{$record['ItemStatus']}</td>";
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

		<input type="button" name="generateStockCSV" value="Generate CSV" />

	</div>


	<div class="saleReport">

		<!--for Stock report-->
		<h3>Sales Report</h3>

		<?php

		require_once "settings.php";	// Load MySQL log in credentials
		$conn = mysqli_connect($host, $user, $pwd, $sql_db);	// Log in and use database

		if ($conn) { // connected

			//echo "database connected!<br>";

			$query = "SELECT * FROM PHPWarehouse;";

			$result = mysqli_query($conn, $query);
			if ($result) {	//   query was successfully executed

				$record = mysqli_fetch_assoc($result);
				if ($record) {		//   record exist
					echo "<table class='salesReportTable'>";
		?>
					<tr>
						<th><a class="colum_sort" id="id" data-order="'.$order.'">Item_ID</a></th>
						<th><a class="colum_sort" id="name" data-order="'.$order.'">Item_Name</a></th>
						<th><a class="colum_sort" id="quantity" data-order="'.$order.'">Quantity</a></th>
						<th><a class="colum_sort" id="description" data-order="'.$order.'">Item_Description</a></th>
						<th><a class="colum_sort" id="description" data-order="'.$order.'">Ordertime</a></th>
						<th><a class="colum_sort" id="description" data-order="'.$order.'">ItemStatus</a></th>
						<th><a class="colum_sort" id="price" data-order="'.$order.'">Price</a></th>
						<th>Action</th>
					</tr>
		<?php
					while ($record) {
						echo "<tr><td>{$record['Item_ID']}</td>";
						echo "<td>{$record['Item_Name']}</td>";
						echo "<td>{$record['Quantity']}</td>";
						echo "<td>{$record['Item_Description']}</td>";
						echo "<td>{$record['Ordertime']}</td>";
						echo "<td>{$record['ItemStatus']}</td>";
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

		<input type="button" name="generateSalesCSV" value="Generate CSV" />

	</div>








</body>

</html>