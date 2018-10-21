<?php
	require_once "DbConnector.php";

    function listCategories(){
        //connecting to db
        $myDb= new DbConnector();
        $myDb->openDBConnection();
    
        if($myDb->connected){
            $result = $myDb->doQuery("Select DISTINCT Categoria from Opere;");
            
            $arr = array();
            while ($row = $result->fetch_assoc()) {
                array_push($arr,$row["Categoria"]);
            }
            return $arr;
        }
        $myDb->disconnect();
    }

    function listArtists(){
        //connecting to db
        $myDb= new DbConnector();
        $myDb->openDBConnection();

        if($myDb->connected){
            $result = $myDb->doQuery("Select DISTINCT Artista from Opere");
            $arr = array();
            while ($row = $result->fetch_assoc()) {
                array_push($arr,$row["Artista"]);
            }
            return $arr;
        }
        $myDb->disconnect();
    }

    function filterImages($artista, $categoria){
        //connecting to db
        $myDb= new DbConnector();
        $myDb->openDBConnection();
        
        if($myDb->connected){
            $result = $myDb->doQuery("SELECT Nome FROM Opere WHERE Artista='".$artista."' AND Categoria='".$categoria."'");//excecute query
            $arr = array();
            if($result){
                while ($row = $result->fetch_assoc()) {
                    array_push($arr, $row["Nome"]);
                }
            }
            return $arr;
        }
        else 
            return array();
        $myDb->disconnect();
    }
?>