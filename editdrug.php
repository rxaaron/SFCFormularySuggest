<?php

	    session_start();
		if(!isset($_SESSION["uid"])){
			echo "<a href=\"administration.php\">Please Log In.</a>";
		}else{
			$mysqli = new mysqli("localhost","root","udd6zjat","formularysuggest");
        
			if (mysqli_connect_errno()){
				printf("Connection failed: %s\n", mysqli_connect_error());
				exit();
			}else{
				$newsql = "SELECT ID, BrandName, GenericName, Strength FROM tblDrugs ORDER BY BrandName, Strength;";
				$newres = mysqli_query($mysqli, $newsql);
			
				if ($newres){
					echo "<table><colgroup><col class=\"brand\"><col class=\"generic\"><col class=\"strength\"></colgroup><tr><th>Brand Name</th><th>Generic Name</th><th>Strength</th></tr>";
				
					while ($otherArray = mysqli_fetch_array($newres,MYSQLI_ASSOC)){
						$ID=$otherArray["ID"];
						$BN=$otherArray["BrandName"];
						$GN=$otherArray["GenericName"];
						$STR=$otherArray["Strength"];
				
						echo "<tr><td><a href=\"drugproperties?id=".$ID."\">".$BN."</a></td><td>".$GN."</td><td>".$STR."</td></tr>";
					}
					echo "</table>";
				}    
			}
		}
        mysqli_close($mysqli);
        
?>