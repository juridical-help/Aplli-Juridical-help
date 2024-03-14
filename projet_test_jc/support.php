<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php include_once "php/head.php";?>
        <?php
        $statue = "";
        if(isset($_GET['redirect']) && !empty($_GET['redirect'])){
            if($_GET['redirect']=="nonRen"){
                $statue="nonRen";
            }
            else if($_GET['redirect']=="erreur"){
                $statue="erreur";
            }
            else if($_GET['redirect']=="fait"){
                $statue="fait";
            }
        }
        ?>
        <style>
            #formulaire_support{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div id="haut">
            <?php include_once "php/header.php";?>
        </div>
        <div id="milieu">
            <form method="post" id="formulaire_support" action="php/script_signalement.php">
                <h2>fomulaire support</h2>
                <?php
                if($statue=="nonRen"){
                    echo "<p>erreur : un champ na pas etait remplis</p>";
                }
                else if($statue=="fait"){
                    echo "<p>votre demande a etait envoyer</p>";
                }
                ?>
                <label>theme</label><br>
                <input type="text" name="theme"/>
                <br>
                <label>explication</label><br>
                <textarea wrap="hard" name="text"></textarea>
                <br>
                <input type="submit" value="fin"/>
            </form>
        </div>
    </body>
</html>