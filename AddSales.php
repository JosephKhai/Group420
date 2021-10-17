<!doctype html>
<html>
<head>
    <title>Add Sales</title>
    <meta name="description" content="AddSales">
    <meta name="keywords" content="AddSales">
    <link rel="stylesheet" href="Style/style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>


        <div id="page-container">
		<div id="content-wrap">
            <ul class="topnav">
                <li><a href="homepage.php">Home</a></li>
                <li><a class="active" href="AddSales.php">Add Sales</a></li>
                <li><a href="SalesReport.php">Sales Report</a></li>
            </ul>

             
    <div>
        <h2 id="customerorder">Customer Order</h2>
    </div>
    <div class="AddSales">
    <!--<form id="addSaleslist" name="addSaleslist" method="post" action="sales_process.php">-->
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
			 <p id='addsalesquantity'>
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
        <table class="table table-dark table-striped table-bordered" id="OrderTable">
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
				<th>Total</th>
            </tr>
        </table>
    </div>
		<button id="processBtn" type="button" value="postit">Process</button>
		<div id="resultdiv"> </div>
	<!--</form>-->
		<script src="scripts/AddSales.js"></script>
      
      </div>
  </div>
    <div class="footer">
        <p> People Health Pharmacy | Group 420</p>
     </div>

</body>

</html>
