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

    function insertImageInGallery($artista,$nomeImmagine,$descrizione){
        if ( is_session_started() === FALSE || (!isset($_SESSION['Username']))){
            $isLiked = false;
        }else if(isset($_SESSION['Username'])){
            $isLiked = boolImageLiked($artista,$_SESSION['Username'],$nomeImmagine);
        }
        echo '<li>';
        echo     '<div class="galleryFigureWrapper">';
        echo '      <img src="Images/Art/'.$artista.'/'.$nomeImmagine.'.png" alt="">';
        echo '      <div class="galleryCaption">';
        echo '          <div class="wrapper">';
        echo '              <p class="titleImageOfGallery">'.$nomeImmagine.'</p>';
        if($isLiked == true){
            echo '              <div class="like-btn like-btn-added" onclick="btnLikeOnClick(this)" id="'.$artista.'_'.$nomeImmagine.'"></div>';
        }else{
            echo '              <div class="like-btn" onclick="btnLikeOnClick(this)" id="'.$artista.'_'.$nomeImmagine.'"></div>';
        }
        echo '          </div>';
        echo '          <p class="descImageOfGallery">'.$descrizione.'</p>';
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
            $result = $myDb->doQuery('SELECT Utente FROM Likes WHERE Opera="'.$nomeImmagine.'" AND Utente="'.$username.'" AND Creatore="'.$artista.'";');
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
?>