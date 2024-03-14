<?php
include_once "librairie/connextion_db.php";
include_once "librairie/fonction_php.php";
if(isset($_GET['find']) && !empty($_GET['find'])){
    $find = strtolower($_GET['find']);
    $theme = "";
    $sous = "";
    $count;
    $incr_count=0;
    $incr_c=1;
    $liste_link=array();
    $count = counte("question");
    $requette1 = "select question,reponse,sousrep,theme from forum0 order by sousrep";
    $request = $pdo->query($requette1 );
    while ( $row = $request->fetch() ) {
        if(!isset($_COOKIE['user']) && empty($_COOKIE['user']) || hash_equals($_COOKIE['type'],hash('ripemd160', "super"))){
            if(strstr($row['question'],$find)==true && $row['question']!="veuillez mettre une question"){
                
                if($row['sousrep']!=$sous){
                    echo "<a href=\"page_forum.php?rech=".$row['theme']."&motr=".$row['sousrep']."&find=".$find."\">resultat trouver dans cette page:theme:".$row['theme']." & sous theme:".$row['sousrep']."</a><br>";
                    $sous = $row['sousrep'];
                }
            }
            else{
                $incr_count++;
            }
        }
        else if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) && hash_equals($_COOKIE['type'],hash('ripemd160',"noob"))){
            if(strstr(strtolower($row['reponse']),$find)==true && $row['question']!="veuillez mettre une question"){
                
                if($row['sousrep']!=$sous){
                    echo "<a href=\"page_forum.php?rech=".$row['theme']."&motr=".$row['sousrep']."&find=".$find."\">resultat trouver dans cette page:theme:".$row['theme']." & sous theme:".$row['sousrep']."</a><br>";
                    $sous = $row['sousrep'];
                }
            }
            else{
                $incr_count++;
            }
        }
    }
    if($incr_count==$count){
        $count=0;
        $incr_count=0;
        $count=counte("theme");
        $request = $pdo->query( $requette1);
        while ( $row = $request->fetch() ) {
            if(!isset($_COOKIE['user']) && empty($_COOKIE['user']) || hash_equals($_COOKIE['type'],hash('ripemd160', "super"))){
                if(strstr(strtolower($row['theme']),$find)==true){
                    
                    if($row['sousrep']!=$sous){
                        echo "<a href=\"page_forum.php?rech=".$row['theme']."&motr=".$row['sousrep']."\">resultat trouver dans cette page:theme:".$row['theme']." & sous theme:".$row['sousrep']."</a><br>";
                        $sous = $row['sousrep'];
                    }
                }
                else{
                    $incr_count++;
                }
            }

        }
        if($incr_count==$count){
            $count=0;
            $incr_count=0;
            $count=counte("reponse");
            if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) && hash_equals($_COOKIE['type'],hash('ripemd160', "noob"))){
                $request = $pdo->query( $requette1);
                while ( $row = $request->fetch() ) {
                    if(strstr(strtolower($row['reponse']),$find)==true && $row['question']!="veuillez mettre une question"){
                
                        if($row['sousrep']!=$sous){
                            echo "<a href=\"page_forum.php?rech=".$row['theme']."&motr=".$row['sousrep']."&find=".$find."\">resultat trouver dans cette page:theme:".$row['theme']." & sous theme:".$row['sousrep']."</a><br>";
                            $sous = $row['sousrep'];
                        }
                    }
                    else{
                        $incr_count++;
                    }
                }
                if($incr_count==$count){
                    echo "aucun resultat";
                }
            }
            else{
                echo "aucun resultat";
            }
        }
    }
}


?>