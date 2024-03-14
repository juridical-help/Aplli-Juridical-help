<?php
include_once "../php/librairie/connextion_db.php";
include_once "../php/librairie/fonction_php.php";
if(verif_post($_POST)==1){
    $num = $_POST['numero'];
    $mail = $_POST['mail'];
    $count = 0;
    if(isset($_POST['ajout']) && !empty($_POST['ajout']) && !isset($_POST['supp']) && empty($_POST['supp']) && !isset($_POST['modif']) && empty($_POST['modif'])){
        $requette_verif_password = "select count(*) from contact";
        $request = $pdo->query( $requette_verif_password );
        while ( $row = $request->fetch() ) {
            $count=$row['count(*)'];
        }
        if($count==0){
            $requette_insert = "insert into contact (numero,mail) values ('".$num."','".$mail."')";
            $res = $pdo->exec($requette_insert );
        }
        else if($count==1){
            $requette_update = "update contact set numero='".$num."',mail='".$mail."'";
            $res = $pdo->exec($requette_update );
        }
    }
    else if(isset($_POST['supp']) && !empty($_POST['supp']) && !isset($_POST['ajout']) && empty($_POST['ajout']) && !isset($_POST['modif']) && empty($_POST['modif'])){
        $requette_delete = "delete from contact";
        $res = $pdo->exec($requette_delete);
    }
    else if(isset($_POST['modif']) && !empty($_POST['modif']) && !isset($_POST['supp']) && empty($_POST['supp']) && !isset($_POST['ajout']) && empty($_POST['ajout'])){
        $requette_update = "update contact set numero='".$num."',mail='".$mail."'";
        $res = $pdo->exec($requette_update);
    }
    else{
        echo "erreur";
    }
}
else{
    echo "erreur, un champ n'a pas etait remplis";
}

?>