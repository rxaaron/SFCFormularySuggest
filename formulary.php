<?php
        include_once('nogit/dbconn.php');
        
        if (!$db){
            echo 'ERROR';
        }else{
			$query =$db->query("SELECT ID, CategoryName FROM tblCategory WHERE Active = true;");

			if ($query){
				
				
				while ($result=$query->fetch_object()){
					$CID=$result->ID;
					$CN=$result->CategoryName;
					echo "<a name=\"C".$CID."\"><h2 style=\"text-align:center;\">".$CN."</h2></a>";
					
					$sql =$db->query("SELECT BrandName, GenericName, Strength FROM tblDrugs WHERE Springfield = true AND Category = ".$CID." ORDER BY BrandName, Strength");
					if ($sql){
                
						echo "<table><colgroup><col class=\"brand\"><col class=\"generic\"><col class=\"strength\"></colgroup><tr><th>Brand Name</th><th>Generic Name</th><th>Strength</th></tr>";
						$c=true;
						while ($res=$sql->fetch_object()){
							
							$BN = $res->BrandName;
							$GN=$res->GenericName;
							$STR=$res->Strength;
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