<?php
include_once "../php/librairie/connextion_db.php";

$repp2 = $_POST['nom'];
$repp = $_POST['commantaire'];
$rep = $_GET['rech'];
$rep2 = $_GET['motr'];
$rep3 = $_COOKIE['user'];
//si le checkbox est pas remplis, ajouter la reponse a la question, si la question existe
if(!isset($_POST['supprimer']) && empty($_POST['supprimer'])){
    $bool = 0;
    $requette_select = "select question from forum0 where sousrep=\"$rep2\" and theme=\"$rep\"";
    $request = $pdo->query( $requette_select );
        while ( $row = $request->fetch() ) {
            if($repp2==$row['question']){
                $bool=1;
            }
        }
    if($bool==1){
        $requette_update = "update forum0 set reponse=\"$repp\" where sousrep=\"$rep2\" and question=\"$repp2\" and theme=\"$rep\"";
        $res = $pdo->exec( $requette_update);

        header("location:../page_forum.php?rech=$rep&motr=$rep2");
    }
    else if($bool==0){
        echo "desole la requette n'a pas pu etres executer car le champ question a etait mal remplis<br>";
        echo "<a href=\"../page_forum.php?rech=$rep&motr=$rep2\">retour</a>";
    }
}
//si le checkbox est remplis et si le champ commantaire n'est pas rensegner, supprimer la question selectionner
else{
    if(!isset($_POST['commantaire']) || empty($_POST['commantaire'])){
        $bool = 0;
        $requette_select = "select question from forum0 where sousrep=\"$rep2\" and theme=\"$rep\"";
        $request = $pdo->query( $requette_select );
            while ( $row = $request->fetch() ) {
                if($repp2==$row['question']){
                    $bool=1;
                }
            }
        if($bool==1){
            $requette_delete = "delete from forum0 where sousrep=\"$rep2\" and theme=\"$rep\" and question=\"$repp2\"";
            $res = $pdo->exec($requette_delete);

            header("location:../page_forum.php?rech=$rep&motr=$rep2");
        }
        else if($bool==0){
            echo "desole la requette n'a pas pu etres executer car le champ question a etait mal remplis<br>";
            echo "<a href=\"../page_forum.php?rech=$rep&motr=$rep2\">retour</a>";
        }
    }
    else if(isset($_POST['commantaire']) || !empty($_POST['commantaire'])){
        echo "en cours de construction";
    }
    else{
        echo "erreur veuillez contacter le support";
    }
}
?>