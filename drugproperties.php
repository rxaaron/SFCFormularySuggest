<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Encore Formulary Utility</title>
        <link rel="stylesheet" href="SFCform.css" type="text/css" />
    </head>
    <body>
        <div id="navbar">
            <?php include_once('nav.php') ?>
        </div>
        <div id="main">
<?php
	$db = new mysqli("localhost", "root" ,"udd6zjat", "formularysuggest");
	
	if(!$db) {
            // Show error if we cannot connect.
            echo 'ERROR: Could not connect to the database.';
	} else {
            if(isset($_GET['id'])) {
		$queryString = $db->real_escape_string($_GET['id']);
		$Drugquery = $db->query("SELECT ID, BrandName, GenericName, Strength, Active, Category, InterchangeKey, Springfield 
                                    FROM tblDrugs
                                    WHERE ID=".$queryString.";");
		if($Drugquery) {
                    $DrugResult = $Drugquery ->fetch_object();
		} else {
			echo 'ERROR: There was a problem with the query.';
		}
                
                $Categoryquery = $db->query("SELECT ID, CategoryName FROM tblCategory WHERE Active=true;");
                $Interchangequery = $db->query("SELECT ID, InterchangeName FROM tblInterchange WHERE Active=true;");
                
                echo "<form action=\"updatedrug.php\" method=\"POST\" autocomplete=\"off\">";
                echo "<table style=\"border:none\"><colgroup><col name=\"label\" style=\"width:250px;\"><col name=\"boxes\" style=\"width:300px;\"></colgroup>";
                echo "<tr><td>Drug ID:</td><td><input type=\"text\" name=\"id\" size=\"30\" value=\"".$DrugResult->ID."\" autocomplete=\"off\" /></td></tr>";
                echo "<tr><td>Brand Name:</td><td><input type=\"text\" name=\"brandname\" size=\"30\" value=\"".$DrugResult->BrandName."\" autocomplete=\"off\" /></td></tr>";
                echo "<tr><td>Generic Name:</td><td><input type=\"text\" name=\"genericname\" size=\"30\" value=\"".$DrugResult->GenericName."\" autocomplete=\"off\" /></td></tr>";
                echo "<tr><td>Strength:</td><td><input type=\"text\" name=\"strength\" size=\"30\" value=\"".$DrugResult->Strength."\" autocomplete=\"off\" /></td></tr>";
                if($DrugResult->Active==1){
                    echo "<tr><td>Active in System:</td><td><input type=\"checkbox\" name=\"active\" checked /></td></tr>";
                }else{
                    echo "<tr><td>Active in System:</td><td><input type=\"checkbox\" name=\"active\"/></td></tr>";
                }
                if($DrugResult->Springfield==1){
                    echo "<tr><td>On SFC Formulary:</td><td><input type=\"checkbox\" name=\"springfield\" checked /></td></tr>";
                }else{
                    echo "<tr><td>On SFC Formulary:</td><td><input type=\"checkbox\" name=\"springfield\" /></td></tr>";
                }
                echo "<tr><td>Category:</td><td><select name=\"category\">";
                while ($CategoryResult = $Categoryquery->fetch_object()){
                    if($CategoryResult->ID==$DrugResult->Category){
                        echo "<option value=\"".$CategoryResult->ID."\" label=\"".$CategoryResult->CategoryName."\" selected />";
                    }else{
                        echo "<option value=\"".$CategoryResult->ID."\" label=\"".$CategoryResult->CategoryName."\" />";
                    }
                }
                echo "</select></td></tr>";
                echo "<tr><td>Interchange Name:</td><td><select name=\"interchange\">";
                while ($InterchangeResult = $Interchangequery->fetch_object()){
                    if($InterchangeResult->ID==$DrugResult->InterchangeKey){
                        echo "<option value=\"".$InterchangeResult->ID."\" label=\"".$InterchangeResult->InterchangeName."\" selected />";
                    }else{
                        echo "<option value=\"".$InterchangeResult->ID."\" label=\"".$InterchangeResult->InterchangeName."\" />";
                    }
                }
                echo "</selected></td></tr></table>";
                echo "<input type=\"submit\" name=\"gobtn\" value=\"Update Drug\" style=\"padding:10px 40px 10px 40px;\" />";
                echo "</form>";                
            }
	}
?>
        </div>
    </body>
</html>