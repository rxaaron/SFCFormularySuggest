<?php
    if(!isset($_POST["oldpwd1"])){
        header("Location: administration.php");
    }else{
        session_start();
        $oldpwd1 = $_POST["oldpwd1"];
        $oldpwd2 = $_POST["oldpwd2"];
        $newpwd = $_POST["newpwd"];
        $uid = $_SESSION["uid"];
        
        if($oldpwd1!=$oldpwd2){
            echo "<html><body><br />The old passwords did not match.</body></html>";
        }else{
            include_once('nogit/dbconn.php');
            if(!$db) {
                // Show error if we cannot connect.
                echo 'ERROR: Could not connect to the database.';
             } else {
                $query = $db->query("SELECT RealName, Passwd, Pepper, Email FROM tblUser WHERE ID = '".$uid."';");
        
                if ($query->num_rows>0){
                    $result=$query->fetch_object();
                    $passhash= $result->Passwd;
                    $salt = $result->Pepper;
                    $realname=$result->RealName;
                    $email=$result->Email;
                    $enteredpasshash = hash("sha256",$oldpwd1.$salt);
                    if ($enteredpasshash == $passhash){
                        $newsalt = substr(md5(rand()),0,7);
                        $newpasshash = hash("sha256",$newpwd.$newsalt);
                        $updatepass = $db->query("UPDATE tblUser SET Passwd = '".$newpasshash."', Pepper = '".$newsalt."' WHERE ID = '".$uid."';");
                        if ($updatepass){
                            $message = $realname.":\r\n\r\nYour password was changed at your request.";
                            $subject="Password Change";
                            mail($email,$subject,$message);
                            echo "<html><body><br />Password changed.<br /><br /><a href=\"administration.php\">Return</a>";
                        }else{
                            echo "<html><body><br />Why didn't it work?</body></html>";
                        }   
                    }else{
                        echo "<html><body><br />The password is incorrect.</body></html>";
                    }
                }
            }
        }
    }
?>
