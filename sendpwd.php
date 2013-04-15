<?php
    if(!isset($_POST["uname"])){
        header("Location: administration.php");
    }else{
        include_once('nogit/dbconn.php');
        if (!$db){
            echo "Connection error.  Please try again.";
        }else{
            $uname = $_POST["uname"];
            $query = $db->query("SELECT ID, RealName, Email FROM tblUser WHERE UName = '".$uname."' AND Active=true;");
            if ($query->num_rows > 0){
                $result=$query->fetch_object();
                $email = $result->Email;
                $realname = $result->RealName;
                $newpass = substr(md5(rand()),0,10);
                $subject = "New Password";
                $message = $realname.": \r\n \r\nYour new password will be: \r\n".$newpass."\r\n \r\nPlease copy and paste this password into the site.";
                mail($email,$subject,$message);
                $salt = substr(md5(rand()),0,7);
                $newpasshash = hash("sha256",$newpass.$salt);
                $updatepass = $db->query("UPDATE tblUser SET Passwd = '".$newpasshash."', Pepper = '".$salt."' WHERE UName = '".$uname."';");
                header("Location: administration.php");
            }else{
                echo "<html><body>Invalid username.</body></html>";
            }
        }
    }
?>