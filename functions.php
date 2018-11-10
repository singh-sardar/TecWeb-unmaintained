<?php
    require_once "DbConnector.php";

    $GLOBALS['imagesPerPage'] = 8;

    /**
    * @return bool
    */
    function is_session_started()
    {
        if ( php_sapi_name() !== 'cli' ) {
            if ( version_compare(phpversion(), '5.4.0', '>=') ) {
                return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
            } else {
                return session_id() === '' ? FALSE : TRUE;
            }
        }
        return FALSE;
    }

    function insertImageInGallery($artista,$nomeImmagine, $numFig,$boolDeleteButton){
        if ( is_session_started() === FALSE || (!isset($_SESSION['Username']))){
            $isLiked = false;
        }else if(isset($_SESSION['Username'])){
            $isLiked = boolImageLiked($artista,$_SESSION['Username'],$nomeImmagine);
        }
        echo '<li class="liFigures">';
        echo     '<div class="galleryFigureWrapper" id="figureWrapper_'.$numFig.'">';
        echo '      <div class="image-div"></div>';
        echo '      <input type="hidden" value="'.$artista.'" name="nameArtist"/>';
        echo '      <input type="hidden" value="'.$nomeImmagine.'" name="nameImage"/>';
        echo '      <div class="galleryCaption">';
        echo '              <h2>'.$nomeImmagine.'</h2>';
        echo '          <div class="wrapper">';
        if($isLiked == true){
            echo '              <div class="like-btn like-btn-added" onclick="btnLikeOnClick(this)" id="LikeBtn_'.$numFig.'"></div>';
        }else{
            echo '              <div class="like-btn" onclick="btnLikeOnClick(this)" id="LikeBtn_'.$numFig.'"></div>';
        }
        echo '              <div class="width-85">';
        echo '                  <p><span class="font-size-large">Artist:</span> '.$artista.'</p>';
        echo '                  <p id="Likes_'.$numFig.'"><span class="font-size-large">Likes: </span>'.getLikesByItem($artista,$nomeImmagine).'</p>';
        echo '              </div>';
        echo '          </div>';
        if($boolDeleteButton == TRUE){
            echo '<button class="btnDelete" type="submit" id="DelBtn_'.$numFig.'" onclick="btnDeleteOnClick(this)"><span class="searchIcon"></span>Delete</button>';
        }
        echo '      </div>';
        echo '   </div>';
        echo '</li>';
        echo "\r\n";
    }

    //return true if image is already liked
    function boolImageLiked($artista,$username,$nomeImmagine){
        $myDb= new DbConnector();
        $myDb->openDBConnection();
        
        if($myDb->connected){
            $result = $myDb->doQuery('SELECT Utente FROM likes WHERE opera="'.$nomeImmagine.'" AND Utente="'.$username.'" AND Creatore="'.$artista.'";');
            if($result){
                if($result->num_rows==0){//significa che il like non è ancora presente per l'opera
                    return false;        
                }else if($result->num_rows==1){//significa che il like è presente
                    return true;
                }
            }else{
                echo "Errore";
            }
        }
        else 
            echo "Connection Error";
        $myDb->disconnect();
    }

    //prints div containing buttons for pagination in the gallery page
    //IN:
    // - $i: number of buttons to be displayed
    function printDivPagination($i){
        echo '<div class="div-center">';
        echo '   <div class="div-bar gal-pag-border gal-border-round">';
        echo '      <a href="#" class="div-bar-item gal-pag-button" id="btnPagBack" onclick="btnPagBackOnClick()">&laquo;</a>';
        for($j=1; $j < $i; $j++){
            echo '  <a href="#" class="div-bar-item gal-pag-button" id="btnPagination'.$j.'" onclick="btnPaginationOnClick(this.id)">'.$j.'</a>';
        }
        echo '      <a href="#" class="div-bar-item gal-pag-button" id="btnPagForward" onclick="btnPagForwardOnClick()">&raquo;</a>';
        echo '  </div>';
        echo '</div>';
    }

    /*
    * Function for printing gallery items
    * IN:
    *   - $result: object returned after doing $myDb->doQuery()
    * OUT:
    *   - $j: number of pages to be displayed
    */
    function printGalleryItems($result,$boolDeleteButton){
        $j=0;//solo una pagina
        $j=1;
        $boolChiudi = False;
        for ($i = 0; $i < $result->num_rows; $i++) {
            if($i%($GLOBALS['imagesPerPage']) == 0){
                if($boolChiudi == FALSE){
                    echo "<li id='galImgPag".$j."' class='liPaginationBlock'><ul>";
                    $j++;
                    $boolChiudi = TRUE; 
                }else{
                    echo "</ul></li>";
                    echo "<li id='galImgPag".$j."' class='liPaginationBlock'><ul>";
                    $j++;
                    $boolChiudi = FALSE;
                }
            }
            $row = $result->fetch_assoc();
            insertImageInGallery($row['Artista'],$row['Nome'],$i+1,$boolDeleteButton);
        }
        if($boolChiudi == TRUE || ($i%($result->num_rows)!= 1)){
            echo "</ul></li>";
        }
        return $j;
    }

    function getLikesByItem($artista, $nomeImmagine){
        $myDb= new DbConnector();
        $myDb->openDBConnection();
        
        if($myDb->connected){
            $qrStr= "SELECT COUNT(Opera) as Likes FROM likes WHERE Creatore='".$artista."' AND Opera='".$nomeImmagine."'";
            $result = $myDb->doQuery($qrStr);
            if($result && $result->num_rows == 1){
                if($result && $result->num_rows == 1){
                    $row = $result->fetch_assoc();
                    return $row['Likes'];
                }
            }
        }
        else 
            echo "Connection Error";
        $myDb->disconnect();
    }

    function deleteItem($artista, $nomeImmagine){
        $myDb= new DbConnector();
        $myDb->openDBConnection();

        if($myDb->connected){
            $qrStr= "DELETE FROM opere WHERE Artista='".$artista."' AND Nome='".$nomeImmagine."'";
            $result = $myDb->doQuery($qrStr);
            if ($result == TRUE) {
                deleteFileFromFileSystem($artista,$nomeImmagine);
                echo 1;
            } else { //Error
                echo -1;
            }
        }
        else 
            echo "Connection Error";
        $myDb->disconnect();
    }

    function deleteFileFromFileSystem($username,$title){
        $destination_img = "Images/Art/".$username."/".$title.".jpeg";
        if(file_exists($destination_img)){
            unlink($destination_img);
        }
    }

    function printPagination($mostraPagination,$j){
        if($mostraPagination == TRUE && ($j > 2)){
            printDivPagination($j);
        }
    }

    function escapePathTraversal($path){
        return str_replace("/", "&#x2F;", str_replace(".", "&#x2E;", $path));
    }
?>