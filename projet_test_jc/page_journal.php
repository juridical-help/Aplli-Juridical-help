<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php include_once "php/head.php"; ?>
        <?php
         if(isset($_GET['theme']) && isset($_GET['lien']) && isset($_GET['titre'])){
            print("<title>Juridical-help : Journal sur le theme: ".$_GET['theme']." qui parle de ".$_GET['titre']."</title>
            <meta name=\"description\" content=\"juridical-help : voici la partie journal dans la partie: ".$_GET['theme']." et sur le sujet de".$_GET['titre']."\">");
         }
        ?>
    </head>
    <body>
        <div id="haut">
        <?php include_once "php/header.php"?>
        </div>
        <div id="milieux">
        <?php
            //on incorpore les fichier de base
            include_once "php/librairie/connextion_db.php";
            include_once "php/librairie/fonction_php.php";
            include_once "php/appel_fonc.php";
            $sous="";
            //si theme, lien et titre sons dans l'url
            if(isset($_GET['theme']) && isset($_GET['lien']) && isset($_GET['titre'])){
                //recupere les get dans des variable
                $rep1 = $_GET['theme'];
                $rep2 = $_GET['lien'];
                $rep3 = $_GET['titre'];
                //afficher l'iframe qui correspond
                echo "<iframe src=\"fichier/$rep2\" id='ifrm'></iframe>";
            }

        ?>
        </div>
    </body>
</html>