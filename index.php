<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Encore Formulary Utility</title>
        <link rel="stylesheet" href="SFCform.css" type="text/css" />
        <script>
            window.onload = function() {
            document.getElementById('home').className="active";
            };
        </script>
    </head>
    <body>
        <div id="navbar">
            <?php include_once('nav.php') ?>
        </div>
        <div id="sidebar">
            <h1>Springfield Center</h1>
            <h2>Formulary Utility</h2>
            <div id="menu">
                <?php include_once('startmenu.php'); ?>
            </div>
            <h3>Aaron Taylor&trade; 2013</h3>
        </div>
        <div id="main">
            <h1>Welcome</h1>
            <p>
                Need some instruction text here.
            </p>
        </div>
    </body>
</html>
