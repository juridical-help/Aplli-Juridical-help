<?php
include_once "../php/librairie/connextion_db.php";
include_once "../php/librairie/fonction_php.php";
$bool_abonne=0;
$bool_statue=0;
$count_abonne=0;
if(isset($_POST['charte']) && !empty($_POST['charte']) && $_POST['charte']=="on"){
    if(!empty($_POST['mail']) && !empty($_POST['identifiant']) && !empty($_POST['password'])){
        $mail = $_POST['mail'];
        $id = $_POST['identifiant'];
        $passwd = hash('ripemd160', $_POST['password']);
        $requette_select_abonne = "select count(*) from abonne where id='".$id."'";
        $request = $pdo->query( $requette_select_abonne );
        while($row = $request->fetch()){
            $count_abonne = $row['count(*)'];
        }
        if($count_abonne<=0){
            $requette_insert_abonne = "insert into abonne (id,pass,mail,id_session) VALUES ('$id','$passwd','$mail',null)";
            $requette_insert_statue = "insert into statue_abon (online,id,id_session) VALUES ('non','$id',null)";
            $res = $pdo->exec( $requette_insert_abonne );
            $res = $pdo->exec( $requette_insert_statue );
            
            $requette_select_statue = "select count(*) from statue_abon where id='".$id."'";
            $request = $pdo->query( $requette_select_abonne );
            while($row = $request->fetch()){
                $count_abonne = $row['count(*)'];
                if($count_abonne==1){
                    $bool_abonne=1;
                }
            }
            $request = $pdo->query( $requette_select_statue );
            while($row = $request->fetch()){
                $count_abonne = $row['count(*)'];
                if($count_abonne==1){
                    $bool_statue=1;
                }
            }
            if($bool_statue==1 && $bool_abonne==1){
                echo "bravo, votre compte a etait creer <a href='../index.php'>retour a l'acceuil</a>";
                $requette_insert_history = "insert into history_user (action,valeur,dat,name,ip) VALUES ('creation compte','null',sysdate(),'$id','".getIp()."')";
                $res = $pdo->exec( $requette_insert_history );
            }
        }
        else if($count_abonne>=1){
            echo "username déjà utiliser";
        }
    }
}
else{
    echo "attention vous n'avez pas accepter la charte des donnee personnel";
}
?>