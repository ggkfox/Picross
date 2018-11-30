var arr = [];
var xhttp;

xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        arr = JSON.parse(JSON.parse(this.responseText));  
    }
};
xhttp.open("GET", "json/json.txt", true);
xhttp.send();
console.log(arr);