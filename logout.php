<?php
    session_start();
    session_unset();
    session_destroy();
    
    $page = $_GET["pageurl"].".php";
    header("Location: ".$page);
?>