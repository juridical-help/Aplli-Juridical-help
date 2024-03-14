<?php
include_once "../php/librairie/connextion_db.php";
if(!empty($_POST['theme']) && isset($_POST['theme']) && !empty($_POST['soustheme']) && isset($_POST['soustheme']) && !empty($_POST['modifier']) && isset($_POST['modifier'])){
    $amodif = "";
    $amodif1 = "";
    $bool=0;
    if(!empty($_POST['theme1']) && isset($_POST['theme1']) &&$_POST['theme1']=="on"){
        $amodif1 = "theme";
        $amodif  = $_POST['theme'];
    }
    else if(!empty($_POST['soustheme1']) && isset($_POST['soustheme1']) && $_POST['soustheme1']=="on"){
        $amodif1 = "sousrep";
        $amodif  = $_POST['soustheme'];
    }
    $modif = $_POST['modifier'];
    if($amodif!="" && $amodif1!=""){
        $requette_select_forum = "select $amodif1 from forum0 where theme=\"".$_POST['theme']."\" and sousrep=\"".$_POST['soustheme']."\"";
        $request = $pdo->query( $requette_select_forum );
        while ( $row = $request->fetch() ) {
            if($row[$amodif1]==$amodif){
                $bool=1;
            }
        }
        if($bool==1){
            $requette_update_forum = "update forum0 set $amodif1=\"$modif\" where theme=\"".$_POST['theme']."\" and sousrep=\"".$_POST['soustheme']."\"";
            $res = $pdo->exec($requette_update_forum );
            header("location:admin.php");
        }
        else{
            echo "erreur, le sous theme ou theme n'existe pas";
        }
    }
    else{
        echo "erreur champ mal ramplis";
    }
}
else if(strstr($_POST['modifier'],"#")){
    echo "erreur, le symbole # est bannis";
}
else{
    echo "erreur<br>";
}

?>