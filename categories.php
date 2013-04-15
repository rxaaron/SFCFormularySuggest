<?php
	include_once('nogit/dbconn.php');
		if (!$db){
                    echo 'ERROR';
   }else{
				$newsql = $db->query("SELECT ID, CategoryName FROM tblCategory WHERE Active = true;");
							
				if ($newsql){
				
				
					while ($newres = $newsql->fetch_object()){
						$CID=$newres->ID;
						$CN=$newres->CategoryName;
						echo "<a href=\"#C".$CID."\" id=\"".$CID."\">".$CN."</a>";
					}
      }    
    }
       
?>