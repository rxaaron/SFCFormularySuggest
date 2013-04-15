<?php

	    session_start();
		if(!isset($_SESSION["uid"])){
			echo "<a href=\"administration.php\">Please Log In.</a>";
		}else{
			include_once('nogit/dbconn.php');
        
			if (!$db){
                            echo 'ERROR';
			}else{
				$query = $db->query("SELECT ID, BrandName, GenericName, Strength FROM tblDrugs ORDER BY BrandName, Strength;");
				
			
				if ($query){
					echo "<table><colgroup><col class=\"brand\"><col class=\"generic\"><col class=\"strength\"></colgroup><tr><th>Brand Name</th><th>Generic Name</th><th>Strength</th></tr>";
				
					while ($result=$query->fetch_object()){
						$ID=$result->ID;
						$BN=$result->BrandName;
						$GN=$result->GenericName;
						$STR=$result->Strength;
				
						echo "<tr><td><a href=\"drugproperties.php?id=".$ID."\">".$BN."</a></td><td>".$GN."</td><td>".$STR."</td></tr>";
					}
					echo "</table>";
				}    
			}
		}
        mysqli_close($db);
        
?>