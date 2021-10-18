<?php

require_once "settings.php";    // Load MySQL log in credentials
$conn = mysqli_connect($host, $user, $pwd, $sql_db);    // Log in and use database


if ($conn) { // connected

    if (isset($_POST['fromdate']) && isset($_POST['todate'])) {
        $fromdate = $_GET['fromdate'];
        $todate = $_GET['todate'];

        $date = new DateTime($fromdate);
        $fromdate = $date->format('Y-m-d');

        $date2 = new DateTime($todate);
        $todate = $date2->format('Y-m-d');

        $_SESSION["fromdate"] = $fromdate;
        $_SESSION["todate"] = $todate;

        $query = "SELECT * FROM CustomerOrder WHERE Date_Of_Sale BETWEEN '2021-10-17' AND '2021-10-17' ORDER BY Item_Name ASC;";
    } else {

        $query = "SELECT * FROM CustomerOrder ORDER BY Item_Name ASC";
    }

    //execute the query -we should really check to see if the database exists first.
    $result = mysqli_query($conn, $query);

    if ($result->num_rows > 0) {
        $delimiter = ",";
        $filname = "SaleReport-data" . date('Y-m-d') . ".csv";

        //Create a file pointer
        $f = fopen('php://memory', 'w');

        //set column headers
        $fields = array('Transaction No', 'Item Name', 'Quantity', 'Price', 'Date of Sale', 'Time of sale');
        fputcsv($f, $fields, $delimiter);

        //output each row of the data, format line as csv and write to file pointer
        while ($row = $result->fetch_assoc()) {
            //$status = ($row['status'] == 1) ? 'Active' : 'Inactive';
            $lineData = array($row['Transaction_number'], $row['Item_name'], $row['Quantity'], $row['Price'], $row['Date_Of_Sale'], $row['Time_Of_Sale']);
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
