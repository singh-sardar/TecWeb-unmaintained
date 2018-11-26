<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <head>
      <meta http-equiv="Content-Type" content="text/html, charset=utf-8" />
      <meta name="description" content="Online artwork database"/>
      <meta name="keywords" content="artwork,picture,image,database"/>
      <meta name="author" content="Daniele Bianchin, Pardeep Singh, Davide Liu, Harwinder Singh"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link rel="stylesheet" href="Style/style.css"/>
      <link rel="stylesheet" href="viewStyle.css"/>
      <script type="text/javascript" src="script.js" ></script>
      <script type="text/javascript" src="imagezoom.js" ></script>
      <script type="text/javascript" src="ajaxComment.js" ></script>
      <title>Artbit</title>
    </head>
    <body onload="eventListnerforLoginModal()">
    
    <?php
      require_once "header.php";
      require_once "loginModal.php";
      require_once "searchModal.php";
      require_once "signUpModal.php";
      require_once "editProfileModal.php";
      require_once "DbConnector.php";
      
      $Title = $_GET['Title'];
      $Artist = $_GET['Artist'];
      $Description = '';

      $myDb= new DbConnector();
      $myDb->openDBConnection();
      if($myDb->connected)
      {
       if(isset($Title) && isset($Artist))
       {
        $qrStr = 'SELECT Artista, Nome, Descrizione FROM opere WHERE Artista ="'.$Artist.'"'.' AND Nome ="'.$Title.'"';
        $result = $myDb->doQuery($qrStr);
        if(isset($result) && ($result->num_rows === 1))
        {
          $row = $result->fetch_assoc();
          $Title = $row['Nome'];
          $Artist = $row['Artista'];
          $Description = $row['Descrizione'];
        }
        else
           echo "<script> window.location.replace('404.php') </script>";
       }
       else
         echo "<script> window.location.replace('index.php') </script>";
      }
      else
        echo '<script>alert(\'Database problem!\');</script>';
    ?>
    <h1 id="artworkTitle"><?php echo $Title; ?></h1>
    <div id="imageAndCommentSection">
    	<div id="imageContainer">
        	<div class="img-magnifier-glass" id="glass"></div>
    		<img id="myimage" src=<?php echo "'Images/Art/".$Artist."/".$Title.".jpeg'";?>  onload="magnify('myimage', 3)" alt=<?php echo '"'.$Title.'"' ?> >
        </div>
    	<div id="description-comment-wrapper">
        <div id="description-comments">
        <div class="commentator">Description</div>
        <div id="main-description"><?php echo $Description; ?></div>
        <div ><?php echo ' <div class="commentator">by <a href="gallery.php?gallerySearch='.$Artist.'">'.$Artist.'</a></div>' ?></div>
        </div>
        <div id="commentSection">
        <div class="comment">
        <div class="commentator">
        <?php
        	if($myDb->connected && isset($_SESSION['Username']))
            	echo $_SESSION['Username'];
            else
            	echo "Login to comment."
         ?>
         </div>
         <?php
         	$en = !isset($_SESSION['Username']) ? "disabled=\"disabled\"" : "";
         ?>
         <textarea name="input-comment" id="texxt" <?php echo  $en?>> </textarea>
    	<?php
        	echo '<input type="button" value="comment" id="comment-btn" onclick="doComment(\''.$Title.'\',\''.$Artist.'\')" '.$en.'></div>';
        ?>
        <?php
            if($myDb->connected)
            {
              $qrStr = 'SELECT Commento, Utente FROM commenti WHERE Opera ="'.$Title.'"';
              $result = $myDb->doQuery($qrStr);
              if(isset($result) && ($result->num_rows > 0))
              {
                while($row = $result->fetch_assoc())
                {
                  echo '<div class="comment">';
                  echo '  <div class="commentator"><a href="gallery.php?gallerySearch='.$row['Utente'].'">'.$row['Utente'].'</a></div>';
                  echo $row['Commento']."</div>";
                }
              }
            }
          ?>
      </div>
      </div>
      </div>
    <div class="footer">
        <p>Artbit</p>
    </div>
    </div>
    </body>