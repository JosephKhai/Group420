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
		if(itemname == ""){
			errMsg += "Please select an item!.\n";
			alert (errMsg);
			result = false;
			return result;
		}

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

function ProcessItems(){
	
	var result = true;
	var errMsg = "";
	var price;
	var table = document.getElementById("OrderTable");
	var RowCount = table.tBodies[0].rows.length; //table.tBodies.length;
	
	if(RowCount < 2)
	{
		errMsg += "There must at least be one sale to add!!";
	}
	else
	{
		//var theItems = [
		//	{
		//		"name": table.rows[1].cells[0].innerHTML,
		//		"quantity": table.rows[1].cells[1].innerHTML,
		//		"price": table.rows[1].cells[2].innerHTML
		//	}
		//];
		
		var xhr = new XMLHttpRequest();
		xhr.open("POST", "sales_process.php");
		xhr.setRequestHeader("Accept", "application/json");
		xhr.setRequestHeader("Content-Type", "application/json");
		
		xhr.onreadystatechange = function () {
		if (xhr.readyState === 4) {
			console.log(xhr.status);
			console.log(xhr.responseText);
		}};
		
		var theItems = [];
			
		for(var i = 1; i < RowCount; i++) // loop through the rows 
		{
			price = table.rows[i].cells[2].innerHTML;
			price = price.replace("$",""); // remove the $
			
			theItems.push({
				"name": table.rows[i].cells[0].innerHTML,
				"quantity": table.rows[i].cells[1].innerHTML,
				"price": price});
		}
		
		var data = JSON.stringify(theItems);
		
		xhr.send(data);
		
		console.log(JSON.stringify(theItems));
	}
	
	if (errMsg != "") {
		/* Display error message any error(s) is/are detected */
		alert (errMsg);
		result = false;
	}
	
	return result;

}

function init() {
	//Setup();
	var addbutton = document.getElementById("addBtn");
	var probutton = document.getElementById("processBtn");
	addbutton.onclick = Add;
	probutton.onclick = ProcessItems;
}
window.onload = init;