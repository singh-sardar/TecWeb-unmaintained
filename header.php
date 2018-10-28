<div class="menu" id="Topnav">
  <img src="Images/logo.png" alt="Logo"/>
  <ul>
    <li class="firstMenuItem"><a href="home.php">Home</a></li>
    <li><a href="home.php#team">Team</a></li>
    <li><a href="gallery.php">Gallery</a></li>
    <li>
      <?php //Se l'utente non è loggato allora la pagina upload porta al login
        session_start();
        if(isset($_SESSION["isLogged"])&&$_SESSION["isLogged"]=="true")
          echo '<a href="upload.php">Upload</a>';
        else
          echo '<a href="#" onclick="openLoginModal()">Upload</a>';
      ?>
    </li>
    <li>
      <?php
        //Se l'utente è loggato allora può vedere i suoi preferiti
        if(isset($_SESSION['isLogged']) && ($_SESSION['isLogged'] == "true")){
          echo '<a href="likedItems.php">Liked Images</a>';
        }
      ?>
    </li>
    <li>
    <?php //Questa è una funzioncina per fare login e log out
      if(isset($_SESSION["isLogged"])&&$_SESSION["isLogged"]=="true")
        echo '<a href="#" onclick="doLogOut()" >Log Out</a>';
    ?>
    </li>
    <li>
      <?php //To Sign in or edit profile of User
        if(isset($_SESSION["isLogged"])&&$_SESSION["isLogged"]=="true")
          echo '<a href="#" onclick="openEditProfileModal()">Edit Profile</a>';
        else
          echo '<a href="#" onclick="openSignUpModal()" >Sign Up</a>';
      ?>
    </li>
    <li class="username">
      <?php
        if(isset($_SESSION["isLogged"])&&$_SESSION["isLogged"]=="true")
          echo '<p>'.$_SESSION["Username"].'</p>';
        else
          echo '<a href="#" onclick="openLoginModal()">Login</a>';
      ?>
    </li>
    <li>
      <a class="btnSearch" href="#" onclick="openSearchModal()"><span class="searchIcon"></span></a>
    </li>
    <li class="hamburgerMenu">
        <a href="#" onclick="openDrobDownMenu(this)">
          <div class="line1"></div>
          <div class="line2"></div>
          <div class="line3"></div>
        </a>
    </li>
  </ul>
</div>
