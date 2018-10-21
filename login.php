<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">

	<head>
		<meta http-equiv="Content-Type" content="text/html, charset=utf-8" />
		<meta name="description" content="Online artwork database"/>
		<meta name="keywords" content="artwork,picture,image,database"/>
		<meta name="author" content="Daniele Bianchin, Pardeep Singh, Davide Liu, Harwinder Singh"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" href="Style/style.css"/>
		<title>Artbit</title>
		<script type="text/javascript" src="script.js" ></script>

	</head>
	<body onload="eventListnerforLoginModal()">
	
	
		<?php //Questa è una funzioncina per fare login e log out
		session_start();
		if(isset($_SESSION["isLogged"])&&$_SESSION["isLogged"]=="true"){
			echo '<button onclick="doLogOut()" >Log Out '.$_SESSION["Username"].'</button>';
			
		}else
		{
			echo '<button onclick="openLoginModal()">Login</button>';
		}
			
		?>

		
		<!-- The Modal -->
		<div id="LoginModal" class="loginModal">
			<!-- Modal Content -->
			<form class="loginModal-content animate" method="post" action="" onsubmit="return doLogin(event)">
				<div class="loginHead">
					<span onclick="closeLoginModal()" class="close" title="Close Modal">&times;</span>
					<h1>LOGIN FORM</h1>
				</div>
				<div class="container">
					<label for="uname"><b>Username</b></label>
					<input id="usr" type="text" placeholder="Enter Username" name="uname" required>

					<label for="psw"><b>Password</b></label>
					<input id="pwd" type="password" placeholder="Enter Password" name="psw" required>

				</div>
				<div class="container" id="InvalidLogin">
					<!--container for invalid login message-->
					
				</div>
				
				<div class="container loginFotter" >
					<button type="submit">Login</button>
					<button type="button" onclick="closeLoginModal()" class="cancelbtn">Cancel</button>
				</div>

			</form>
		</div>
	<script>
		
	</script>
	</body>
</html>

