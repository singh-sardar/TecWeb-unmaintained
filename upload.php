<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html, charset=utf-8" />
  <meta name="description" content="Online artwork database"/>
  <meta name="keywords" content="artwork,picture,image,database"/>
  <meta name="author" content="Daniele Bianchin, Pardeep Singh, Davide Liu, Harwinder Singh"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="Style/style.css"/>
  <link rel="stylesheet" href="Style/upload_style.css"/>
  <title>Artbit</title>
</head>

<body>
  <?php
  require_once "header.php";
  require_once "loginModal.php";
  require_once "searchModal.php";
  require_once "signUpModal.php";
  require_once "editProfileModal.php";
  ?>
  <div class="section"><!--upload form-->
    <title><h1>Register your artwork</h1></title>
    <form action="doUpload.php" method="post" enctype="multipart/form-data">

        <label>Title:</label>
        <input type="text" placeholder="Title" name="title" maxlength="20" required="">

        <label>Category:</label>
        <select name="category">
          <option value="landscape">Landscape</option>
          <option value="fantasy">Fantasy</option>
          <option value="abstract">Abstract</option>
          <option value="cartoon">Cartoon</option>
          <option value="portrait">Portrait</option>
          <option value="nature">Nature</option>
          <option value="others">Others</option>
        </select>

        <label>Description:</label>
        <textarea type="text" name="description" maxlength="300" placeholder="Description"></textarea>

        <label>Artwork:</label>
        <input type="file" name="artwork" accept=".png, .jpg, .jpeg" required=""/>

        <button type="submit">Upload</button>
      </form>
  </div>
</body>
</html>
