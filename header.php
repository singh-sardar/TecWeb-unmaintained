<div class="menu font_medium"><!--menu-->
    <a href="#">Home</a>
    <a href="#">Gallery</a>
    <a href="#intro">Services</a>
    <a href="#team">Team</a>
    <a href="#">Upload</a>
   <!-- <a href="#">Login</a>-->
<?php //Questa è una funzioncina per fare login e log out
	session_start();
	if(isset($_SESSION["isLogged"])&&$_SESSION["isLogged"]=="true"){
		echo '<button onclick="doLogOut()" >Log Out '.$_SESSION["Username"].'</button>';
		
	}else
	{
		echo '<button onclick="openLoginModal()">Login</button>';
	}	
?>
  </div>