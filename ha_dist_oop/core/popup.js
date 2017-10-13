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
    var line = Number(table.rows.length);    
    cell1.innerHTML = '<input type="text" size="2" name="lineItemNr' + line + '" value="' + line + '" readonly >';    
    cell2.innerHTML = '<input type="number" name="newSoMaterial' + line + '" placeholder="material ID" value="' + getCookie('materialSelect') + '" required>';    
    cell3.innerHTML = '<input type="number" size="5" name="newSoQty' + line + '" placeholder="Quantity"  required>';
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function DeleteLineItem() {
    var table = document.getElementById('CreateNewElementTable');
    var rowCount = table.rows.length;
    table.deleteRow(rowCount - 1);
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

function ShowMaterialList(){
    document.getElementById("customerList").style.display = "block";
}