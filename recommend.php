<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>SFC Interchange Entry</title>
        <link rel="stylesheet" href="SFCform.css" type="text/css" />
    </head>
    <body>
    <div id="main">
        <h1>Interchange Entry</h1>
        <?php
	$db = new mysqli("localhost", "root" ,"udd6zjat", "formularysuggest");

	if(!$db) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {
		// Is there a posted query string?
		if(isset($_GET['olddrug'])) {
			$oldDrug = $db->real_escape_string($_GET['olddrug']);
                        $newDrug = $db->real_escape_string($_GET['newdrug']);
			
			// Is the string length greater than 0?
			
			if(strlen($oldDrug) >0) {
				
                           $query = $db->query("SELECT ID, BrandName, GenericName, Strength FROM tblDrugs WHERE ID=".$oldDrug.";");
				if($query) {
                                    // While there are results loop through them - fetching an Object (i like PHP5 btw!).
                                    while ($result = $query ->fetch_object()) {
                                        echo "<form autocomplete=\"off\" action=\"printchange.php\" method=\"post\"><h2>Ordered Drug: ".$result->BrandName." (".$result->GenericName.")<br />";
                                        echo "<input type=\"hidden\" name=\"olddrug\" value=\"".$result->ID."\">";
                                        }
                                
                                } else {
					echo 'ERROR: There was a problem with the query.';
				}
                            $query2 = $db->query("SELECT ID, BrandName, GenericName, Strength FROM tblDrugs WHERE ID=".$newDrug.";");
                                if($query2) {
                                    while ($result2 = $query2 ->fetch_object()) {
                                        echo "<h2>Formulary Drug: ".$result2->BrandName." (".$result2->GenericName.")<br />";
                                        echo "<input type=\"hidden\" name=\"newdrug\" value=\"".$result2->ID."\">";
                                    }
                                } 
			} else {
				// Dont do anything.
			} // There is a queryString.
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>
        <h2>Patient Name: <input type="text" size="44" name="ptname" autocomplete="off" value="" /></h2>
        <h2>Physician Name: <input type="text" size="40" name="drname" autocomplete="off" value="Dr. Ragsdale" /></h2>
        <br /><input type="submit" value="Record Interchange" style="margin-left: 190px; padding:5px 30px 5px 30px;" />
        </form>
        </div>
        </body>
        </html>