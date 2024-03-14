<?php include_once "../php/librairie/connextion_db.php";?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once "../php/head_admin.php";?>
        <?php
            $id_name="";
            $count=0;
            if(isset($_COOKIE['abon']) && !empty($_COOKIE['abon'])){
                $requette_verif = "select id from statue_abon where id_session='".$_COOKIE['abon']."'";
                $request = $pdo->query( $requette_verif );
                while ( $row = $request->fetch() ) {
                    $count++;
                }
                if($count!=0){
                    $requette_verif2 = "select online,id from statue_abon where id_session='".$_COOKIE['abon']."'";
                    $request = $pdo->query( $requette_verif2 );
                    while ( $row = $request->fetch() ) {
                        if($row['online']=="non"){
                            exit();
                            //header("location:index.php");
                        }
                        else{
                            $id_name=$row['id'];
                        }
                    }
                }
                else{
                    exit();
                }
            }
            else{
                header("location:index.php?redirect=nocookie");
            }
        ?>
    </head>
    <body>
        <div id="haut">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Eighth navbar example">
                <div class="container">
                  <a class="navbar-brand" href="#">compte de <?php echo $id_name ?></a>
                  <a href="../index.php">retour a l'acceuil</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>     
                      
                </div>
        </nav>
            <?php
            
            if(!empty($_COOKIE['abon']) && isset($_COOKIE['abon']) && $id_name!=""){
                echo "<button onclick=window.location.href=\"index.php?user='.$id_name.'&redirect=dec\">bouton de deconnection</button>";
            }

            ?>
        </div>
        <div id="milieux">
            <?php
            if(!empty($_COOKIE['abon']) && isset($_COOKIE['abon']) && $id_name!=""){
                $requette_recup_mail_password = "select * from abonne where id='$id_name'";
                $request = $pdo->query( $requette_recup_mail_password );
                while ( $row = $request->fetch() ) {
                    echo "mail: ".$row['mail']."<br>";
                    echo "password: ".$row['pass']."<br>";
                }
                echo "<br>";
                print("
                <h3>formulaire pour changer de password</h3>
                <form method='post' action='change_password.php'>
                <input type='text' name='change'/>
                <input type='submit' value='fin'/>
                </form>
                
                ");
                echo "<br>";
                print("
                <h3>formulaire pour changer de mail</h3>
                <form method='post' action='change_mail.php'>
                <input type='text' name='change'/>
                <input type='submit' value='fin'/>
                </form>
                ");
                for($i=0;$i<3;$i++){
                    echo "<br>";
                }
                include_once "formulaire_igProfil.php";

            }
            ?>
        </div>
    </body>
</html>