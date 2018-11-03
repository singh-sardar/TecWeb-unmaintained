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
    <?php
        require_once "header.php";
        require_once "loginModal.php";
        require_once "signUpModal.php";
        require_once "editProfileModal.php";
        require_once "DbConnector.php";
        require_once "functions.php";
        require_once "searchModal.php";
    ?>
    <div class="gallery">
        <?php $mostraPagination=FALSE; $j=0;?>
        <ul class="clearfix galleryBoard">
            <?php
                if(isset($_SESSION["Username"])){
                    //connecting to db
                    $myDb= new DbConnector();
                    $myDb->openDBConnection();
                    $result = array();
                    if($myDb->connected){
                        $qrStr = "SELECT Nome,Artista FROM opere WHERE Artista='".$_SESSION['Username']."'";
                        $result = $myDb->doQuery($qrStr);
                    }
                    else 
                        echo "Errore connessione";
                    $myDb->disconnect();

                    if($result && ($result->num_rows > 0)){
                        $mostraPagination = ($result->num_rows <= 8) ? false : true;
                        $j = printGalleryItems($result,TRUE);
                    }elseif(!$result || ($result->num_rows == 0)){
                        echo "<div class='div-center'><p>Nothing to show here ... </p></div>";
                    }
                }
            ?>
            
        </ul> 
        <?php
        echo "<script>populateImages();</script>";
        if($mostraPagination == TRUE && ($j > 2)){
            printDivPagination($j);
            echo "<script>btnPaginationOnClick('btnPagination1');</script>";
        }
        ?>
    </div>
</body>
</html>