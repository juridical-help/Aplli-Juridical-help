<?php
include_once "../php/librairie/connextion_db.php";
include_once "../php/librairie/fonction_php.php";
if(verif_post($_POST)==1 || (isset($_POST['okok']) && !empty($_POST['okok']) && $_POST['okok']=="on")){
    $rep = $_POST['title'];
    $rep0 = $_POST['theme'];
    $rep2 = $_POST['lien'];
    if(isset($_POST['oui']) && !empty($_POST['oui']) && !isset($_POST['non']) && empty($_POST['non']) && $_POST['oui']=="on"){
        echo $_FILES['fichier']['name']."<br>";
        echo $_FILES['fichier']['type']."<br>";
        echo $_FILES['fichier']['size']."<br>";
        $dir = dirname(__FILE__,2);
        if($_FILES['fichier']['type']=="application/pdf"){
            $requette_insert_journale = "insert into journale (titre,lien,theme) values (\"$rep\",\"".$_FILES['fichier']['name']."\",\"$rep0\")";
            $res = $pdo->exec( $requette_insert_journale);
            
            move_uploaded_file($_FILES['fichier']['tmp_name'],$dir.'/fichier/'.basename($_FILES['fichier']['name']));
        }
        else{
            echo "ce n'est pas un pdf";
        }
    }
    else if(!isset($_POST['oui']) && empty($_POST['oui']) && isset($_POST['non']) && !empty($_POST['non']) && $_POST['non']=="on"){
        if(empty($rep) && empty($rep0) && empty($rep2) && !empty($_POST['okok']) && $_POST['okok']=="on"){
            echo "ok";
            $requette_delete_journale = "delete from journale";
            $res = $pdo->exec( $requette_delete_journale);
        }
        else{
            $requette_delete_partie_journale = "delete from journale where titre=\"$rep\" and theme=\"$rep0\"";
            $res = $pdo->exec($requette_delete_partie_journale );
        }
    }
    else{
        echo "erreur";
    }
}
else{
    echo "erreur, une champ n'a pas etait remplis";
}
?>