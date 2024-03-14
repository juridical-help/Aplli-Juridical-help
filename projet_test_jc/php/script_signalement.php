<?php
include_once "librairie/connextion_db.php";
if(isset($_POST['theme']) && isset($_POST['text']) && !empty($_POST['theme']) && !empty($_POST['text'])){
    $req = $pdo->prepare("insert into support (theme,text,statu) values ('".$_POST['theme']."','".$_POST['text']."','en cours')");
    $req->execute();
    header("location:../support.php?redirect=fait");
}
else if((!isset($_POST['theme']) || empty($_POST['theme'])) || (!isset($_POST['text']) || empty($_POST['text']))){
    header("location:../support.php?redirect=nonRen");
}
else{
    header("location:../support.php?redirect=erreur");
}
?>