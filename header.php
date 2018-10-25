<link rel="stylesheet" href="Style/icons.css">

<html>
<body>
<div class="menu" id="Topnav">
  <img src="Images/logo.png" alt="Logo"/>
  <ul>
    <li><a href="home.php">Home</a></li>
    <li><a href="home.php#intro">Services</a></li>
    <li><a href="home.php#team">Team</a></li>
    <li><a href="gallery.php">Gallery</a></li>
    <li><a href="#">Upload</a></li>
    <li>
    <?php //Questa è una funzioncina per fare login e log out
      session_start();
      if(isset($_SESSION["isLogged"])&&$_SESSION["isLogged"]=="true"){
        echo '<a href="#" onclick="doLogOut()" >Log Out '.$_SESSION["Username"].'</a>';

      }else
      {
        echo '<a href="#" onclick="openLoginModal()">Login</a>';
      }
    ?>
    </li>
    <li>
      <?php //To Sign in or edit profile of User
        if(isset($_SESSION["isLogged"])&&$_SESSION["isLogged"]=="true"){
        echo '<a href="#" onclick="openEditProfileModal()">Edit Profile</a>';

        }else
        {
        echo '<a href="#" onclick="openSignUpModal()" >Sign Up</a>';
        }
      ?>
    </li>
    <li class="hamburgerMenu">
      <a href="#" onclick="openDrobDownMenu()"><div class="fa fa-bars"></div></a>
    </li>
  </ul>
</div>

</body>
</html>
