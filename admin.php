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

            <h1>Admin</h1>

            <hr />
            <br />
            <br />

            <fieldset>
                <!--Search Item-->
                <div class="searchItem">
                <form action="admin.php" method="post">
                    <p><strong>Search Item</strong></p>
                    <p><label>Search: <input type="text" name="searchq" id="searchq"></label>
                        <label>Search by: <select name="searchopt" id="searchopt">
                                <option></option>
                                <option value="item_name">Item Name</option>
                                <option value="item_status">Item Status</option>
                            </select></label>
                        <input type="submit" name="submit" value="Search">
                    </p>

                </form>
                </div>

                <hr />
                <br />
                <br />


                <!--Update Item status form-->
                <div class="updateItemStatus">
                <form action="admin.php" method="post">
                    <p><strong>Update Item Status</strong> </p>
                    <p>
                        <label>Item ID: <input type="text" name="item_id" id="item_id"></label>
                        <select name="update_Opt">
                            <option></option>
                            <option value="INSTOCK">IN STOCK</option>
                            <option value="OUT_OF_STOCK">OUT OF STOCK</option>
                            <option value="SOLD">SOLD</option>
                        </select>
                        <input type="submit" name="update" value="update" />
                    </p>

                </form>
                </div>
            </fieldset>

            <?php


            $query = "";

            require_once "settings.php";    // Load MySQL log in credentials
            $conn = mysqli_connect($host, $user, $pwd, $sql_db);    // Log in and use database

            if (isset($_POST["searchq"]) && $_POST["searchq"] != "") {
                if (isset($_POST["searchopt"]) && $_POST["searchopt"] != "") {

                    $escsearch = mysqli_real_escape_string($conn, $_POST["searchq"]);
                    $searchval = preg_replace("#[^a-z 0-9]#i", '', $escsearch);
                    $opt = trim($_POST["searchopt"]);

                    switch ($opt) {

                        case "item_name":
                            $query = "SELECT * FROM Warehouse WHERE Item_Name LIKE '%$searchval%' ";

                            break;
                        case "item_status":
                            $query = "SELECT * FROM Warehouse WHERE ItemStatus LIKE '%$searchval%' ";

                            break;
                    }
                }
            } else {
                $query = "SELECT * FROM Warehouse;";
            }


            //Update Item Status
            if (isset($_POST["item_id"]) && $_POST["item_id"] != "") {
                if (isset($_POST["update_Opt"]) && $_POST["update_Opt"] != "") {

                    $item_id_val = trim($_POST["item_id"]);

                    $opt = trim($_POST["update_Opt"]);
                    switch ($opt) {
                        case "INSTOCK":
                            $query = "UPDATE Warehouse SET ItemStatus ='INSTOCK' WHERE Item_ID= $item_id_val;";
                            break;
                        case "OUT_OF_STOCK":
                            $query = "UPDATE Warehouse SET ItemStatus ='OUT_OF_STOCK' WHERE Item_ID= $item_id_val;";
                            break;
                        case "SOLD":
                            $query = "UPDATE Warehouse SET ItemStatus ='SOLD' WHERE Item_ID= $item_id_val;";
                            break;
                    }

                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        echo "<p>Update successful!</p>";
                        $query = "SELECT * FROM Warehouse;";
                    } else {
                        echo "<p>Update not successful!</p>";
                    }
                }
            }


            if ($conn) { // connected

                $result = mysqli_query($conn, $query);
                if ($result) {    //   query was successfully executed

                    $record = mysqli_fetch_assoc($result);
                    if ($record) {        //   record exist
                        echo "<table id='admintable' class='table table-dark table-striped table-bordered'>";
            ?>
                        <tr>
                            <th><a class="colum_sort" id="id" data-order="'.$order.'">Item_ID</a></th>
                            <th><a class="colum_sort" id="name" data-order="'.$order.'">Item_Name</a></th>
                            <th><a class="colum_sort" id="quantity" data-order="'.$order.'">Quantity</a></th>
                            <th><a class="colum_sort" id="description" data-order="'.$order.'">Item_Description</a></th>
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
                            echo "<td>{$record['ItemStatus']}</td>";
                            echo "<td>{$record['Price']}</td>";
                            echo "<td><a href='delete.php?id=" . $record['Item_ID'] . "'>Delete</a></td>
                                    
                            </tr>";

                            $record = mysqli_fetch_assoc($result);
                        }
                        echo "</table>";
                        mysqli_free_result($result);    // Free resources
                    } else {
                        echo "<p>No record retrieved.</p>";
                    }
                } else {
                    echo "<p>Orders table doesn't exist or select operation unsuccessful.</p>";
                }
                mysqli_close($conn);    // Close the database connection
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