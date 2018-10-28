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
        require_once "searchModal.php";
        require_once "signUpModal.php";
        require_once "editProfileModal.php";
        require_once "DbConnector.php";
        require_once "functions.php";
    ?>
    <div class="gallery">
        <form method="get" action="" name="formArtFilter">
            <div class="artFilter">
                <div class="inputSearch">
                    <?php 
                        if(isset($_GET['gallerySearch'])){
                            echo '<input type="text" placeholder="Cerca per categoria, artista o descrizione .." name="gallerySearch" value="'.$_GET['gallerySearch'].'">';
                        }else{
                            echo '<input type="text" placeholder="Cerca per categoria, artista o descrizione .." name="gallerySearch">';
                        }
                        
                    ?>
                    <button class="btnSearch" type="submit"><span class="searchIcon"></span></button>
                </div>
                <div class="divCategoryFilter">
                    <p>Categories</p>
                    
                    <?php 
                        if(!isset($_SESSION['galleryCategory'])){
                            $_SESSION['galleryCategory'] = 'All';
                        }
                        if(!isset($_GET['galleryCategory'])){$_GET['galleryCategory']= $_SESSION['galleryCategory'];}
                        else{ $_SESSION['galleryCategory'] = $_GET['galleryCategory']; }
                    ?>
                    <div class="div-center">
                        <div class="divCategoryButtons">
                            <button type="submit" name="galleryCategory" value="All" <?php if(isset($_GET['galleryCategory']) && $_GET['galleryCategory']=='All'){echo "class='active'";} ?>>All</button>
                            <button type="submit" name="galleryCategory" value="Landscape" <?php if(isset($_GET['galleryCategory']) && $_GET['galleryCategory']=='Landscape'){echo "class='active'";} ?>>Landscape</button>
                            <button type="submit" name="galleryCategory" value="Fantasy" <?php if(isset($_GET['galleryCategory']) && $_GET['galleryCategory']=='Fantasy'){echo "class='active'";} ?>>Fantasy</button>
                            <button type="submit" name="galleryCategory" value="Abstract" <?php if(isset($_GET['galleryCategory']) && $_GET['galleryCategory']=='Abstract'){echo "class='active'";} ?>>Abstract</button>
                            <button type="submit" name="galleryCategory" value="Cartoon" <?php if(isset($_GET['galleryCategory']) && $_GET['galleryCategory']=='Cartoon'){echo "class='active'";} ?>>Cartoon</button>
                            <button type="submit" name="galleryCategory" value="Portrait" <?php if(isset($_GET['galleryCategory']) && $_GET['galleryCategory']=='Portrait'){echo "class='active'";} ?>>Portrait</button>
                            <button type="submit" name="galleryCategory" value="Nature" <?php if(isset($_GET['galleryCategory']) && $_GET['galleryCategory']=='Nature'){echo "class='active'";} ?>>Nature</button>
                            <button type="submit" name="galleryCategory" value="Others" <?php if(isset($_GET['galleryCategory']) && $_GET['galleryCategory']=='Others'){echo "class='active'";} ?>>Others</button>
                        </div>                  
                    </div>
                </div>

            </div>
        </form>
        
        <?php $mostraPagination=FALSE; $j=0;?>
        <ul class="clearfix galleryBoard">
            <?php
                if(isset($_GET["gallerySearch"])){
                    //connecting to db
                    $myDb= new DbConnector();
                    $myDb->openDBConnection();
                    $param = htmlspecialchars($_GET["gallerySearch"], ENT_QUOTES, "UTF-8");//cleaning the input
                    $result = array();
                    if($myDb->connected){
                        if(!isset($_GET['galleryCategory']) || (isset($_GET['galleryCategory']) && ($_GET['galleryCategory'] == 'All'))){
                            $qrStr = "SELECT Artista,Nome FROM opere WHERE Descrizione LIKE '%".$param."%' OR Categoria LIKE '%".$param."%' OR Artista LIKE '%".$param."%'";
                            /*
                            $qrStr = "SELECT Nome, Artista, COUNT(Nome) as Likes FROM opere o LEFT JOIN likes on Nome=Opera and Artista=Creatore
                                    WHERE o.Descrizione LIKE '%".$param."%' OR o.Categoria LIKE '%".$param."%' OR o.Artista LIKE '%".$param."%'
                                    GROUP BY o.Nome, o.Artista ORDER BY COUNT(Nome) DESC";
                            */
                        }elseif(isset($_GET['galleryCategory']) && ($_GET['galleryCategory'] != 'All')){
                            $qrStr = 'SELECT Artista,Nome FROM opere WHERE Categoria="'.$_GET['galleryCategory'].'" AND (Descrizione LIKE "%'.$param.'%" OR Artista LIKE "%'.$param.'%")';
                            /*
                            $qrStr = 'SELECT Nome, Artista, COUNT(Nome) as Likes FROM opere LEFT JOIN likes on Nome=Opera and Artista=Creatore
                                     WHERE Categoria="'.$_GET['galleryCategory'].'" AND (Descrizione LIKE "%'.$param.'%" OR Artista LIKE "%'.$param.'%")
                                     GROUP BY Nome, Artista ORDER BY COUNT(Nome) DESC';
                            */
                        }
                        $result = $myDb->doQuery($qrStr);
                    }
                    else 
                        echo "Errore connessione";
                    $myDb->disconnect();

                    if($result && ($result->num_rows > 0)){
                        $mostraPagination = ($result->num_rows <= 8) ? false : true;
                        $j = printGalleryItems($result);
                    }
                }elseif(isset($_GET['galleryCategory'])){
                    //connecting to db
                    $myDb= new DbConnector();
                    $myDb->openDBConnection();
                    $param = htmlspecialchars($_GET["galleryCategory"], ENT_QUOTES, "UTF-8");//cleaning the input
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
                        echo "Errore connessione";
                    $myDb->disconnect();

                    if($result && ($result->num_rows > 0)){
                        $mostraPagination = ($result->num_rows <= 8) ? false : true;
                        $j = printGalleryItems($result);
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