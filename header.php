<div class="menu font_medium"><!--menu-->
<img class="logo" src="./Images/logo.png" alt="Art Bit"/>
  <ul>

    <li>
    <?php //Questa è una funzioncina per fare login e log out
    	session_start();
    	if(isset($_SESSION["isLogged"])&&$_SESSION["isLogged"]=="true"){
    		echo '<button onclick="doLogOut()" >Log Out '.$_SESSION["Username"].'</button>';

    	}else
    	{
    		echo '<button onclick="openLoginModal()">Login</button>';
    	}
    ?>
    </li>
	<li>
    <?php //To Sign in or edit profile of User
    	if(isset($_SESSION["isLogged"])&&$_SESSION["isLogged"]=="true"){
			echo '<button onclick="openEditProfileModal()">Edit Profile</button>';

    	}else
    	{
			echo '<button onclick="openSignUpModal()" >Sign Up</button>';
    	}
    ?>
    </li>
	<li><a href="#">Upload</a></li>
	<li><a href="#team">Team</a></li>
	<li><a href="#intro">Services</a></li>
	<li><a href="#">Gallery</a></li>
	<li><a href="#">Home</a></li>



  
  </ul>
</div>
