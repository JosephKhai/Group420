<?php
//for delete function


require_once "settings.php";    // Load MySQL log in credentials
$conn = mysqli_connect($host, $user, $pwd, $sql_db);    // Log in and use database

//delete record
function deleteRecord(mysqli $conn, $id)
{
    $query = "DELETE FROM Warehouse Where Item_ID = $id;";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "Error Deleting record!";
    }
}

$id = "";
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
}

if (empty($id)) {
    echo "ID is blank!";
}

deleteRecord($conn, $id);
header('location: admin.php');
die;
