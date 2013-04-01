<?php
    session_start();
    if(!isset($_SESSION["uid"])){
        echo "<a href=\"administration.php\">Please Log In.</a>";
    }else{
        if(isset($_POST['active'])){
            $active="TRUE";
        }else{
            $active="FALSE";
        }
        if(isset($_POST['springfield'])){
            $springfield="TRUE";
        }else{
            $springfield="FALSE";
        }
        
        $db = new mysqli("localhost", "root" ,"udd6zjat", "formularysuggest");
	
	if(!$db) {
            // Show error if we cannot connect.
            echo 'ERROR: Could not connect to the database.';
	} else {
            if($_POST['interchange']!=0){
                $updatequery = $db->query("UPDATE tblDrugs SET BrandName='".$_POST['brandname']."', GenericName='".$_POST['genericname']."', Strength='".$_POST['strength']."', Active=".$active.", Category=".$_POST['category'].", Springfield=".$springfield." WHERE ID=".$_POST['ID'].";");
            }else{
                $updatequery = $db->query("UPDATE tblDrugs SET BrandName='".$_POST['brandname']."', GenericName='".$_POST['genericname']."', Strength='".$_POST['strength']."', Active=".$active.", Category=".$_POST['category'].", InterchangeKey=".$_POST['interchange'].", Springfield=".$springfield." WHERE ID=".$_POST['ID'].";");
            }
            if($updatequery){
                echo "<html><body><br />Drug Updated.<br /><br /><a href=\"drugproperties.php?id=".$_POST['id'].">Return</a>";
            }
        } 
    }
?>