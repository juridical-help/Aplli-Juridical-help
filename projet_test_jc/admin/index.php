<?php
            
            include_once "../php/librairie/connextion_db.php";
            include_once "../php/librairie/fonction_php.php";
            $erreur=0;
            if(!empty($_COOKIE['user']) && isset($_COOKIE['user'])){
                $rep0 = $_COOKIE['user'];
                if(!empty($_GET['redirect']) && isset($_GET['redirect']) && $_GET['redirect']=="dec"){
                    $id = "";
                    $request = $pdo->query( "select id from admin where id_session='$rep0'" );
                    while ( $row = $request->fetch() ) {
                        $id = $row['id'];
                    }
                    $res = $pdo->exec( "insert into history (da,name,action) VALUES (sysdate(),'".$id."','deconnection')" );
                    $res = $pdo->exec( "update admin set id_session=null where id_session='$rep0'" );
                    $res = $pdo->exec( "update statue set id_session=null,online='non' where id_session='$rep0'" );
                    delete_cookie("user");

                }
                else if(!isset($_GET['redirect']) && empty($_GET['redirect'])){
                    header("location:admin.php");
                }
                else if($rep2=="erreur"){
                    echo "erreur dans mot de passe";
                }
            }
            else{
                if(!empty($_GET['redirect']) && isset($_GET['redirect']) && $_GET['redirect']=="erreur"){
                    $erreur=1;
                }
            }

        ?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once "../php/head_admin.php";?>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Eighth navbar example">
                <div class="container">
                  <a class="navbar-brand" href="#">connextion admin</a>
                  <a  href="../index.php">retour</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>     
                      
                </div>
        </nav>

        <div id="milieux">
            <div class="modal modal-signin position-static d-block bg-secondary py-5" tabindex="-1" role="dialog" id="modalSignin">
                <div class="modal-dialog" role="document">
                  <div class="modal-content rounded-4 shadow">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                      <!-- <h5 class="modal-title">Modal title</h5> -->
                      <h2 class="fw-bold mb-0">connextion admin</h2>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
              
                    <div class="modal-body p-5 pt-0">
                      <form class="" method="post" action="connect.php">
                        <?php 
                                if($erreur==1){
                                    echo "<p class='text-danger'>erreur password ou identifiant inconnu</p><br>";
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