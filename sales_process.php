<?php
	$host = "group420.cguno6verhdn.ap-southeast-2.rds.amazonaws.com";
	$user = "vapenation4lyf"; //  user name
	$pwd = "LLKjMwLSYFW44dbF";  //  password 
	$sql_db = "group420" ; //  database  

	$checkconnection = mysqli_connect ("group420.cguno6verhdn.ap-southeast-2.rds.amazonaws.com","vapenation4lyf","LLKjMwLSYFW44dbF");  
    mysqli_select_db ($checkconnection,"group420");  
	
	if(!$checkconnection){
			die('Connection failed : '. mysqli_connect_error()));
	}
	
	$myArray = $_POST['Results'];
	
	foreach item... 
	
?>