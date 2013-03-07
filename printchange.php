<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Springfield Formulary Interchange Recommendation</title>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" href="SFCform.css" type="text/css" media="screen" />
<link rel="stylesheet" href="print.css" type="text/css" media="print" />
<script>
    function printnow() {
    window.print();
    return false;
    };
</script>
</head>

<body>
    <div id="logo">
        <img src="elogo.png" height="75" width="225" style="border:none;"/><br />
        Phone: 304.793.6315<br />
        Fax: 304.647.9772
    </div>
    <div id="results">
        <h1>Formulary Interchange Recommendation</h1>
        <table><colgroup><col class="title"><col class="entry"></colgroup>
<?php
$db = new mysqli("localhost", "root" ,"udd6zjat", "formularysuggest");

	if(!$db) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {
		// Is there a posted query string?
		if(isset($_POST['olddrug'])) {
			$oldDrug = $db->real_escape_string($_POST['olddrug']);
                        $newDrug = $db->real_escape_string($_POST['newdrug']);
                        $ptName = $_POST['ptname'];
                        $drName = $_POST['drname'];
                        $today = date("Ymd");
                      			
			// Is the string length greater than 0?
			
			if(strlen($oldDrug) >0) {
                            
                           $order = $db->query("INSERT INTO tblHistory (OldDrug, NewDrug, PtName, DrName, EntryDate) VALUES ('".$oldDrug."','".$newDrug."','".$ptName."','".$drName."',".$today.");");
                                                      				
                           $query = $db->query("SELECT ID, BrandName, GenericName, Strength FROM tblDrugs WHERE ID=".$oldDrug.";");
				if($query) {
                                    // While there are results loop through them - fetching an Object (i like PHP5 btw!).
                                    while ($result = $query ->fetch_object()) {
                                        echo "<tr><th>Ordered Drug:</th><td>".$result->BrandName." (".$result->GenericName.")</td></tr>";
                                                                                }
                                
                                } else {
					echo 'ERROR: There was a problem with the query.';
				}
                           $query2 = $db->query("SELECT ID, BrandName, GenericName, Strength FROM tblDrugs WHERE ID=".$newDrug.";");
                                if($query2) {
                                    while ($result2 = $query2 ->fetch_object()) {
                                        echo "<tr><th>Formulary Drug:</th><td>".$result2->BrandName." (".$result2->GenericName.")</td></tr>";
                                    }
                                } else {
                                    echo "Something went wrong here.";
                                }
                            echo "<tr><th>Patient Name:</th><td>".$ptName."</td></tr><tr><th>Physician Name:</th><td>".$drName."</td></tr>";
                            
			} else {
				// Dont do anything.
			} // There is a queryString.
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>
</table>
</div>
    <div id="warning">
    Warning: The above interchange is based solely on the formulary<br />
    contracted with the facility.  All medication changes should <br />
    be patient specific and based on the clinical judgment of the<br />
    prescribing physician and other members of the health care team.
    </div>
    <div id="noprint">
        <h3>Please verify above information before printing.</h3>
        <h3><a href="printchange.php" onclick="return printnow()">Print Interchange Sheet</a></h3><br />
        <h3><a href="interchange.php">Return to Interchange Drug Search</a></h3>
    </div>
</body>
</html>