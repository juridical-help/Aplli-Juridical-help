<?php include_once "../php/librairie/connextion_db.php";?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once "../php/head_admin.php";?>
        <?php
            $count=0;
            $id02="";
            if(isset($_COOKIE['user']) && !empty($_COOKIE['user'])){
                $request_verif = "select online,id from statue where id_session='".$_COOKIE['user']."'";
                $request = $pdo->query( $request_verif );
                while ( $row = $request->fetch() ) {
                    $count++;
                }
                if($count!=0){
                    $request = $pdo->query( $request_verif );
                    while ( $row = $request->fetch() ) {
                        if($row['online']=="non"){
                            exit();
                            //header("location:../index.html");
                        }
                        else{
                            $id02=$row['id'];
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
                  <a class="navbar-brand" href="#">Compte <?php  echo $id02 ?></a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>     
                      
                </div>
        </nav>
        </div>
        <div id="milieux">
        <?php
            
            if(!empty($_COOKIE['user']) && isset($_COOKIE['user'])){
                $rep0 = $_COOKIE['user'];
                $request = $pdo->query( "select type from admin where id_session='$rep0'" );
                while ( $row = $request->fetch() ) {
                    if($row['type']=='super'){
                        include "super.php";
                    }
                    else if($row['type']=='noob'){
                        echo "<div id='block0'>";
                        include "noob.php";
                        echo "</div>";
                    }
                }
            }

        ?>
        </div>
    </body>
</html>