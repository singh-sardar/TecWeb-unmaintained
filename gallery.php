<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html, charset=utf-8" />
    <meta name="description" content="Online artwork database"/>
    <meta name="keywords" content="artwork,picture,image,database"/>
    <meta name="author" content="Daniele Bianchin, Pardeep Singh, Davide Liu, Harwinder Singh"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="Style/gallery_style.css"/>
    <link rel="stylesheet" href="Style/style.css"/>
    <script type="text/javascript" src="script.js" ></script>
    <script type="text/javascript" src="gallery_script.js"></script>
    <title>Artbit</title>
</head>

<body onload="eventListnerforLoginModal()" >
    <?php
        require_once "header.php";
        require_once "loginModal.php";
        require_once "signUpModal.php";
        require_once "editProfileModal.php";
        require_once "functions.php";
        require_once "DbConnector.php";
    ?>
    <div id="gallery">
        <form method="post" action="" name="formArtFilter">
            <div id="artFilter">
                <!--
                <div class="dropdown">
                    <button class="dropbtn" id="dropCat">Category</button>
                    <div class="dropdown-content">
                
                    </div>
                </div>
                <div class="dropdown">
                    <button class="dropbtn" id="dropAut">Artist</button>
                    <div class="dropdown-content">
                    
                    </div>
                </div>
                -->
                <div class="inputSearch">
                    <?php 
                        if(isset($_POST['gallerySearch']) && ($_POST['gallerySearch'] != '')){
                            echo '<input type="text" placeholder="Cerca per categoria, artista o descrizione .." name="gallerySearch" value="'.$_POST['gallerySearch'].'">';
                        }else{
                            echo '<input type="text" placeholder="Cerca per categoria, artista o descrizione .." name="gallerySearch">';
                        }
                    ?>
                    <button type="submit"><span class="searchIcon"></span></button>
                </div>
                <div class="divCategoryFilter">
                    <p>Categories</p>
                    <input type="hidden" id="type_id" name="type" value="">
                    <div class="divCategoryButtons" id="divCatBut">
                        <button type="submit" name="galleryCategory" onclick="galCatOnClick()" value="All" <?php if(isset($_POST['galleryCategory']) && $_POST['galleryCategory']=='All'){echo "class='active'";} ?> ">All</button>
                        <button type="submit" name="galleryCategory" onclick="galCatOnClick()" value="Landscape" <?php if(isset($_POST['galleryCategory']) && $_POST['galleryCategory']=='Landscape'){echo "class='active'";} ?>>Landscape</button>
                        <button type="submit" name="galleryCategory" onclick="galCatOnClick()" value="Fantasy" <?php if(isset($_POST['galleryCategory']) && $_POST['galleryCategory']=='Fantasy'){echo "class='active'";} ?>>Fantasy</button>
                        <button type="submit" name="galleryCategory" onclick="galCatOnClick()" value="Abstract" <?php if(isset($_POST['galleryCategory']) && $_POST['galleryCategory']=='Abstract'){echo "class='active'";} ?>>Abstract</button>
                        <button type="submit" name="galleryCategory" onclick="galCatOnClick()" value="Cartoon" <?php if(isset($_POST['galleryCategory']) && $_POST['galleryCategory']=='Cartoon'){echo "class='active'";} ?>>Cartoon</button>
                        <button type="submit" name="galleryCategory" onclick="galCatOnClick()" value="Portrait" <?php if(isset($_POST['galleryCategory']) && $_POST['galleryCategory']=='Portrait'){echo "class='active'";} ?>>Portrait</button>
                        <button type="submit" name="galleryCategory" onclick="galCatOnClick()" value="Nature" <?php if(isset($_POST['galleryCategory']) && $_POST['galleryCategory']=='Nature'){echo "class='active'";} ?>>Nature</button>
                        <button type="submit" name="galleryCategory" onclick="galCatOnClick()" value="Others" <?php if(isset($_POST['galleryCategory']) && $_POST['galleryCategory']=='Others'){echo "class='active'";} ?>>Others</button>
                    </div>
                </div>

            </div>
        </form>
        
        <ul class="clearfix" id="galleryBoard">
            <?php
                if(isset($_POST["gallerySearch"]) && ($_POST['gallerySearch'] != '')){
                    //connecting to db
                    $myDb= new DbConnector();
                    $myDb->openDBConnection();
                    $param = htmlspecialchars($_POST["gallerySearch"], ENT_QUOTES, "UTF-8");//cleaning the input
                    $result = array();
                    if($myDb->connected){
                        $qrStr = "SELECT Artista,Nome, Descrizione FROM Opere WHERE Descrizione LIKE '%".$param."%' OR Categoria LIKE '%".$param."%' OR Artista LIKE '%".$param."%'";
                        $result = $myDb->doQuery($qrStr);
                    }
                    else 
                        echo "Errore connessione";
                    $myDb->disconnect();

                    if($result){
                        for ($i = 0; $i < $result->num_rows; $i++) {
                            $row = $result->fetch_assoc();
                            insertImageInGallery($row['Artista'],$row['Nome'],$row['Descrizione']);
                        }
                    }
                }elseif(isset($_POST['galleryCategory']) && ($_POST['galleryCategory'] != '')){
                    //connecting to db
                    $myDb= new DbConnector();
                    $myDb->openDBConnection();
                    $param = htmlspecialchars($_POST["galleryCategory"], ENT_QUOTES, "UTF-8");//cleaning the input
                    $result = array();
                    if($myDb->connected){
                        
                        if($param == 'All'){
                            $qrStr = "SELECT Artista,Nome,Descrizione FROM Opere;";
                        }else{
                            $qrStr = "SELECT Artista,Nome,Descrizione FROM Opere WHERE Categoria='".$param."'";
                        }
                        $result = $myDb->doQuery($qrStr);
                    }
                    else 
                        echo "Errore connessione";
                    $myDb->disconnect();

                    if($result){
                        for ($i = 0; $i < $result->num_rows; $i++) {
                            $row = $result->fetch_assoc();
                            insertImageInGallery($row['Artista'],$row['Nome'],$row['Descrizione']);
                        }
                    }
                }
            ?>
        </ul> 
    </div>
</body>

</html>