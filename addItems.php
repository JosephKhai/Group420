<!doctype html>
<html>

<head>
    <title>Add Item</title>
    <meta name="description" content="AddSales">
    <meta name="keywords" content="AddSales">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/style.css">
</head>

<body>

    <div id="page-container">
		<div id="content-wrap">

            <ul class="topnav">
                <li><a href="homepage.php">Home</a></li>
                <li><a href="addItems.php">Add Item</a></li>
                <li><a href="warehouse.php">Warehouse Report</a></li>
            </ul>

            <div>
                <h1 id="hadditem">Add Item</h1>
            </div>

            <?php
            session_start();

            ?>

            <div class="AddItems">
                <h2 id="haddmed">ADD MEDICINE</h2>

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
                            <button id="addbutton" type="submit">Add</button>
                        </p>

                    </fieldset>

                </form>


            </div>


            <?php

            require_once "settings.php";    // Load MySQL log in credentials
            $conn = mysqli_connect($host, $user, $pwd, $sql_db);    // Log in and use database

            if ($conn) { // connected

            //  echo "database connected!<br>";

                $query = "SELECT * FROM Warehouse;";

                $result = mysqli_query($conn, $query);
                if ($result) {    //   query was successfully executed

                    $record = mysqli_fetch_assoc($result);
                    if ($record) {        //   record exist
                        echo "<table id='additemstable' class='table table-dark table-striped table-bordered'>";
            ?>
                        <tr>
                            <th><a class="colum_sort" id="id" data-order="'.$order.'">Item_ID</a></th>
                            <th><a class="colum_sort" id="name" data-order="'.$order.'">Item_Name</a></th>
                            <th><a class="colum_sort" id="quantity" data-order="'.$order.'">Quantity</a></th>
                            <th><a class="colum_sort" id="description" data-order="'.$order.'">Item_Description</a></th>
                            <th><a class="colum_sort" id="description" data-order="'.$order.'">ItemStatus</a></th>
                            <th><a class="colum_sort" id="price" data-order="'.$order.'">Price</a></th>
                            <th><a class="colum_sort" id="emptyspace" data-order="'.$order.'"></a></th>


                        </tr>
            <?php
                        while ($record) {
                            echo "<tr><td>{$record['Item_ID']}</td>";
                            echo "<td>{$record['Item_Name']}</td>";
                            echo "<td>{$record['Quantity']}</td>";
                            echo "<td>{$record['Item_Description']}</td>";
                            echo "<td>{$record['ItemStatus']}</td>";
                            echo "<td>{$record['Price']}</td>";
                            echo "<td><a href='edit.php?id=" . $record['Item_ID'] . "'>Edit</a></td>		
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

<?php
unset($_SESSION["itemError"]);
unset($_SESSION["quantityError"]);
unset($_SESSION["descriptionError"]);
unset($_SESSION["priceError"]);
?>