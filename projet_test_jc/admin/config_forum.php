<?php
include_once "../php/librairie/connextion_db.php";
include_once "../php/librairie/fonction_php.php";
if(verif_post($_POST)==1 || (isset($_POST['okok0']) && !empty($_POST['okok0']) && $_POST['okok0']=="on")){
    if(strstr($_POST['texte'],"#") || strstr($_POST['texte2'],"#")){
        echo "erreur, le symbole # est bannis";
    }
    else{
        $rep = $_POST['texte'];
        $rep0 = $_POST['texte2'];
        if(isset($_POST['ajouter_theme']) && !empty($_POST['ajouter_theme']) && !isset($_POST['supprimer_theme']) && empty($_POST['supprimer_theme'])){
            $rep2 = $_POST['ajouter_theme'];
        }
        else{
            $rep2="off";
        }
        if(isset($_POST['supprimer_theme']) && !empty($_POST['supprimer_theme']) && !isset($_POST['ajouter_theme']) && empty($_POST['ajouter_theme'])){
            $rep3 = $_POST['supprimer_theme'];
        }

        else{
            $rep3="off";
        }
        if(isset($_POST['okok0']) && !empty($_POST['okok0'])){
            $rep4 = $_POST['okok0'];
        }
        else{
            $rep4="off";
        }


        if($rep2=="on"){
            $requette_insert = "insert into forum0 (question,reponse,theme,sousrep) values (\"veuillez mettre une question\",Null,\"$rep\",\"$rep0\")";
            $res = $pdo->exec($requette_insert );
        }
        else if($rep3=="on"){
            $requette_delete = array(
                "delete from forum0 where theme=\"$rep\" and sousrep=\"$rep0\"",
                "delete from forum0",
                "delete from forum0 where theme=\"$rep\""
            );
            if(!empty($rep0)){
                $res = $pdo->exec( $requette_delete[0] );
            }
            else if(empty($rep) && empty($rep0) && $rep4=="on"){
                $res = $pdo->exec($requette_delete[1] );
            }
            else{
                $res = $pdo->exec( $requette_delete[2]);
            }
        }
        else{
            echo "erreur";
        }
    }
}
else{
    echo "erreur, un champs n'a pas etait ramplis";
}
?>