<?php

session_start();

require_once "settings.php";    // Load MySQL log in credentials
$conn = mysqli_connect($host, $user, $pwd, $sql_db);    // Log in and use database

//sanitise input function
function sanitise_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$itemError = "Item name can not be empty or should be character only";
$quantityError = "Quantity can not be empty or should be numeric only";
$descriptionError = "Description can not be empty or should be character only";
$priceError = "Price can not be empty or should be numeric only";

//validate form 
// Item name
if (!isset($_POST["ItemName"])) {

    // for security reason, just in case somebody created a similar form, and tried to submit to process_order, we can also test isset for all the text inputs
    header("location:AddSales.php");
    //exit();
} else {
    $itemname = $_POST["ItemName"];
    $itemname = sanitise_input($itemname);
    if ($itemname == "") {
        //echo '<script>alert("Please enter item name.")</script>';
        $_SESSION["itemError"] = $itemError;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $itemname)) {
        //echo '<script>alert("Item name can only contain alphabet character")</script>';
        $_SESSION["itemError"] = $itemError;
    } else {


        // Quantity
        if (!isset($_POST["Quantity"])) {

            // for security reason, just in case somebody created a similar form, and tried to submit to process_order, we can also test isset for all the text inputs
            header("location:AddSales.php");
            //exit();
        } else {
            $quantity = $_POST["Quantity"];
            $quantity = sanitise_input($quantity);
            if ($quantity == "") {
                //echo '<script>alert("Please enter quantity")</script>';
                $_SESSION["quantityError"] = $quantityError;
                //header("location:AddSales.php");
            } else if (!is_numeric($quantity)) {
                //echo '<script>alert("Quantity must be numeric")</script>';
                $_SESSION["quantityError"] = $quantityError;
                //header("location:AddSales.php");
            } else {


                // Item Description
                if (!isset($_POST["Description"])) {

                    // for security reason, just in case somebody created a similar form, and tried to submit to process_order, we can also test isset for all the text inputs
                    header("location:AddSales.php");
                    //exit();
                } else {
                    $description = $_POST["Description"];
                    $description = sanitise_input($description);
                    if ($description == "") {
                        //echo '<script>alert("Please enter item description name")</script>';
                        $_SESSION["descriptionError"] = $descriptionError;
                        //header("location:AddSales.php");
                    } else if (!preg_match("/^[a-zA-Z ]*$/", $description)) {
                        //echo '<script>alert("Item description can only contain alphabet character")</script>';
                        $_SESSION["descriptionError"] = $descriptionError;
                        //header("location:AddSales.php");
                    } else {


                        // Price
                        if (!isset($_POST["Price"])) {
                            // for security reason, just in case somebody created a similar form, and tried to submit to process_order, we can also test isset for all the text inputs
                            header("location:AddSales.php");
                            //exit();
                        } else {
                            $price = $_POST["Price"];
                            $price = sanitise_input($price);
                            if ($price == "") {
                                //echo '<script>alert("Please enter price")</script>';
                                $_SESSION["priceError"] = $priceError;
                                //header("location:AddSales.php");
                            } else if (!is_numeric($price)) {
                                //echo '<script>alert("Item price can only contain numeric")</script>';
                                $_SESSION["priceError"] = $priceError;
                                //header("location:AddSales.php");
                            } else {

                                // addsales page
                                $_SESSION['ItemName'] = $itemname;
                                $_SESSION['Quantity'] = $quantity;
                                $_SESSION['Description'] = $description;
                                $_SESSION['Price'] = $price;


                                if ($conn) { // connected
                                    echo "<p>Connectiion successful</p>";

                                    $query = "CREATE TABLE IF NOT EXISTS PHPWarehouse  (
                                    Item_ID INT AUTO_INCREMENT PRIMARY KEY, 
                                    Item_Name VARCHAR(50), 
                                    Quantity  INT(50),
                                    Item_Description  VARCHAR(50),
                                    Ordertime DATETIME, 
                                    ItemStatus VARCHAR(50),
                                    Price  DECIMAL (5,2)
                                    );";


                                    //execute the query -we should really check to see if the database exists first.
                                    $result = mysqli_query($conn, $query);

                                    if ($result) {
                                        // date time
                                        $datetime = date('Y-m-d H:i:s');

                                        //insert
                                        $query = "INSERT INTO PHPWarehouse (Item_Name, Quantity, Item_Description, Ordertime, ItemStatus, Price ) 
                                        VALUES ('$itemname','$quantity;', '$description', '$datetime', 'INSTOCK', '$price');";


                                        $insert_result = mysqli_query($conn, $query);
                                    } else {
                                        $db_msg = "<p>Create table operation unscucessful." . mysqli_error($conn) . "</p>";
                                    }
                                } else {
                                    $db_msg = "<p>Unable to connect to the datablase.</p>";
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
header("location:AddSales.php?db_msg=$db_msg");
