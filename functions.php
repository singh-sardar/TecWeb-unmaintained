<?php
    function insertImageInGallery($artista,$nomeImmagine,$descrizione){
        echo '<li>';
        echo '   <div class="galleryFigureWrapper">';
        echo '        <img src="Images/Art/'.$artista.'/'.$nomeImmagine.'.png" alt="">';
        //echo '        <div class="like-btn"></div>';
        echo '        <div class="galleryCaption">';
        echo '            <h3 class="titleImageOfGallery">'.$nomeImmagine.'</h3>';
        echo '            <div class="descImageOfGallery">'.$descrizione.'</div>';
        echo '        </div>';
        echo '   </div>';
        echo '</li>';
    }
?>