<?php
        include_once "../php/librairie/connextion_db.php";
        include_once "../php/librairie/fonction_php.php";
        $nococher = 0;
        $erreur=0;
        $nocookie = 0;
        if(!empty($_COOKIE['abon']) && isset($_COOKIE['abon'])){
            $rep0 = $_COOKIE['abon'];
            
            if(!empty($_GET['redirect']) && isset($_GET['redirect']) && $_GET['redirect']=="dec"){
                $id = "";
                $request = $pdo->query( "select id from abonne where id_session='$rep0'" );
                while ( $row = $request->fetch() ) {
                    $id = $row['id'];
                }
                $requette_insert_history = "insert into history_user (action,valeur,dat,name,ip) VALUES ('deconnection',null,sysdate(),'$id','".getIp()."')";
                $requette_update_abonne = "update abonne set id_session=null where id_session='$rep0'";
                $requette_update_statue =  "update statue_abon set id_session=null,online='non' where id_session='$rep0'";
                $res = $pdo->exec( $requette_insert_history );
                $res = $pdo->exec( $requette_update_abonne );
                $res = $pdo->exec( $requette_update_statue);
                delete_cookie("abon");

            }
            else if(!isset($_GET['redirect']) && empty($_GET['redirect'])){
                header("location:abonne.php");
            }
            else if(!empty($_GET['redirect']) && isset($_GET['redirect']) && $_GET['redirect']=="erreur"){
                $erreur=1;
            }
            
        }
        else if(!empty($_GET['redirect']) && isset($_GET['redirect'])&& $_GET['redirect']=="nocookie"){
          $nocookie = 1;
        }
        else{
            if(!empty($_GET['redirect']) && isset($_GET['redirect']) && $_GET['redirect']=="nococher"){
                $nococher = 1;
            }
            else if(!empty($_GET['redirect']) && isset($_GET['redirect']) && $_GET['redirect']=="erreur"){
                $erreur=1;
            }
        }
        
        ?>
<!DOCTYPE html>
<html>
  <head>
        <?php
            include_once "../php/head_admin.php";
        ?>
  </head>
  <body>
    <div id="haut">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Eighth navbar example">
        <div class="container">
            <a class="navbar-brand" href="#">connextion abonnee</a>
            <a  href="../index.php">retour</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>     
                      
        </div>
      </nav>
    </div>
    <div id="milieux">
            <div class="modal modal-signin position-static d-block bg-secondary py-5" tabindex="-1" role="dialog" id="modalSignin">
                <div class="modal-dialog" role="document">
                  <div class="modal-content rounded-4 shadow">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                      <!-- <h5 class="modal-title">Modal title</h5> -->
                      <h2 class="fw-bold mb-0">connextion abonnee</h2>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
              
                    <div class="modal-body p-5 pt-0">
                      <form class="" method="post" action="connect.php">
                        <?php 
                                if($nococher==1){
                                    echo "<p class='text-danger'>case non cocher</p><br>";
                                }
                                else if($erreur==1){
                                    echo "<p class='text-danger'>erreur password ou identifiant inconnu</p><br>";
                                }
                                else if($nocookie==1){
                                  echo "<p class='text-danger'>erreur les cookie ne son pas activer ou son supprimer</p><br>";
                                }
                        
                        ?>
                        <div class="form-floating mb-3">
                          <input type="text" name="username" class="form-control rounded-3" id="floatingInput" placeholder="name">
                          <label for="floatingInput">username</label>
                        </div>
                        <div class="form-floating mb-3">
                          <input type="password" name="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password">
                          <label for="floatingPassword">Password</label>
                        </div>
                        <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">connection</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
          </div>
    </body>
</html>