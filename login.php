<?php
    session_start();
    
    if(!isset($_SESSION["uid"])){
        echo "<h2>Please log in to the system.</h2><br/><br />";
        echo "<form action=\"verify.php\" method=\"POST\" autocomplete=\"off\">";
        echo "<table style=\"border:none\"><colgroup><col name=\"label\" style=\"width:100px;\"><col name=\"boxes\" style=\"width:300px;\"></colgroup>";
        echo "<tr><td>Username:</td><td><input type=\"text\" name=\"uname\" size=\"30\" autocomplete=\"off\"></td></tr>";
        echo "<tr><td>Password:</td><td><input type=\"password\" name=\"pwd\" size=\"30\" autocomplete=\"off\"></td></tr>";
        echo "</table>";
        echo "<input type=\"submit\" name=\"gopwd\" value=\"Log in\" style=\"padding:10px 40px 10px 40px;\">";
        if($_SESSION["failed"]>0){
            echo "<br /><br />Login failed ".$_SESSION["failed"]." time(s).<br /><br /><br />";
            echo "<a href=\"administration.php\" onclick=\"return changepage('forgotpwd.php')\">Forgot Password</a>";
        }
    }else{
        echo"<h2>Welcome, ".$_SESSION["realname"]."!</h2>";
    }
?>