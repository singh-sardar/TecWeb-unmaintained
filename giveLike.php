<?php
    require_once "functions.php";
    require_once "DbConnector.php";

    if ( is_session_started() === FALSE ) session_start();
    //echo $_SESSION["isLogged"];
    if(!isset($_SESSION["isLogged"]) || ($_SESSION["isLogged"]=="false")){
        echo 0; //utente non loggato

    }else{
        $artista= htmlspecialchars($_POST["art"], ENT_QUOTES, "UTF-8");//cleaning the input
        $nomeImmagine= htmlspecialchars($_POST["nomeImg"], ENT_QUOTES, "UTF-8");
        //connecting to db
        $myDb= new DbConnector();
        $myDb->openDBConnection();
        
        if($myDb->connected){
            //echo 'INSERT INTO Likes (Opera, Utente, Creatore) VALUES ("'.$nomeImmagine.'", "'.$_SESSION["Username"].'", "'.$artista.'");';
            //$result = $myDb->doQuery('INSERT INTO Likes (Opera, Utente, Creatore) VALUES ("'.$nomeImmagine.'", "'.$_SESSION['Username'].'", "'.$artista.'");');//excecute query
            $result = $myDb->doQuery('SELECT Utente FROM Likes WHERE Opera="'.$nomeImmagine.'" AND Utente="'.$_SESSION['Username'].'" AND Creatore="'.$artista.'";');
            //echo $myDb->getLastErrorString();
            if($result){
                if($result->num_rows==0){//significa che il like non è ancora presente per l'opera
                    $result = $myDb->doQuery('INSERT INTO Likes (Opera, Utente, Creatore) VALUES ("'.$nomeImmagine.'", "'.$_SESSION['Username'].'", "'.$artista.'");');//excecute query
                    if($result)
                        echo 1;        
                }else if($result->num_rows==1){
                    $result = $myDb->doQuery('DELETE FROM Likes WHERE Opera="'.$nomeImmagine.'" AND Utente="'.$_SESSION['Username'].'" AND Creatore="'.$artista.'";');//excecute query
                    if($result)
                        echo 2;
                }
            }else{
                echo 3;
            }
        }
        else 
            echo "Connection Error";
        $myDb->disconnect();
    }
?>