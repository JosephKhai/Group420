<!doctype html>
<html>

<head>
    <title>Add Sales</title>
    <meta name="description" content="AddSales">
    <meta name="keywords" content="AddSales">
    <link rel="stylesheet" href="Style/style.css">
	<script src="scripts/AddSales.js"></script>
</head>

<body>
    <ul class="topnav">
        <li><a href="index.php">Home</a></li>
        <li><a class="active" href="AddSales.html">Add Sales</a></li>
        <li><a href="UpdateStock.html">Update Stock</a></li>
        <li><a href="SalesReport.php">Sales Report</a></li>
        <li class="right"><a href="About.html">About</a></li>
    </ul>

    <div>
        <h1>Add Sales</h1>
    </div>

    <div>

    </div>
    <div class="AddSales">
        <h2>Customer Order</h2>
        <fieldset>
            <p>
                <label for="ItemName"><b>Item Name</b></label>
                <input type="text" placeholder="Enter Item" name="ItemName" required>
            </p>
            <p>
                <label for="Quantity"><b>Quanitity</b></label>
                <input type="text" placeholder="Enter Quantity" name="Quantity" required>
            </p>
            <p>
                <button id="addBtn" type="submit">Add</button>
            </p>

        </fieldset>

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
            </tr>
            <tr>
                <td>This is an item</td>
                <td>4</td>
                <td>420</td>
            </tr>
        </table>
    </div>


    <button type="submit">Process</button>
</body>

</html>