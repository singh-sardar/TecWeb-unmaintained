<?php
    require_once "DbConnector.php";

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

    function insertImageInGallery($artista,$nomeImmagine){
        if ( is_session_started() === FALSE || (!isset($_SESSION['Username']))){
            $isLiked = false;
        }else if(isset($_SESSION['Username'])){
            $isLiked = boolImageLiked($artista,$_SESSION['Username'],$nomeImmagine);
        }
        echo '<li>';
        echo     '<div class="galleryFigureWrapper" id="wrapper_'.$artista.'-'.$nomeImmagine.'">';
        echo '      <img src="Images/Art/'.$artista.'/'.$nomeImmagine.'" id="img_'.$artista.'-'.$nomeImmagine.'" class="display-none" alt="">';
        echo '      <div class="image-div"></div>';
        echo '      <input type="hidden" value="'.$artista.'" name="nameArtist"/>';
        echo '      <input type="hidden" value="'.$nomeImmagine.'" name="nameImage"/>';
        echo '      <div class="galleryCaption">';
        echo '          <div class="wrapper">';
        echo '              <h2>'.substr($nomeImmagine,0,strpos($nomeImmagine,'.')).'</h2>';
        if($isLiked == true){
            echo '              <div class="like-btn like-btn-added" onclick="btnLikeOnClick(this)" id="'.$artista.'_'.$nomeImmagine.'"></div>';
        }else{
            echo '              <div class="like-btn" onclick="btnLikeOnClick(this)" id="'.$artista.'_'.$nomeImmagine.'"></div>';
        }
        echo '          </div>';
        echo '          <p>Artista: '.$artista.'</p>';
        echo '          <p>Likes: '.getLikesByItem($artista,$nomeImmagine).'</p>';
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
            $result = $myDb->doQuery('SELECT Utente FROM Likes WHERE opera="'.$nomeImmagine.'" AND Utente="'.$username.'" AND Creatore="'.$artista.'";');
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
    function printGalleryItems($result){
        $j=0;//solo una pagina
        $j=1;
        $boolChiudi = False;
        for ($i = 0; $i < $result->num_rows; $i++) {
            if($i%8 == 0){
                if($boolChiudi == FALSE){
                    echo "<div id='galImgDiv".$j."'>";
                    $j++;
                    $boolChiudi = TRUE;
                }else{
                    echo "</div>";
                    echo "<div id='galImgDiv".$j."'>";
                    $j++;
                    $boolChiudi = FALSE;
                }
            }
            $row = $result->fetch_assoc();
            insertImageInGallery($row['Artista'],$row['Nome']);
        }
        if($boolChiudi == TRUE && ($i%($result->num_rows)!= 1)){
            echo "</div>";
        }
        return $j;
    }

    function getLikesByItem($artista, $nomeImmagine){
        $myDb= new DbConnector();
        $myDb->openDBConnection();
        
        if($myDb->connected){
            $qrStr= "SELECT COUNT(Opera) as Likes FROM likes WHERE Creatore='".$artista."' AND Opera='".$nomeImmagine."'";
            $result = $myDb->doQuery($qrStr);
            if($result){
                return ($result->fetch_assoc())['Likes'];
            }
        }
        else 
            echo "Connection Error";
        $myDb->disconnect();
        
    }
?>