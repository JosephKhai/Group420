function CheckforInt(number) {
		return Number.isInteger(number);
}


function parseQuant(number)
{
	result = false;
	if(CheckforInt(parseInt(number)))
	{
		if(number > 0 && number < 1000)
		{
			return true;
		}
	}
	
	return result;
}


function Add() {
	// Find a <table> element with id="OrderTable"
	var table = document.getElementById("OrderTable");
	var itemname = document.getElementsByName("productOp")[0].value; 
	var quantity = document.getElementById("Quantity").value;
	var RowCount = table.tBodies[0].rows.length; //table.tBodies.length;
	var itemPrice = "0";
	

	var result = true;
	var errMsg = "";
	
	if(!parseQuant(parseInt(quantity))){
		errMsg += "Quantity cannot be zero and must be between 1-999.\n";
	}
	else {
			// Create an empty <tr> element and add it to the 1st position of the table:
		var row = table.insertRow(RowCount);
	
		// Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
		var itemCell = row.insertCell(0);
		var quantCell = row.insertCell(1);
		var priceCell = row.insertCell(2);
		var totalCell = row.insertCell(3);
	
		// Add some text to the new cells:
		itemCell.innerHTML = itemname;
		quantCell.innerHTML = quantity;
	
		//TODO check price here
		itemPrice = myPrices.get(itemname);
		console.debug(itemname);
		console.debug(myPrices);
	
			// check if itemprice is valid
		if (CheckforInt(parseInt(itemPrice))) {
			priceCell.innerHTML = "$" + itemPrice;
			totalCell.innerHTML = "$" + (itemPrice * quantity);
		}
		else { 
			priceCell.innerHTML = "Error";
			priceCell.innerHTML = "NaN";
		}
	}
	
	if (errMsg != "") {
		/* Display error message any error(s) is/are detected */
		alert (errMsg);
		result = false;
	}
	
	return result;

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