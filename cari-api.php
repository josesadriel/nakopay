<html>
    <head>
        <title>Cari Api</title>
    </head>
    <body>
        <div id="demo"></div>
        <script>
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var myObj = JSON.parse(this.responseText);
                document.getElementById("demo").innerHTML = myObj.result;
            }
            };
            xmlhttp.open("GET", "coba-api.php?noHp=089625769346&pin=123456", true);
            xmlhttp.send();
        </script>
    </body>
</html>