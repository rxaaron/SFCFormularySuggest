<?php
    if(!isset($_POST["pwd"])){
        header("Location: administration.php");
    }
    
    session_start();
    
    $login = $_POST["uname"];
    $pwd = $_POST["pwd"];
    
    $db = new mysqli("localhost", "root" ,"udd6zjat", "formularysuggest");
    if(!$db) {
	// Show error if we cannot connect.
	echo 'ERROR: Could not connect to the database.';
    } else {
        $query = $db->query("SELECT ID, RealName, Passwd, Pepper, Admin FROM tblUser WHERE UName = '".$login."' AND Active=true;");
        
        if ($query){
            $result=$query->fetch_object();
            $passhash= $result->Passwd;
            $salt = $result->Pepper;
            $uid = $result->ID;
            $realname=$result->RealName;
            $admin=$result->Admin;
            $enteredpasshash = hash("sha256",$pwd.$salt);
            if ($enteredpasshash == $passhash){
                $_SESSION["failed"]=0;
                $_SESSION["uid"]=$uid;
                $_SESSION["realname"]=$realname;
                $_SESSION["isadmin"]=$admin;
            }else{
                $_SESSION["failed"]+=1;
                echo "Passhash:".$passhash.$salt.$uid.$realname."<br>Enteredhash:".$enteredpasshash;
            }
        }else{
            $_SESSION["failed"]+=1;
        }
    }
    header("Location: administration.php");
?>
