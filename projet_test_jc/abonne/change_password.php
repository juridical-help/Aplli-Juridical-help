<?php
include_once "../php/librairie/connextion_db.php";
$new_pass=hash('ripemd160', $_POST['change']);
if(isset($_COOKIE['abon']) && !empty($_COOKIE['abon'])){
    $rep0 = $_COOKIE['abon'];
    $requette_update_abonne = "update abonne set pass='$new_pass' where id_session='$rep0'";
    $res = $pdo->exec( $requette_update_abonne );
    $requette_select_abonne = "select pass from abonne where id_session='$rep0'";
    $request = $pdo->query( $requette_select_abonne );
    while ( $row = $request->fetch() ) {
        if($row['pass']==$new_pass){
            echo "votre mot de passe a bien etait changer";
            echo "<br>";
        }
    }
    echo "regarder si votre mot de passe a changer correctement";
    echo "<br>";
    echo "<a href='abonne.php'>retours au config</a>";
}
?>