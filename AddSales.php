<!doctype html>
<html>

<head>
    <title>Add Sales</title>
    <meta name="description" content="AddSales">
    <meta name="keywords" content="AddSales">
    <link rel="stylesheet" href="Style/style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

</head>
<body>
    <ul class="topnav">
        <li><a href="index.php">Home</a></li>
        <li><a class="active" href="AddSales.php">Add Sales</a></li>
        <li><a href="UpdateStock.php">Update Stock</a></li>
        <li><a href="SalesReport.php">Sales Report</a></li>
        <li class="right"><a href="About.php">About</a></li>
    </ul>

    <div>
        <h1>Add Sales</h1>
    </div>

    <div>
        <h2>Customer Order</h2>
    </div>
    <div class="AddSales">
        
            <!--<p>
                <label for="ItemName"><b>Item Name</b></label>
                <input type="text" placeholder="Enter Item" name="ItemName" required>
            </p>-->
        <!--<form id="addSaleslist" name="addSaleslist" method="post" action="<?php echo $PHP_SELF; ?>"> -->
		<fieldset>
            <b>Item List :  </b>
            <select Item Name='productOp'>  
            <option value="">--- Product ---</option>  
            <?php
				$checkconnection = mysqli_connect ("group420.cguno6verhdn.ap-southeast-2.rds.amazonaws.com","vapenation4lyf","LLKjMwLSYFW44dbF");  
                mysqli_select_db ($checkconnection,"group420");  
				    //Check if it's valid
			//if(!$checkconnection) {

				//echo '<script>console.log("failed")</script>';
				//Add it up to the session, and redirect

			//} else{

				//Yay
				//echo '<script>console.log("sucesss")</script>';

				//}
				
                //$select="Item_Name";  
               // if (isset ($select)&&$select!=""){  
                //$select=$_POST ['Item_Name'];  
            //}  
            ?>  
            <?php
                $list=mysqli_query($checkconnection,"SELECT * FROM Warehouse;");  
				echo "<script> var myPrices = new Map(); </script>";
            while($row = mysqli_fetch_assoc($list)){  
                echo "<script> myPrices.set('{$row["Item_Name"]}','{$row["Price"]}');</script>";
				?>  
                    <option value="<?php echo $row["Item_Name"]; ?>">
						<?php echo $row["Item_Name"];?>
                    </option>  
                <?php
                }  
                ?>  
				
            </select>  
            <!--<input type="submit" name="Submit" value="Select" />  -->
			 <p>
                <label for="Quantity"><b>Quantity</b></label>
                <input type="number" placeholder="Enter Quantity" id="Quantity" pattern="[0-9]{3}" min="1" max="999" required>
            </p>
            <p>
                <button id="addBtn" type="button">Add</button>
				
            </p>
			</fieldset>
        <!--</form> -->
    </div>

	
    <!--When an item is added (above) display in table bellow-->
    <div>
        <h1>Current Order</h1>
    </div>
    <div>
        <table class="CurrentCustomerOrder" id="OrderTable">
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
				<th>Total</th>
            </tr>
        </table>
    </div>
	<button id="processBtn" type="submit">Process</button>
		<script src="scripts/AddSales.js"></script>
		<?php	
			//echo "<script> var myPrices = new Map(); </script>";
            //while($row = mysqli_fetch_assoc($list)){  
            //echo "<script> myPrices.set('{$row["Item_Name"]}','{$row["Price"]}');</script>";
			//}
		?>
</body>

</html>