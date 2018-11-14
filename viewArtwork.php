<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html, charset=utf-8" />
  <meta name="description" content="Online artwork database"/>
  <meta name="keywords" content="artwork,picture,image,database"/>
  <meta name="author" content="Daniele Bianchin, Pardeep Singh, Davide Liu, Harwinder Singh"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="Style/style.css"/>
	<script type="text/javascript" src="script.js" ></script>
  <title>Artbit</title>
  <style>
.imageAndComments img {
    max-width: 70%;
    float: left;
    max-height: 35em;
}

.imageAndComments {
    padding: 1em;
    overflow: auto;
}

.commentSection {
	background-color: #8080801a;
	max-width: 27%;
	overflow-y: auto;	
	margin-left: 2%;
    padding: 1em;
    max-height: 35em;
}

.comment{
	word-wrap: break-word;
    background-color: #8080801a;
	border-radius: 2px;
	padding: 0.4em;
    margin: 0.4em;

}

.marginAuto{
	margin:auto;
    display: flex;

}

.artworkTitle{
	text-align:center;
    margin-top: 2em;
}

.descrizioneTesto{
padding: 2em;
background-color: #8080804d;
word-wrap: break-word;
margin-bottom: 2%;
}

@media screen and (max-width: 1024px) {
.commentSection {
	max-width: 100%;
	overflow-y: auto;	
	margin-left: 0%;
    padding: 1em;

}
  .imageAndComments img {
    max-width: 100%;
    max-height: 35em;
}
}
  </style>
</head>

<body onload="eventListnerforLoginModal()" >
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
    $qrStr = 'SELECT Artista, Nome, Descrizione FROM opere WHERE Artista = $Artist AND Nome = $Title';
    $result = $myDb->doQuery($qrStr);
    if($result && ($result->num_rows === 1))
    {
      $row = $result->fetch_assoc();
      $Title = $row['Artista'];
      $Artist = $row['Nome'];
      $Description = $row['Descrizione'];
    }
    else
      header('./404.php');
   }
   else
    header('./index.php');
  }
  else
    echo '<script>alert(\'Database problem!\');</script>';
  ?>
    <div class="container1024">
       <h1 class="artworkTitle">
          <?php echo $Title ?>
      </h1>

      <div class="imageAndComments">
      <div class="marginAuto">
        <?php $destination_img = "Images/Art/".$Artist."/".$Title.".jpeg"; ?>
        <img src=<?php echo "'".$destination_img."'"; ?> />
        <div class="commentSection">
        <?php
        if($myDb->connected)
        {
          $qrStr = 'SELECT Commento FROM commenti WHERE Opera = $Title';
          $result = $myDb->doQuery($qrStr);
          if(isset($result) && ($result->num_rows > 0))
          {
            while($row = $result->fetch_assoc())
            {
              echo '<div class="comment">'.htmlspecialchars($row['Commento'], ENT_QUOTES, "UTF-8")."</div>";
            }
          }
        }
        ?>
        </div>
        </div>
      </div>
       <div class="descrizioneTesto">
         	<?php echo $Description ?>
         </div>
    </div>
<div class="footer">
    <p>Artbit</p>
</div>
</body>
</html>
