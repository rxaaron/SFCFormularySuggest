<?php
    session_start();
    if($_SESSION["isadmin"] != 1){
        echo "<a href=\"administration.php\">Please Log In as an administrator.</a>";
    }else{
        echo "<br /><br /><br /><form action=\"createuser.php\" method=\"POST\">";
        echo "<table style=\"border:none\"><colgroup><col name=\"label\" style=\"width:250px;\"><col name=\"boxes\" style=\"width:300px;\"></colgroup>";
        echo "<tr><td>Full Name:</td><td><input type=\"text\" name=\"realname\" size=\"30\" /></td></tr>";
        echo "<tr><td>Username:</td><td><input type=\"text\" name=\"uname\" size=\"30\" /></td></tr>";
        echo "<tr><td>Password:</td><td><input type=\"password\" name=\"pwd\" size=\"30\" /></td></tr>";
        echo "<tr><td>Email:</td><td><input type=\"text\" name=\"email\" size=\"30\" /></td></tr>";
        echo "</table>";
        echo "<input type=\"submit\" name=\"gobtn\" value=\"Create User\" style=\"padding:10px 40px 10px 40px;\" />";    
        echo "</form>";
    }
?>