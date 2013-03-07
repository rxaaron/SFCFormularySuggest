<?php
        $mysqli = new mysqli("localhost","root","udd6zjat","formularysuggest");
        
        if (mysqli_connect_errno()){
            printf("Connection failed: %s\n", mysqli_connect_error());
            exit();
        }else{
			$newsql = "SELECT ID, CategoryName FROM tblCategory WHERE Active = true;";
			$newres = mysqli_query($mysqli, $newsql);
			
			if ($newres){
				
				
				while ($otherArray = mysqli_fetch_array($newres,MYSQLI_ASSOC)){
					$CID=$otherArray["ID"];
					$CN=$otherArray["CategoryName"];
					echo "<a name=\"C".$CID."\"><h2 style=\"text-align:center;\">".$CN."</h2></a>";
					
					$sql = "SELECT BrandName, GenericName, Strength FROM tblDrugs WHERE Springfield = true AND Category = ".$CID." ORDER BY BrandName, Strength";
					$res = mysqli_query($mysqli, $sql);
					if ($res){
                
						echo "<table><colgroup><col class=\"brand\"><col class=\"generic\"><col class=\"strength\"></colgroup><tr><th>Brand Name</th><th>Generic Name</th><th>Strength</th></tr>";
						$c=true;
						while ($newArray = mysqli_fetch_array($res,MYSQLI_ASSOC)){
							
							$BN = $newArray["BrandName"];
							$GN=$newArray["GenericName"];
							$STR=$newArray["Strength"];
							$LN=str_replace("/", " / ", $GN);
							echo "<tr ".(($c=!$c)?'class="even"':'class="odd"')."><td>".$BN."</td><td>".$LN."</td><td>".$STR."</td></tr>";
						}
						echo "</table>";
					}
				}
				
            }    
        }
        mysqli_close($mysqli);
        
?>