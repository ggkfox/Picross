<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styles.css">
    <title>Picross</title>
</head>
<body id="body">

    <h1 id="demo"></h1>

    <script>
        /*
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var complete = JSON.parse(this.responseText);
                alert("h1");
            }
        };
        xhttp.open("GET", "json/json.txt", true);
        xhttp.send(); 
        */
        var arr = [1,2,3,4,5,6,7,8,9]
        var newArr = [];
        while(arr.length) newArr.push(arr.splice(0,3));
        console.log(newArr);


    </script>

    <?php //include 'php/table.php' ?>
</body>
</html>