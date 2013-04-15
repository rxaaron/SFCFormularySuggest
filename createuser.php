<?php
    session_start();
    if(!isset($_SESSION["uid"])){
        header("Location: administration.php");
    }else{
        include_once('nogit/dbconn.php');
        if(!$db) {
            // Show error if we cannot connect.
            echo 'ERROR: Could not connect to the database.';
        } else {
            $uname = $_POST["uname"];
            $pwd = $_POST["pwd"];
            $real = $_POST["realname"];
            $email=$_POST["email"];
            $salt = substr(md5(rand()),0,7);
            $enteredpasshash = hash("sha256",$pwd.$salt);
            $newuser = $db->query("INSERT INTO tblUser (RealName, UName, Passwd, Pepper, Admin, Email) VALUES ('".$real."','".$uname."','".$enteredpasshash."','".$salt."',0,'".$email."');");
        
            if($newuser){
                $subject="Encore Formulary Program";
                $message= $real.":\r\n\r\nYour username and password have been created for the Encore Formulary Program.\r\n\r\nUsername: ".$uname."\r\nPassword: ".$pwd."\r\n\r\nPlease log in and change your password.";
                mail($email,$subject,$message);
                echo "<html><body><br />User created.<br /><br /><a href=\"administration.php\">Return</a>";
            }
        } 
    }
?>
