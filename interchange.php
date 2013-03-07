<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>SFC Interchange Recommendations</title>
        <link rel="stylesheet" href="SFCform.css" type="text/css" />
        <script>
            window.onload = function() {
                document.getElementById('interchange').className="active";
            };
            function searchbox(inpt) {
                var xmlhttp;
                xmlhttp=new XMLHttpRequest();
                xmlhttp.open("POST","res.php",false);
                xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                xmlhttp.send("queryString="+inpt);
                document.getElementById("menu").innerHTML=xmlhttp.responseText;
            }
            function resultlist(drugid) {
                var xmlhttp2;
                xmlhttp2=new XMLHttpRequest();
                xmlhttp2.open("POST","check.php",false);
                xmlhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                xmlhttp2.send("drugid="+drugid);
                document.getElementById("main").innerHTML=xmlhttp2.responseText;
            }
        </script>
    </head>
    <body>
        <div id="navbar">
            <?php include_once('nav.php') ?>
        </div>
        <div id="sidebar">
            <h1>Springfield Center</h1>
            <h2>Formulary Utility</h2>
            <h3>Drug Search:</h3>
            <form autocomplete="off">
                <input type="text" name="inputString" id="inputString" autocomplete="off" onkeyup="searchbox(this.value);" />
            </form>
            <div id="menu">
            </div>
            <h3>Aaron Taylor&trade; 2013</h3>
        </div>
        <div id="main">
            <h1>Welcome</h1>
            <p>
                Results will appear here after a drug is selected.
            </p>
        </div>
    </body>
</html>