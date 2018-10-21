<?php
	require_once "DbConnector.php";
//pass per account admin AdminIsHere

	session_start();
	$pwd= htmlspecialchars($_POST["pwd"], ENT_QUOTES, "UTF-8");//cleaning the input
	$usr= htmlspecialchars($_POST["usr"], ENT_QUOTES, "UTF-8");
	$name= htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8");//cleaning the input
	$surname= htmlspecialchars($_POST["surname"], ENT_QUOTES, "UTF-8");
	$_SESSION["isLogged"] = "false";
	//connecting to db
	$myDb= new DbConnector();
	$myDb->openDBConnection();
	$pwd=password_hash($pwd,PASSWORD_BCRYPT);
	if($myDb->connected){
	
		$result = $myDb->doQuery("insert into artisti values ('$usr','$pwd','$name','$surname')");//excecute query
		if($result === TRUE){//if inserted

			echo "Success";
			$_SESSION["isLogged"] = "true";
			$_SESSION["Username"] = $usr;
			mkdir("./Images/Art/$usr", 0777, true);

			
		}else{
			echo 'Username already exists. Try another one';
		}
	}
	else 
		echo "Connection Error";
	$myDb->disconnect();
?>