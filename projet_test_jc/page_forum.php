
<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php include_once "php/head.php";?>

        <link href="css/test.css" rel="stylesheet" type="text/css"  />
        <?php
        if(isset($_GET['rech']) && isset($_GET['motr']) && !empty($_GET['rech']) && !empty($_GET['motr'])){
            //on signale qu'il y'a un probleme
            print("<title>Juridical-help : Forum sur ".$_GET['rech']." preicisement ".$_GET['motr']."</title>
            <meta name=\"description\" content=\"juridical-help : voici la partie forum dans la partie: ".$_GET['rech']." et la sous partie : ".$_GET['motr']."\">");
        }
        ?>
    </head>
    <body>
        <div id="haut">
        <?php include_once "php/header.php"?>
        </div>
        <div id="milieux">
        <?php 
                        //on recupere les fichier de base          
                        include_once "php/librairie/connextion_db.php";
                        include_once "php/librairie/fonction_php.php";
                        include_once "php/appel_fonc.php";
                        //si il n'y a pas de requette get sur l'url
                        if(!isset($_GET['rech']) && !isset($_GET['motr']) || empty($_GET['rech']) && empty($_GET['motr'])){
                            //on signale qu'il y'a un probleme
                            echo "attention vous n'avez pas resegner votre theme retourner a la page <a href='index.php'>page accueil</a>";
                        }
                        //sinon si il sont rensegner
                        else if(isset($_GET['rech']) && isset($_GET['motr']) && !empty($_GET['rech']) && !empty($_GET['motr'])){
                            //recuperer les get
                            $rep=$_GET['rech'];
                            $rep2=$_GET['motr'];
                            //afficher la position dans le forum
                            //print("<p>$rep-><strong>$rep2</strong></p>");
                            print('
                            <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Eighth navbar example">
                            <div class="container">
                                <p class=text-white >'.$rep.'-><strong>'.$rep2.'</strong></p>
                            </div>
                            </nav>
                            ');
                            print("
                            <ul>
                            <li><a href='#forum'>le forum</a></li>
                            <li><a href='#formulaire'>s'incrire</a></li>
                            
                            </ul>");
                            echo "<div id='forum'>";
                            $i=0;
                            //si find n'est pas rensegner dans l'url
                            if(!isset($_GET['find'])){
                                
                                //on recupere tout les question reponse du forum qui correspond a rech et motr qui sont resegner dans l'url et on les affiche
                                $requette = "select question,reponse,sousrep from forum0 where sousrep=\"$rep2\" and theme=\"$rep\"";
                                $request = $pdo->query( $requette );
                                while ( $row = $request->fetch() ) {
                                    if($row['question']=="veuillez mettre une question"){
                                        print("<h2>".$row['question']."</h2>");
                                    }
                                    else{
                                        if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) && hash_equals($_COOKIE['type'],hash('ripemd160', "noob"))){
                                            mise_en_form_donnee($row['question'],$row['reponse'],"adm",$i);
                                            //print("<div class='text'><div class='question'><p id='n_$i' onclick=\"select($i)\">question:".$row['question']."</p></div><div class='reponse'><p>reponse:".$row['reponse']."</p></div></div>");
                                            $i++;
                                        }
                                        else{
                                            mise_en_form_donnee($row['question'],$row['reponse'],"autre",0);
                                            //print("<div class='text'><div class='question'><p>question:".$row['question']."</p></div><div class='reponse'><p>reponse:".$row['reponse']."</p></div></div>");
                                        }
                                    }
                                }
                            }
                            //si find et rensegner dans l'url
                            else{
                                //on recupere la valeur de find
                                $recherche=strtolower($_GET['find']);
                                $incr_find=0;
                                $count=0;
                                //si le cookie user n'a pas de valeur et n'est pas resegner ou que le cookie est egale a super
                                if(!isset($_COOKIE['user']) && empty($_COOKIE['user'])){
                                    //on recupere le nombre de ligne
                                    $requette_count = "select count(question) from forum0 where sousrep=\"$rep2\" and theme=\"$rep\" order by sousrep";
                                    $request = $pdo->query( $requette_count);
                                    while ( $row = $request->fetch() ) {
                                        $count=$row['count(question)'];
                                    }
                                    //on recupere les question qui on dans leur valeur la valeur de find
                                    $requette2 = "select question,reponse,sousrep from forum0 where sousrep=\"$rep2\" and theme=\"$rep\"";
                                    $request = $pdo->query( $requette2 );
                                    while ( $row = $request->fetch() ) {
                                        if($row['question']=="veuillez mettre une question"){
                                            print("<h2>".$row['question']."</h2>");
                                        }
                                        else{
                                            if(strstr(strtolower($row['question']),$recherche)==true){
                                                mise_en_form_donnee($row['question'],$row['reponse'],"autre",0);
                                                //print("<div class='text'><div class='question'><h3>question:".$row['question']."</h3></div><div class='reponse'><h3>reponse:".$row['reponse']."</h3></div></div>");
                                            }
                                            else{
                                                $incr_find++;
                                            }
                                        }
                                        if($incr_find==$count){
                                            echo "aucun resultat";
                                        }
                                    }
                                }
                                else if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) && $_COOKIE['type']!=""){
                                    $requette3 = "select count(reponse) from forum0 where sousrep=\"$rep2\" and theme=\"$rep\" order by sousrep";
                                    $request = $pdo->query($requette3 );
                                    while ( $row = $request->fetch() ) {
                                        $count=$row['count(reponse)'];
                                    }
                                    $requette4 = "select question,reponse,sousrep from forum0 where sousrep=\"$rep2\" and theme=\"$rep\"";
                                    $request = $pdo->query( $requette4 );
                                    while ( $row = $request->fetch() ) {
                                        if($row['question']=="veuillez mettre une question"){
                                            print("<h2>".$row['question']."</h2>");
                                        }
                                        else{
                                            if(strstr(strtolower($row['reponse']),$recherche)==true){
                                                if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) && hash_equals($_COOKIE['type'],hash('ripemd160', "noob")) && $liste[0]=="ok"){
                                                    mise_en_form_donnee($row['question'],$row['reponse'],"adm",$i);
                                                    //print("<div class='text'><div class='question'><h3 id='n_$i' onclick=\"select($i)\">question:".$row['question']."</h3></div><div class='reponse'><h3>reponse:".$row['reponse']."</h3></div></div>");
                                                    $i++;
                                                }
                                                else{
                                                    mise_en_form_donnee($row['question'],$row['reponse'],"autre",0);
                                                    //print("<div class='text'><div class='question'><h3>question:".$row['question']."</h3></div><div class='reponse'><h3>reponse:".$row['reponse']."</h3></div></div>");
                                                }
                                            }
                                            else{
                                                $incr_find++;
                                            }
                                        }
                                        if($incr_find==$count){
                                            echo "aucun resultat";
                                        }
                                    }
                                }
                               
                            }
                            echo "</div>";
                            //ici on affiche les formulaire a décoite en fonction des cookie
                            echo "<div id='formulaire'>";
                            //si le cookie et abon alors on affiche formulaire_forum
                            if(isset($_COOKIE['abon']) && !empty($_COOKIE['abon']) && $liste[1]=="ok"){
                                $abon=$_COOKIE['abon'];
                                include_once "php/formulaire_forum.php";
                            }
                            //si le cookie est user et que la valeur est égale a noob alors on affiche formulaire_noob
                            
                            else if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) && hash_equals($_COOKIE['type'],hash('ripemd160', "noob")) && $liste[0]=="ok"){
                                include_once "php/formulaire_noob.php";
                            }
                            //si le cookie est user et que la valeur est super
                            else if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) && hash_equals($_COOKIE['type'],hash('ripemd160', "super")) && $liste[0]=="ok"){
                                echo "";
                            }
                            //sinon on affiche le formulaire d'abonnement
                            else{
                                include_once "php/frormulaire_abonnement.php";
                            }
                            echo "</div>";
                        }
                        else{
                            echo "<a href='index.php'>page accueil</a>";
                        }
                    ?>

        </div>
    </body>
</html>