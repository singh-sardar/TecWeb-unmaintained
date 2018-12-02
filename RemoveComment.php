<?php
	require_once "DbConnector.php";
	session_start();
    
	$ID = $_POST['ID'];
	if(!isset($_SESSION['Username'])) {
    	echo '<script>alert(\'Login before!\');</script>';
        exit(0);
    }
	$qrstr = "SELECT ID FROM commenti WHERE ID=".$ID." AND Creatore='".$_SESSION['Username']."'";
    $myDb= new DbConnector();
    $myDb->openDBConnection();
    if(!$myDb->connected) {
        echo '<script>alert(\'Database problem!\');</script>';
        exit(0);
    }
    if(!$myDb->doQuery($qrstr)) {
    	echo '<script>alert(\'Artwork not found or wrong artwork owner\');</script>';
        exit(0);
    }
    $qrstr = "DELETE FROM `my_artbit`.`commenti` WHERE `commenti`.`ID`=".$ID;
    $myDb->doQuery($qrstr);
?>