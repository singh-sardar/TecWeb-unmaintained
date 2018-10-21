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
        require_once "functions.php";
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
                <div class="dropdown">
                    <select name="dropArt" onchange="submitArtFilterForm()">
                        <option value="">- Artist -</option>
                        <?php
                            $listArt = listArtists();
                            for ($i=0; $i < count($listArt); $i++){
                                if(!isset($_POST['dropArt']) || (isset($_POST['dropArt']) && ($_POST['dropArt'] != $listArt[$i]))){
                                    echo '<option value="'.$listArt[$i].'">'.$listArt[$i].'</option>';
                                }elseif($_POST['dropArt'] == $listArt[$i]){
                                    echo '<option value="'.$listArt[$i].'" selected="selected">'.$listArt[$i].'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>

                <div class="dropdown">
                    <select name="dropCat" onchange="submitArtFilterForm()">
                        <option value="">- Category -</option>
                        <?php
                            $listCat = listCategories();
                            for ($i=0; $i < count($listCat); $i++){
                                if(!isset($_POST['dropCat']) || (isset($_POST['dropCat']) && ($_POST['dropCat'] != $listCat[$i]))){
                                    echo '<option value="'.$listCat[$i].'">'.$listCat[$i].'</option>';
                                }elseif($_POST['dropCat'] == $listCat[$i]){
                                    echo '<option value="'.$listCat[$i].'" selected="selected">'.$listCat[$i].'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>
        </form>
        
        <ul class="clearfix" id="galleryBoard">
            <?php
                if(isset($_POST['dropArt']) && isset($_POST['dropCat'])){
                    $arr = filterImages($_POST['dropArt'],$_POST['dropCat']);

                    for ($i=0; $i < count($arr); $i++){
                        echo "<li>";
                        echo "   <figure>";
                        echo '        <img src="Images/Art/'.$_POST['dropArt'].'/'.$arr[$i].'.png" alt="">';
                        echo '        <figcaption>';
                        echo '            Enterdum et malesuada fames ac ante ipsum primis in faucibus.';
                        echo '            <button class="btnGreen" type="button">Click Me!</button>';
                        echo '       </figcaption>';
                        echo '   </figure>';
                        echo '</li>';
                    }
                }
            ?>
            <!--
            <li>
                <figure>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/210284/1.png" alt="">
                    <figcaption>
                        Enterdum et malesuada fames ac ante ipsum primis in faucibus.
                        <button class="btnGreen" type="button">Click Me!</button>
                    </figcaption>
                </figure>
            </li>
            <li>
                <figure>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/210284/2.png" alt="">
                    <figcaption>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</figcaption>
                </figure>
            </li>
            <li>
                <figure>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/210284/4.png" alt="">
                    <figcaption>Fusce ac felis vel metus.</figcaption>
                </figure>
            </li>
            <li>
                <figure>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/210284/5.png" alt="">
                    <figcaption>Phasellus blandit, eros ac aliquet sollicitudin.</figcaption>
                </figure>
            </li>
            <li>
                <figure>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/210284/6.png" alt="">
                    <figcaption>Cras et tincidunt nisi, ut semper ex. Ut iaculis eget urna sed auctor.</figcaption>
                </figure>
            </li>
            <li>
                <figure>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/210284/7.png" alt="">
                    <figcaption>Nulla suscipit vestibulum dolor. Praesent tincidunt justo risus, ac aliquam purus scelerisque.</figcaption>
                </figure>
            </li>
            <li>
                <figure>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/210284/8.png" alt="">
                    <figcaption>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</figcaption>
                </figure>
            </li>
            <li>
                <figure>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/210284/9.png" alt="">
                    <figcaption>Phasellus ornare rutrum fringilla.</figcaption>
                </figure>
            </li>
            -->
        </ul> 
    </div>
</body>

</html>