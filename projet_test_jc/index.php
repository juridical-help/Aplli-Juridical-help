<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php include_once "php/head.php";?>
        <title>Juridical-help : site d'aide juridique </title>
        <meta name="description" content="voici juridical-help, ce site vas vous aider pour poser des question a des expert du droit, de lire des article sur le droit">
    </head>
    <body id="index">
        <div id="haut">
            <?php include_once "php/header.php"?>
        </div>
        <div id="milieux">
            <?php //setcookie("abon","oscar");
            //on inccorpore la liste pour faire la navbar
                $bool=0;
                include_once "php/liste.php";
            ?>

        </div>
    </body>
</html>