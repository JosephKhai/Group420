<!doctype html>
<html>

<head>
	<title>Sales Report</title>
	<meta name="description" content="SalesReport">
	<meta name="keywords" content="SalesReport">
	<link rel="stylesheet" href="Style/style.css">
	<link rel="script" href="Scripts/UpdateStock.php">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>

	<div id="page-container">
		<div id="content-wrap">

			<ul class="topnav">
				<li><a href="homepage.php">Home</a></li>
				<li><a href="addItems.php">Add Item</a></li>
				<li><a href="warehouse.php">Warehouse Report</a></li>
				<li><a href="AddSales.php">Add Sales</a></li>
				<li><a href="SalesReport.php">Sales Report</a></li>
				<li><a href="admin.php">Manage</a></li>
			</ul>

			<div>
				<h1>Sales Report</h1>
			</div>
			<div class="col-md-12 head">

				<div class="exportData">
					<!--
					<label for="fromdate">From</label>
					<input type="date" name="fromdate" id="fromdate">
					<label for="fromdate">To</label>
					<input type="date" name="todate" id="todate">
-->
					<a href="exportSalesReport.php">Download CSV File <i class='fas fa-cloud-download-alt'></i></a>
				</div>

			</div>
			<?php

			$query = "";
			require_once "settings.php";	// Load MySQL log in credentials
			$conn = mysqli_connect($host, $user, $pwd, $sql_db);	// Log in and use database

			if ($conn) { // connected

				$query = "SELECT Item_name, SUM(Quantity) as Quantity, Price FROM CustomerOrder  GROUP BY Item_name;";

				$result = mysqli_query($conn, $query);
				if ($result) {	//   query was successfully executed

					$record = mysqli_fetch_assoc($result);
					if ($record) {		//   record exist
						echo "<table id='salesreporttable' class='table table-dark table-striped table-bordered'>";
			?>
						<tr>

							<th><a class="colum_sort" id="name" data-order="'.$order.'" href="#">Item_Name</a></th>
							<th><a class="colum_sort" id="quantity" data-order="'.$order.'" href="#">Quantity</a></th>
							<th><a class="colum_sort" id="description" data-order="'.$order.'" href="#">Price</a></th>
							<th><a class="colum_sort" id="description" data-order="'.$order.'" href="#">Total</a></th>

						</tr>
			<?php

						while ($record) {
							$total = $record['Price'] * $record['Quantity'];

							echo "<td>{$record['Item_name']}</td>";
							echo "<td>{$record['Quantity']}</td>";
							echo "<td>\${$record['Price']}</td>";
							echo "<td>\$$total</td>";

							echo "				
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

		</div>

		<div class="footer">
			<p> People Health Pharmacy | Group 420</p>
		</div>

	</div>

</body>

</html>