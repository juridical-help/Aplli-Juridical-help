<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php include_once "php/head.php";?>
    </head>
    <body>
        <div id="haut">
            <?php include_once "php/header.php";?>
        </div>
        <div id="milieu">
            <ul>les contact de l'asso
            <?php
            $requette_contact = "select * from contact";
            $request = $pdo->query( $requette_contact );
            while($row = $request->fetch()){
                echo "<li> numero: ".$row['numero']."</li>";
                echo "<li> mail: ".$row['mail']."</li>";
            }
            ?>
            </ul>
        </div>
    </body>
</html>