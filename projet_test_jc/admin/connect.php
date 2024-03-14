<?php
include_once "../php/librairie/connextion_db.php";

if(isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])){
    $repp = $_POST['username'];
    $repp2 = hash('ripemd160', $_POST['password']);
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
    $requette_verif = "select id from admin";
    $request = $pdo->query( $requette_verif  );
    while ( $row = $request->fetch() ) {
        if($row['id']==$repp){
            $coo=1;
        }
    }
    if($coo==1){
        $requette_verif_password = "select pass,type from admin where id='$repp'";
        $request = $pdo->query( $requette_verif_password );
        while ( $row = $request->fetch() ) {
            //$passwordbase = password_hash($row['pass'],PASSWORD_DEFAULT,["cost"=>12]);
            if(hash_equals($repp2,$row['pass'])){
                if(isset($_COOKIE['user']) && !empty($_COOKIE['user'])){
                    $re = $_COOKIE['user'];
                    $id = "";
                    $requette_recup_id = "select id from admin where id_session='$re'";
                    $request2 = $pdo->query( $requette_recup_id );
                    while ( $row2 = $request->fetch() ) {
                        $id = $row2['id'];
                    }
                }
                $requette_insert_history = "insert into history (da,name,action,type) VALUES (sysdate(),'$repp','connection','admin')";
                $res = $pdo->exec( $requette_insert_history );
                $random=session_create_id();
                $requette_update = array(
                    "update statue set id_session=\"$random\", online='oui' where id='$repp'",
                    "update admin set id_session=\"$random\" where id='$repp'"
                );
                $res = $pdo->exec( $requette_update[0] );
                $res = $pdo->exec( $requette_update[1] );
                setcookie("user",$random,null,"/");
                setcookie("type",hash('ripemd160',$row['type']),null,"/");
                header("location:admin.php");
            }
            else{
                $requette_insert_history = "insert into history (da,name,action,type) VALUES (sysdate(),'$repp','erreur connection password','admin')";
                $res = $pdo->exec( $requette_insert_history );
                header("location:index.php?redirect=erreur");
            }
        }
    }
    else{
        $requette_insert_history = "insert into history (da,name,action,type) VALUES (sysdate(),'$repp','erreur connection username','admin')";
        $res = $pdo->exec( $requette_insert_history );
        header("location:index.php?redirect=erreur");
    }
}
else{
    header("location:index.php?redirect=erreur");
}

?>