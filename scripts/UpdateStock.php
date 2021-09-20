<?php
$mysqli = new mysqli("group420.cguno6verhdn.ap-southeast-2.rds.amazonaws.com", "root", "12345678", "group420");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

/* Create table doesn't return a resultset */
// if ($mysqli->query("CREATE TEMPORARY TABLE myCity LIKE City") === TRUE) {
//     printf("Table myCity successfully created.\n");
// }

/* Select queries return a resultset */
if ($result = $mysqli->query("SELECT * FROM Item_Warehouse")) {
    printf("Select returned %d rows.\n", $result->num_rows);

    /* free result set */
    $result->close();
}

if(isset($_POST['test'])) {
    echo "This is Button1 that is selected";
}
if(isset($_POST['button2'])) {
    echo "This is Button2 that is selected";
}
echo "<p>Connection successful</p>";

$mysqli->close();

?>