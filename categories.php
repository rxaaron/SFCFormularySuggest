<?php
	$mysqli = new mysqli("localhost","root","gmaprcb1","formularysuggest");
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
						echo "<a href=\"#C".$CID."\" id=\"".$CID."\">".$CN."</a>";
					}
      }    
    }
        mysqli_close($mysqli);
        
?>