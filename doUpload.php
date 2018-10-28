<?php
	require_once "DbConnector.php";
	session_start();
	$title= htmlspecialchars($_POST["title"], ENT_QUOTES, "UTF-8");
	$category= htmlspecialchars($_POST["category"], ENT_QUOTES, "UTF-8");
	$description= htmlspecialchars($_POST["description"], ENT_QUOTES, "UTF-8");
	$filename = $_FILES['artwork']['name'];
	$filetmp = $_FILES['artwork']['tmp_name'];
	$time = date('Y-m-d h:i:s');
	//connecting to db
	$myDb= new DbConnector();
	$myDb->openDBConnection();
	if($_FILES['artwork']['size']>10000000)
	  echo 'File size is too big!';
	else{
		if($myDb->connected){
			//check if title already exists
			$result = $myDb->doQuery("select Nome from Opere where Nome='".$title."' and Artista='".$_SESSION["Username"]."'");
			if($result->fetch_assoc())
				echo 'You have already uploaded an artwork with this name';
			else{
				//store compressed image
				$destination_img = "Images/Art/".$_SESSION["Username"]."/".strstr($filename,".",true).".jpeg";
				$d = compress($filetmp, $destination_img, 80);
				//update database
				$username = $_SESSION["Username"];
				$result = $myDb->doQuery("insert into Opere values ('$title','$description','$time','$username','$category')");
				echo 'Update successfully';
			}
			$myDb->disconnect();
		}
		else
			echo 'Connection error';
	}

function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/jpg')
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}
?>
