<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>SFC Formulary</title>
        <link rel="stylesheet" href="SFCform.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="print.css" type="text/css" media="print" />
        <script>
            window.onload = function() {
            document.getElementById('list').className="active";
            };
            function printme(){
                window.print();
                return false;
            }
        </script>
    </head>
    <body>
        <div id="navbar">
            <?php include_once('nav.php') ?>
        </div>
        <div id="sidebar">
            <h1>Springfield Center</h1>
            <h2>Formulary List</h2>
            <h3><a href="list.php" onclick="return printme()">Printable List</a></h3>
            <div id="menu">
                <h1>Categories</h1>
                <?php include_once('categories.php'); ?>
            </div>
            <h3>Aaron Taylor&trade; 2013</h3>
        </div>
        <div id="main">
            <?php include_once('formulary.php'); ?>
        </div>
    </body>
</html>
