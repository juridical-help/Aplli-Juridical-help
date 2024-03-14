<?php
include_once "../php/librairie/connextion_db.php";
$id = "";
$count = 0;
$new_passowrd = "";
foreach($_POST as $key=>$val){
    if($val=="on"){
        $count++;
    }
}
if($count==1){
    foreach($_POST as $key=>$val){
        if($val=="on"){
            if(isset($_POST['text_'.$key]) && !empty($_POST['text_'.$key])){
                $new_passowrd=$_POST['text_'.$key];
                $passwd = hash('ripemd160', $new_passowrd);
                $requette_update_abonne = "update abonne set pass='".$passwd."' where id='".$key."'";
                $res = $pdo->exec( $requette_update_abonne );
            }
            else{
                echo "pas fait";
            }
        }
    }
}


?>