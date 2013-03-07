<?php
    session_start();
    if(!isset($_SESSION["uid"])){
        echo "<a href=\"administration.php\">Please Log In.</a>";
    }else{
        echo "<br /><br /><br /><form action=\"makechange.php\" method=\"POST\">";
        echo "<table style=\"border:none\"><colgroup><col name=\"label\" style=\"width:250px;\"><col name=\"boxes\" style=\"width:300px;\"></colgroup>";
        echo "<tr><td>Old Password:</td><td><input type=\"password\" name=\"oldpwd1\" size=\"30\" /></td></tr>";
        echo "<tr><td>Re-type Old Password:</td><td><input type=\"password\" name=\"oldpwd2\" size=\"30\" /></td></tr>";
        echo "<tr><td>New Password:</td><td><input type=\"password\" name=\"newpwd\" size=\"30\" /></td></tr>";
        echo "</table>";
        echo "<input type=\"submit\" name=\"gobtn\" value=\"Change Password\" style=\"padding:10px 40px 10px 40px;\" />";    
        echo "</form>";
    }
?>