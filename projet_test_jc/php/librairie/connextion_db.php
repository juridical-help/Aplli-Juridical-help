<?php
//nom base de donnee
$SQL_DSN   = 'mysql:host=localhost;dbname=bigprojet';
//identifiant
$SQL_LOGIN = 'pi';
//mot passe
$SQL_PASS  = '082001';
                                    
try {
    //creation d'une connection
    $pdo = new PDO($SQL_DSN, $SQL_LOGIN, $SQL_PASS);
}
catch( PDOException $e ) {
    echo 'Erreur : '.$e->getMessage();
    exit;
}
?>