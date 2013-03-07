<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Encore Formulary Utility</title>
        <link rel="stylesheet" href="SFCform.css" type="text/css" />
        <script>
            window.onload = function() {
            document.getElementById('administration').className="active";
            };
            function changepage(pagename){
                var xmlhttp;
                xmlhttp=new XMLHttpRequest();
                xmlhttp.open("POST",pagename,false);
                xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                xmlhttp.send();
                document.getElementById("main").innerHTML=xmlhttp.responseText;  
                return false;
            };
        </script>
    </head>
    <body>
        <div id="navbar">
            <?php include_once('nav.php'); ?>
        </div>
        <div id="sidebar">
            <h1>Springfield Center</h1>
            <h2>Formulary Utility</h2>
            <h3><a href="logout.php?pageurl=administration">Log Out</a></h3>
            <div id="menu">
                <h1>Drugs</h1>
                <a href="administration.php" onclick="return changepage('editdrug.php')">Edit Drug</a><br />
                <a href="administration.php" onclick="return changepage('adddrug.php')">Add Drug</a><br />
                <h1>Interchanges</h1>
                <a href="administration.php" onclick="return changepage('editinterchange.php')">Edit Interchange</a><br />
                <a href="administration.php" onclick="return changepage('addinterchange.php')">Add Interchange</a><br />
                <h1>Records</h1>
                <a href="administration.php" onclick="return changepage('editrecommendation.php')">Edit Recommendation</a><br />
                <h1>Users</h1>
                <a href="administration.php" onclick="return changepage('profile.php')">Profile</a><br />
                <a href="administration.php" onclick="return changepage('changepwd.php')">Change Password</a><br />
                <?php 
                    session_start();
                    if($_SESSION["isadmin"]==1){
                        echo "<a href=\"administration.php\" onclick=\"return changepage('adduser.php')\">Add User</a><br />";
                    }
                ?>
            </div>
            <h3>Aaron Taylor&trade; 2013</h3>
        </div>
        <div id="main">
            <?php include_once('login.php'); ?>
        </div>
    </body>
</html>