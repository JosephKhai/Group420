<?php
		header("Content-Type: application/json");
		$host = "group420.cguno6verhdn.ap-southeast-2.rds.amazonaws.com";
		$user = "vapenation4lyf"; //  user name
		$pwd = "LLKjMwLSYFW44dbF";  //  password
		$sql_db = "group420" ; //  database

		$checkconnection = mysqli_connect ("group420.cguno6verhdn.ap-southeast-2.rds.amazonaws.com","vapenation4lyf","LLKjMwLSYFW44dbF");
		mysqli_select_db ($checkconnection,"group420");

		if(!$checkconnection){
				die('Connection failed : '.mysqli_connect_error());
		}

		//$myArray = $_POST['Results'];
		$data = json_decode(file_get_contents("php://input"));

		if($data != null)
		echo "Items have been processed!";



		//foreach($data as [$itemname, $quant, $price])
		//{
		//	echo "name: $itemname count: $quant cost: $price\n";
		//}

		$name = "";
		$quant = "";
		$price = "";
		$date = date("Y-m-d");
		$time = date("h:i:s");
		$query;


		foreach($data as $itemname)
		{
			echo $itemname->name;
			echo $itemname->quantity;
			echo $itemname->price;

			$name = $itemname->name;
			$quant = $itemname->quantity;
			$price = $itemname->price;

			if($name != "" && $quant != "" && $price != "")
			{
				$query = "INSERT INTO CustomerOrder (Item_Name, Quantity, Price, Date_Of_Sale, Time_Of_Sale)
                                        VALUES ('$name','$quant;', '$price', '$date', '$time');";
				$result = mysqli_query($checkconnection, $query);
				if(!$result)
				{
					echo "<p>Processing failed!</p>";
				}
				else
				{
					echo "<p>Items have been processed!</p>";
				}
			}
		}

	?>
