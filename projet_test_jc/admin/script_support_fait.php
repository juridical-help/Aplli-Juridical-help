<?php
include_once "../php/librairie/connextion_db.php";
if(isset($_GET['id']) && !empty($_GET['id'])){
    $req = $pdo->prepare("update support set statu='fait' where id=".$_GET['id']);
    $req->execute();
}

?>