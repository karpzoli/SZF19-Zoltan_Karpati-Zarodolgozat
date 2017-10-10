function CreateNewElement() {
    document.getElementById("backGround").style.display = "block";
    document.getElementById("entryWindow").style.display = "block";    
}

function CancelNewElement() {
    //document.getElementById("backGround").style.display = "none";
    //document.getElementById("entryWindow").style.display = "none";
    location.reload();
}

function AddNewLineItem() {
    var table = document.getElementById("CreateNewElementTable");
    var rows = document.getElementById("CreateNewElementTable").getElementsByTagName("tr").length;
    var row = table.insertRow(table.rows.length);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var line = Number(table.rows.length)-3;
    cell1.innerHTML = '<input type="number" name="lineItemNr' + line + '" value="' + line + '" readonly >';
    cell5.innerHTML = '<input type="button" class="button-error pure-button" onClick="DeleteLineItem(this)" value="Delete">';
    cell2.innerHTML = '<input type="text" name="newSoMaterial' + line + '" placeholder="material ID" required>';
    cell3.innerHTML = '<input type="button" name="newSoMaterial' + line + '" value="List" class="button-secondary pure-button">';
    cell4.innerHTML = '<input type="number" name="newSoQty' + line + '" placeholder="Quantity" required>';
}

function DeleteLineItem(rowNumber) {
    var i = rowNumber.parentNode.parentNode.rowIndex;
    if (i != 1) document.getElementById('CreateNewElementTable').deleteRow(i);
}

function ResetForm() {
    document.getElementByName("CreateNewsSO").reset();
}

function Alerting() {
    window.alert(" has been successfully created!");
}

function goBack() {
    window.history.back();
}