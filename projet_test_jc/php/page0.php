<?php
include_once "librairie/connextion_db.php";
include_once "librairie/fonction_php.php";
if(isset($_GET['rech']) && !empty($_GET['rech']) && isset($_GET['motr']) && !empty($_GET['motr'])){
    $rep = $_GET['rech'];
    $rep2 = $_GET['motr'];
    if(isset($_POST['commantaire']) && !empty($_POST['commantaire'])){
        $repp = $_POST['commantaire'];
        $name = "";
        if(!isset($_COOKIE['abon']) || empty($_COOKIE['abon'])){
            exit();
        }
        else{
            $rep3 = $_COOKIE['abon'];
            $requette_select = "select id from abonne where id_session='".$_COOKIE['abon']."'";
            $request = $pdo->query( $requette_select );
            while ( $row = $request->fetch() ) {
                $name=$row['id'];
            }
            $requette_insert = "insert into forum0 (question,reponse,theme,sousrep) VALUES (\"$repp\",\"inconnu\",\"$rep\",\"$rep2\")";
            $res = $pdo->exec( $requette_insert );
            $requette_insert_history = "insert into history_user (action,valeur,dat,name,ip) VALUES ('ajouter question',\"".$repp."\",sysdate(),\"$name\",'".getIp()."')";
            $res = $pdo->exec( $requette_insert_history );
            header("location:../page_forum.php?rech=$rep&motr=$rep2&abon=$rep3");
        }
    }
    else{
        header("location:../page_forum.php?rech=$rep&motr=$rep2&abon=".$_COOKIE['abon']."&erreur=champ");
    }
}
else{
    echo "erreur veuillez contacter l'admin ou quelqu'un du site";
}

?>