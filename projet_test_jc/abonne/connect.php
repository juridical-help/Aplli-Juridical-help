<?php
include_once "../php/librairie/connextion_db.php";
include_once "../php/librairie/fonction_php.php";
if(isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])){
    $repp = $_POST['username'];
    $repp2 = hash('ripemd160',$_POST['password'] );
    $liste = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
    $liste2 = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    for($i=0;$i<strlen($repp);$i++){
        for($i2=0;$i2<count($liste2);$i2++){
            if($repp[$i]==$liste2[$i2]){
                $repp[$i]=$liste[$i2];
            }
        }
        
    }
    $coo = 0;
    $requette_verif_id = "select id from abonne";
    $request = $pdo->query( $requette_verif_id );
    while ( $row = $request->fetch() ) {
        if($row['id']==$repp){
            $coo=1;
        }
    }
    if($coo==1){
        $requette_verif_password = "select pass from abonne where id='$repp'";
        $request = $pdo->query( $requette_verif_password );
        while ( $row = $request->fetch() ) {
            if(hash_equals($repp2,$row['pass'])){
                if(isset($_COOKIE['abon']) && !empty($_COOKIE['abon'])){
                    $re = $_COOKIE['abon'];
                    $id = "";
                    $requette_recup_id = "select id from abonne where id_session='$re'";
                    $request2 = $pdo->query( $requette_recup_id );
                    while ( $row2 = $request->fetch() ) {
                        $id = $row2['id'];
                    }
                }
                $requette_insert_history = "insert into history_user (action,valeur,dat,name,ip) VALUES ('connection',null,sysdate(),'$repp','".getIp()."')";
                $res = $pdo->exec( $requette_insert_history );
                $random=session_create_id();
                $requette_update = array(
                    "update statue_abon set id_session=\"$random\", online='oui' where id='$repp'",
                    "update abonne set id_session=\"$random\" where id='$repp'"
                );
                $res = $pdo->exec($requette_update[0]  );
                $res = $pdo->exec( $requette_update[1] );
                setcookie("abon",$random,null,"/");
                header("location:../index.php");
            }
            else{
                header("location:index.php?user=$repp&redirect=erreur");
            }
        }
    }
    else{
        header("location:index.php?redirect=erreur");
    }
}
else{
    header("location:index.php?redirect=erreur");
}
