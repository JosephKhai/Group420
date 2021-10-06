<?php

session_start();

require_once "settings.php";    // Load MySQL log in credentials
$conn = mysqli_connect($host, $user, $pwd, $sql_db);    // Log in and use database



if ($conn) { // connected

    $query = "SELECT * FROM Warehouse WHERE ItemStatus = 'SOlD' ORDER BY Item_ID ASC";

    //execute the query -we should really check to see if the database exists first.
    $result = mysqli_query($conn, $query);

    if ($result->num_rows > 0) {
        $delimiter = ",";
        $filname = "SoldStock-data" . date('Y-m-d') . ".csv";

        //Create a file pointer
        $f = fopen('php://memory', 'w');

        //set column headers
        $fields = array('Item ID', 'Item Name', 'Quantity', 'Item Description', 'ItemStatus', 'Price');
        fputcsv($f, $fields, $delimiter);

        //output each row of the data, format line as csv and write to file pointer
        while ($row = $result->fetch_assoc()) {
            //$status = ($row['status'] == 1) ? 'Active' : 'Inactive';
            $lineData = array($row['Item_ID'], $row['Item_Name'], $row['Quantity'], $row['Item_Description'], $row['ItemStatus'], $row['Price']);
            fputcsv($f, $lineData, $delimiter);
        }

        //move back to beginning of file
        fseek($f, 0);

        //set headers to download file rather than display it
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filname . '";');
        fpassthru($f);
    } else {
        $db_msg = "<p>Create operation unscucessful." . mysqli_error($conn) . "</p>";
    }
} else {
    $db_msg = "<p>Unable to connect to the datablase.</p>";
}
