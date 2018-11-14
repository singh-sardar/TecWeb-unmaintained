<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"/>
    <meta name="description" content="Online artwork database"/>
    <meta name="keywords" content="artwork,picture,image,database"/>
    <meta name="author" content="Daniele Bianchin, Pardeep Singh, Davide Liu, Harwinder Singh"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="Style/style.css" media="handheld, screen"/>
    <script type="text/javascript" src="script.js" ></script>
    <title>Artbit</title>
</head>

<body onload="eventListnerforLoginModal(); paginationAndPopulateImages();" >
    <?php
        require_once "header.php";
        require_once "loginModal.php";
        require_once "searchModal.php";
        require_once "likedByModal.php";
        require_once "signUpModal.php";
        require_once "editProfileModal.php";
        require_once "DbConnector.php";
        require_once "functions.php";
    ?>
    <div id="imgLoader" class="image-loader display-none">
        <img src="/Images/eclipse.svg">
    </div>
    <div class="gallery container1024">
        <form method="get" action="" name="formArtFilter">
            <div class="artFilter">
                <div class="inputSearch">
                    <?php 
                        if(isset($_GET['gallerySearch'])){
                            $gallerySearch = htmlspecialchars($_GET["gallerySearch"], ENT_QUOTES, "UTF-8");//cleaning the input
                            echo '<input type="text" placeholder="Cerca per categoria, artista o descrizione .." name="gallerySearch" value="'.$gallerySearch.'"/>';
                        }else{
                            echo '<input type="text" placeholder="Cerca per categoria, artista o descrizione .." name="gallerySearch"/>';
                        }
                        
                    ?>
                    <button class="btnSearch" type="submit"><span class="searchIcon"></span></button>
                </div>
                <div class="divCategoryFilter">
                    <p>Categories</p>
                    
                    <?php 
                        if(!isset($_SESSION['galleryCategory'])){
                            $_SESSION['galleryCategory'] = $galleryCategory = 'All';
                        }
                        if(!isset($_GET['galleryCategory'])){
                            $galleryCategory= $_SESSION['galleryCategory'];
                        }else{ 
                            $galleryCategory = htmlspecialchars($_GET["galleryCategory"], ENT_QUOTES, "UTF-8");//cleaning the input
                            $_SESSION['galleryCategory'] = $galleryCategory; 
                        }
                    ?>
                    <div class="div-center">
                        <div class="divCategoryButtons">
                            <button type="submit" name="galleryCategory" value="All" <?php if(isset($galleryCategory) && $galleryCategory=='All'){echo "class='active'";} ?>>All</button>
                            <button type="submit" name="galleryCategory" value="Landscape" <?php if(isset($galleryCategory) && $galleryCategory=='Landscape'){echo "class='active'";} ?>>Landscape</button>
                            <button type="submit" name="galleryCategory" value="Fantasy" <?php if(isset($galleryCategory) && $galleryCategory=='Fantasy'){echo "class='active'";} ?>>Fantasy</button>
                            <button type="submit" name="galleryCategory" value="Abstract" <?php if(isset($galleryCategory) && $galleryCategory=='Abstract'){echo "class='active'";} ?>>Abstract</button>
                            <button type="submit" name="galleryCategory" value="Cartoon" <?php if(isset($galleryCategory) && $galleryCategory=='Cartoon'){echo "class='active'";} ?>>Cartoon</button>
                            <button type="submit" name="galleryCategory" value="Portrait" <?php if(isset($galleryCategory) && $galleryCategory=='Portrait'){echo "class='active'";} ?>>Portrait</button>
                            <button type="submit" name="galleryCategory" value="Nature" <?php if(isset($galleryCategory) && $galleryCategory=='Nature'){echo "class='active'";} ?>>Nature</button>
                            <button type="submit" name="galleryCategory" value="Others" <?php if(isset($galleryCategory) && $galleryCategory=='Others'){echo "class='active'";} ?>>Others</button>
                        </div>                  
                    </div>
                </div>

            </div>
        </form>
        
        <?php $mostraPagination=FALSE; $j=0;?>
        <ul class="clearfix galleryBoard">
            <?php
                $result;
                $mostraPagination;
                if(isset($gallerySearch)){
                    //connecting to db
                    $myDb= new DbConnector();
                    $myDb->openDBConnection();
                    //$param = htmlspecialchars($gallerySearch, ENT_QUOTES, "UTF-8");//cleaning the input
                    $param = $gallerySearch;
                    $result = array();
                    if($myDb->connected){
                        if(!isset($galleryCategory) || (isset($galleryCategory) && ($galleryCategory == 'All'))){
                            $qrStr = "SELECT Artista,Nome FROM opere WHERE Descrizione LIKE '%".$param."%' OR Categoria LIKE '%".$param."%' OR Artista LIKE '%".$param."%' OR Nome LIKE '%".$param."%'";
                            /*
                            $qrStr = "SELECT Nome, Artista, COUNT(Nome) as Likes FROM opere o LEFT JOIN likes on Nome=Opera and Artista=Creatore
                                    WHERE o.Descrizione LIKE '%".$param."%' OR o.Categoria LIKE '%".$param."%' OR o.Artista LIKE '%".$param."%'
                                    GROUP BY o.Nome, o.Artista ORDER BY COUNT(Nome) DESC";
                            */
                        }elseif(isset($galleryCategory) && ($galleryCategory != 'All')){
                            $qrStr = 'SELECT Artista,Nome FROM opere WHERE Categoria="'.$galleryCategory.'" AND (Descrizione LIKE "%'.$param.'%" OR Artista LIKE "%'.$param.'%" OR Nome LIKE "%'.$param.'%")';
                            /*
                            $qrStr = 'SELECT Nome, Artista, COUNT(Nome) as Likes FROM opere LEFT JOIN likes on Nome=Opera and Artista=Creatore
                                     WHERE Categoria="'.$_GET['galleryCategory'].'" AND (Descrizione LIKE "%'.$param.'%" OR Artista LIKE "%'.$param.'%")
                                     GROUP BY Nome, Artista ORDER BY COUNT(Nome) DESC';
                            */
                        }
                        $result = $myDb->doQuery($qrStr);
                    }
                    else 
                        echo "<li class='liPaginationBlock'>Errore connessione</li>";
                    $myDb->disconnect();
                }elseif(isset($galleryCategory)){
                    //connecting to db
                    $myDb= new DbConnector();
                    $myDb->openDBConnection();
                    //$param = htmlspecialchars($galleryCategory, ENT_QUOTES, "UTF-8");//cleaning the input
                    $param = $galleryCategory;
                    $result = array();
                    if($myDb->connected){
                        if($param == 'All'){
                            $qrStr = "SELECT Artista,Nome FROM opere;";
                            //$qrStr = "SELECT Nome, Artista, COUNT(Nome) as Likes FROM opere LEFT JOIN likes on Nome=Opera and Artista=Creatore GROUP BY Nome, Artista ORDER BY COUNT(Nome) DESC";
                        }else{
                            $qrStr = "SELECT Artista,Nome FROM opere WHERE Categoria='".$param."'";
                            /*
                            $qrStr = "SELECT Nome, Artista, COUNT(Nome) as Likes FROM opere JOIN likes on Nome=Opera and Artista=Creatore
                                     WHERE Categoria='".$param."' GROUP BY Nome, Artista ORDER BY COUNT(Nome) DESC";
                            */
                        }
                        $result = $myDb->doQuery($qrStr);
                    }
                    else 
                        echo "<li class='liPaginationBlock'>Errore connessione</li>";
                    $myDb->disconnect();   
                }

                if($result && ($result->num_rows > 0)){
                    $mostraPagination = ($result->num_rows <= $GLOBALS['imagesPerPage']) ? false : true;
                    $j = printGalleryItems($result,FALSE);
                }elseif(!$result || ($result->num_rows == 0)){
                    echo "<li class='liPaginationBlock'><div class='div-center'><p>Nothing to show here ... </p></div></li>";
                }
            ?>
            
        </ul> 
        <?php
            printPagination($mostraPagination,$j);
        ?>
    </div>
	<div class="footer">
		<p>Artbit</p>
  </div>
</body>
</html>