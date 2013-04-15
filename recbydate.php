<html>
    <body>
<?php
include_once('nogit/dbconn.php');

	if(!$db) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {
		$query = $db->query("SELECT tblHistory.ID, tblDrugs.GenericName AS GenericName, tblHistory.PtName FROM tblHistory INNER JOIN tblDrugs ON tblHistory.OldDrug = tblDrugs.ID;");
		if($query) {
                // While there are results loop through them - fetching an Object (i like PHP5 btw!).
                    while ($result = $query ->fetch_object()) {
                        echo $result->ID." ".$result->GenericName." ".$result->PtName."<br />";
                        echo substr(md5(rand()),0,7);
                    }
                } else {
                    echo 'ERROR: There was a problem with the query.';
		}
        }
?>
    </body>
</html>