function Add() {
	// Find a <table> element with id="OrderTable":
	var table = document.getElementById("OrderTable");
	var itemname = document.getElementsByName("ItemName")[0].value; 
	var quantity = document.getElementsByName("Quantity")[0].value;
	var RowCount = table.tBodies[0].rows.length; //table.tBodies.length;

	// Create an empty <tr> element and add it to the 1st position of the table:
	var row = table.insertRow(RowCount);
	
	// Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
	var itemCell = row.insertCell(0);
	var quantCell = row.insertCell(1);
	var priceCell = row.insertCell(2);
	
	// Add some text to the new cells:
	itemCell.innerHTML = itemname;
	quantCell.innerHTML = quantity;
	priceCell.innerHTML = "77777";
}

function init() {
	//Setup();
	var addbutton = document.getElementById("addBtn");
	addbutton.onclick = Add;
}
window.onload = init;