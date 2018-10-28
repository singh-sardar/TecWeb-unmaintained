<div class="menu" id="Topnav">
  <img src="Images/logo.png" alt="Logo"/>
  <ul>
    <li class="firstMenuItem"><a href="home.php">Home</a></li>
    <li><a href="home.php#team">Team</a></li>
    <li><a href="gallery.php">Gallery</a></li>
    <li><a href="upload.php">Upload</a></li>
    <li>
      <?php
        session_start();
        //Se l'utente è loggato allora può vedere i suoi preferiti
        if(isset($_SESSION['isLogged']) && ($_SESSION['isLogged'] == "true")){
          echo '<a href="likedItems.php">Liked Images</a>';
        }
      ?>
    </li>
    <li class="user">
      <?php //To Sign in or edit profile of User
        if(isset($_SESSION["isLogged"])&&$_SESSION["isLogged"]=="true")
          echo '<a href="#" onclick="openEditProfileModal()">'.$_SESSION["Username"].'</a>';
        else
          echo '<a href="#" onclick="openSignUpModal()" >Sign Up</a>';
      ?>
    <li class="user">
      <?php
        if(isset($_SESSION["isLogged"])&&$_SESSION["isLogged"]=="true")
          echo '<a href="#" onclick="doLogOut()" >Log Out</a>';
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
