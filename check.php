<?php
	include_once('nogit/dbconn.php');
	
	if(!$db) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {
		// Is there a posted query string?
		if(isset($_POST['drugid'])) {
			$queryString = $db->real_escape_string($_POST['drugid']);
			
			// Is the string length greater than 0?
			
			if(strlen($queryString) >0) {
								
				$query = $db->query("SELECT tblDrugs.BrandName, tblDrugs.GenericName, tblDrugs.Strength, tblDrugs.InterchangeKey, tblDrugs.Springfield FROM tblDrugs WHERE tblDrugs.ID = ".$queryString." AND Active = true;");
				if($query) {
					// While there are results loop through them - fetching an Object (i like PHP5 btw!).
					while ($result = $query ->fetch_object()) {
						echo "<h3>Brand Name:</h3>".$result->BrandName."<br /><h3>Generic Name:</h3>".$result->GenericName."<br /><h3>Strength:</h3>".$result->Strength."<br /><br /><h3>On SFC Formulary:</h3>";
						if ($result->Springfield == 1) {
							echo "Yes";
						} else {
							echo "No";
							if ($result->InterchangeKey != 0) {
								echo "<br /><h3>Formulary Alternatives:</h3><br />";
								$query2 = $db->query("SELECT ID, BrandName, GenericName, Strength FROM tblDrugs WHERE Active = true AND Springfield = true AND InterchangeKey = ".$result->InterchangeKey.";");
								if($query2){
									echo "<table><colgroup><col class=\"brand\"><col class=\"generic\"><col class=\"strength\"><col class=\"recommend\"></colgroup><tr><th>Brand Name</th><th>Generic Name</th><th>Strength</th><th>Action</th></tr>";
									$c=true;
									while ($results2 = $query2->fetch_object()) {
									echo "<tr ".(($c=!$c)?'class="even"':'class="odd"')."><td>".$results2->BrandName."</td><td>".$results2->GenericName."</td><td>".$results2->Strength."</td><td><a href=\"recommend.php?olddrug=".$queryString."&newdrug=".$results2->ID."\">Interchange</a></tr>";
									}
								}
							} else {
								echo "<br /><h3>No Formulary Alternatives Available.</h3>";
							}
						}	
					}
				} else {
					echo 'ERROR: There was a problem with the query.';
				}
			} else {
				// Dont do anything.
			} // There is a queryString.
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>