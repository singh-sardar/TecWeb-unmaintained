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
</head>

<body onload="eventListnerforLoginModal()" >
  <?php $conn = new mysqli("localhost", "root", "","tecweb"); //Create connection to the tecweb database
	require_once "header.php";
	require_once "loginModal.php";
  ?>

  <div class="description"><!--general description-->
      <div class="overlay font_medium">
        <p>
          Everything around us is the result of the unlimited combinations of colors we
          have been given by our Universe. We not only paint them in order to express our creativity but also to
          trasmit our emotions and feelings so we can say that art represents human being essence.
        </p>
    </div>
  </div>
  <div class="section"><!--top rated-->
    <div class="title">Top rated</div>
    <?php
    $result = $conn->query("SELECT Nome, Artista, COUNT(Nome) as Likes FROM opere JOIN likes on Nome=Opera and Artista=Creatore
                            GROUP BY Nome, Artista ORDER BY COUNT(Nome) DESC LIMIT 5");
    $nome=array($result->num_rows);
    $artista=array($result->num_rows);
    $likes=array($result->num_rows);
    for ($i = 0; $i < $result->num_rows; $i++) {
      $row = $result->fetch_assoc();
      $nome[$i] = $row["Nome"];
      $artista[$i] = $row["Artista"];
      $likes[$i] = $row["Likes"];
      echo "<div class='home_picture'>";
      echo "<img src='Images/Art/$artista[$i]/$nome[$i].png' alt='Top rated images'>";
      echo "<h2>$nome[$i]</h2>";
      echo "<p>$artista[$i]</p>";
      echo "<p>Likes: $likes[$i]</p>";
      echo "</div>";
    }
    ?>
  </div>
  <div class="section" id="intro"><!--website Introduction-->
    <div class="title">Introduction</div>
    <p>
      This website is a collection of digital artworks, everyone can upload his own masterpieces
      sharing them with the world and get popularity.
    </p>
    <div class="statistics">
      <?php
      $result = $conn->query("SELECT COUNT(*) as tot_opere FROM opere");
      $row = $result->fetch_assoc();
      $tot_opere = $row["tot_opere"];
      $result = $conn->query("SELECT COUNT(Username) as tot_artisti FROM artisti");
      $row = $result->fetch_assoc();
      $tot_artisti = $row["tot_artisti"];
      $result = $conn->query("SELECT COUNT(*) as tot_likes FROM likes");
      $row = $result->fetch_assoc();
      $tot_likes = $row["tot_likes"];
      ?>
      <p>Registered artworks: <?php echo $tot_opere ?></p>
      <p>Registered painters: <?php echo $tot_artisti ?></p>
      <p>Total likes: <?php echo $tot_likes ?></p>
    </div>
  </div>
  <div class="section" id="team"><!--team-->
    <div class="title">Team</div>
    <div class="teamMember">
      <div class="face"></div>
      <h2>Davide Liu</h2>
      <p>Software Engineer</p>
    </div>
    <div class="teamMember">
      <div class="face"></div>
      <h2>Davide Liu</h2>
      <p>Software Engineer</p>
    </div>
    <div class="teamMember">
      <div class="face"></div>
      <h2>Davide Liu</h2>
      <p>Software Engineer</p>
    </div>
    <div class="teamMember">
      <div class="face"></div>
      <h2>Davide Liu</h2>
      <p>Software Engineer</p>
    </div>
  </div>
  <div class="footer">
    <p>Artbit</p>
  </div>
</body>
</html>
