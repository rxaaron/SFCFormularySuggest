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
	$db = new mysqli("serveraddress", "username" ,"password", "database");
	
	if(!$db) {
            // Show error if we cannot connect.
            echo 'ERROR: Could not connect to the database.';
	} else {
            if(isset($_GET['id'])) {
		$queryString = $db->real_escape_string($_GET['id']);
		$query = $db->query("SELECT D.ID, D.BrandName, D.GenericName, D.Strength, D.Active, C.CategoryName, I.InterchangeName,
                                    D.Springfield FROM tblDrugs D
                                    INNER JOIN tblCategory C ON D.Category=C.ID 
                                    INNER JOIN tblInterchange I ON D.InterchangeKey=I.ID 
                                    WHERE D.ID=".$queryString.";");
		if($query) {
			while ($result = $query ->fetch_object()) {
				echo "html output";
                        }
		} else {
			echo 'ERROR: There was a problem with the query.';
		}
            }
	}
?>
        </div>
    </body>
</html>