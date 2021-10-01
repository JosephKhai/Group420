function CheckforInt(var s) {
		return Number.isInteger(s);
}

function Add() {
	// Find a <table> element with id="OrderTable"
	var table = document.getElementById("OrderTable");
	var itemname = document.getElementsByName("ItemName")[0].value; 
	var quantity = document.getElementsByName("Quantity")[0].value;
	var RowCount = table.tBodies[0].rows.length; //table.tBodies.length;
	var itemPrice = "0";
	//PreparedStatement preparedStmt;
	//ResultSet rs;
	
	
	var user = "vapenation4lyf";
	var pass = "LLKjMwLSYFW44dbF";
	var serverDetails = "group420.cguno6verhdn.ap-southeast-2.rds.amazonaws.com";
	var portNum = "3306";
	//var connect = getConnection(serverDetails, user, pass, portNum);
	//String query = " insert into users (first_name, last_name, date_created, is_admin, num_points)" + " values (?, ?, ?, ?, ?)";
	
	// Create an empty <tr> element and add it to the 1st position of the table:
	var row = table.insertRow(RowCount);
	
	// Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
	var itemCell = row.insertCell(0);
	var quantCell = row.insertCell(1);
	var priceCell = row.insertCell(2);
	var totalCell = row.insertCell(3);
	
	var mysql = require('mysql');

	var con = mysql.createConnection({
		host: "group420.cguno6verhdn.ap-southeast-2.rds.amazonaws.com",
		user: "vapenation4lyf",
		password: "LLKjMwLSYFW44dbF",
		database: "group420"
	});

	con.connect(function(err) {
	if (err) throw err;
		con.query("SELECT Price FROM Warehouse WHERE UPPER(Item_Name) = ?",[itemname], function (err, result, fields) {
			if (err) throw err;
			console.log(result);
			var row = result[key];
			console.log(row.name);
			console.log(row.value);
			});
	});
	
	// Add some text to the new cells:
	itemCell.innerHTML = itemname;
	quantCell.innerHTML = quantity;
	
	//TODO check price here
	//if(connect != null) {
	//	// the mysql insert statement
	//	query = "SELECT Price FROM Warehouse WHERE UPPER(Item_Name) = ?";
	//	
	//	Object.keys(result).forEach(function(key) {
	//	var row = result[key];
	//	console.log(row.name)
	//	rs = preparedStmt.executeQuery();        // Get the result table from the query 
	//	itemPrice = rs.getString(1);        // Retrieve the first column value
	//}
	
		// check if itemprice is valid
	if (CheckforInt(itemPrice)) {
		priceCell.innerHTML = itemPrice;
		totalCell.innerHTML = itemPrice * quantity;
	}
	else { 
		priceCell.innerHTML = "Error";
		priceCell.innerHTML = "NaN";
	}
}

//function ProcessItems(){
//	
//	var table = document.getElementById("OrderTable");
//	var itemname = document.getElementsByName("ItemName")[0].value; 
//	var quantity = document.getElementsByName("Quantity")[0].value;
//	
//	for (var i = 0, row; row = table.rows[i]; i++) {
//		//iterate through rows
//		
//
//		//for (var j = 0, col; col = row.cells[j]; j++) {
//     //iterate through columns
//		//
//		//}  
//	}
//}

//public function Connection getConnection(var serverDeets, var usr, var pwd, var port) throws SQLException {
//
//    Connection conn = null;
//    Properties connectionProps = new Properties();
//    connectionProps.put("user", usr);
//    connectionProps.put("password", pwd);
//
//    if (this.dbms.equals("mysql")) {
//        conn = DriverManager.getConnection(
//                   "jdbc:" + mysql + "://" +
//                   serverDeets +
//                   ":" + port + "/",
//                   connectionProps);
//    } else {
//		return null;
//    }
//    System.out.println("Connected to database");
//    return conn;
//}

function init() {
	//Setup();
	var addbutton = document.getElementById("addBtn");
	addbutton.onclick = Add;
}
window.onload = init;