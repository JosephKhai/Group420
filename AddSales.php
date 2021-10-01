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
        <li><a href="homepage.php">Home</a></li>
        <li><a href="AddSales.php">Add Sales</a></li>
        <li><a href="SalesReport.php">Sales Report</a></li>
        <li class="right"><a href="About.php">About</a></li>
    </ul>

    <div>
        <h1>Add Sales</h1>
    </div>

    <?php
    session_start();

    ?>

    <div class="AddSales">
        <h2>Customer Order</h2>

        <form method="post" action="process.php">
            <fieldset>
                <p>
                    <label for="ItemName"><b>Item Name</b></label>
                    <input type="text" placeholder="Enter Item" name="ItemName"> <br />
                    <span class="error">
                        <?php
                        if (isset($_SESSION["itemError"])) {
                            $itemError = $_SESSION["itemError"];
                            echo "<span>$itemError</span>";
                        }
                        ?>
                    </span>
                </p>

                <p>
                    <label for="Quantity"><b>Quanitity</b></label>
                    <input type="text" placeholder="Enter Quantity" name="Quantity"><br />
                    <span class="error">
                        <?php
                        if (isset($_SESSION["quantityError"])) {
                            $quantityError = $_SESSION["quantityError"];
                            echo "<span>$quantityError</span>";
                        }
                        ?>
                    </span>
                </p>

                <p>
                    <label for="Description"><b>Item Description</b></label>
                    <input type="text" placeholder="Enter Description" name="Description"> <br />
                    <span class="error">
                        <?php
                        if (isset($_SESSION["descriptionError"])) {
                            $descriptionError = $_SESSION["descriptionError"];
                            echo "<span>$descriptionError</span>";
                        }
                        ?>
                    </span>
                </p>

                <p>
                    <label for="price"><b>Price</b></label>
                    <input type="text" placeholder="Enter price" name="Price"><br />
                    <span class="error">
                        <?php
                        if (isset($_SESSION["priceError"])) {
                            $priceError = $_SESSION["priceError"];
                            echo "<span>$priceError</span>";
                        }
                        ?>
                    </span>
                </p>

                <p>
                    <button type="submit">Add</button>
                </p>

            </fieldset>

        </form>


    </div>


    <?php

    require_once "settings.php";    // Load MySQL log in credentials
    $conn = mysqli_connect($host, $user, $pwd, $sql_db);    // Log in and use database

    if ($conn) { // connected

        echo "database connected!<br>";

        $query = "SELECT * FROM PHPWarehouse;";

        $result = mysqli_query($conn, $query);
        if ($result) {    //   query was successfully executed

            $record = mysqli_fetch_assoc($result);
            if ($record) {        //   record exist
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
                    echo "				
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


    <!--When an item is added (above) display in table bellow

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
       -->


</body>

</html>

<?php
unset($_SESSION["itemError"]);
unset($_SESSION["quantityError"]);
unset($_SESSION["descriptionError"]);
unset($_SESSION["priceError"]);
?>