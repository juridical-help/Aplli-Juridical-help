<?php
if($bool==0){
    include_once "php/librairie/connextion_db.php";
    include_once "php/librairie/fonction_php.php";
    include_once "php/appel_fonc.php";
}

?>
<div class="flex-shrink-0 p-3 bg-white" style="width: 400px; height:500px;">
                    <a href="#" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
                      <svg class="bi pe-none me-2" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
                      <span class="fs-5 fw-semibold">resume du site</span>
                    </a>
                    <ul class="list-unstyled ps-0">
                      <li class="mb-1">
                        <button data-toggle="tooltip" data-placement="top" title="clicker pour voir" class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                          Forum
                        </button>
                        <div class="collapse show" id="home-collapse">
                          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <?php
                            $sous = "";
                            $sous2 = "";
                            $sousrep = [];
                            $nb = [];
                            $nn = "";
                            echo "<li>";
                            $requette_select = "select theme,sousrep from forum0 order by theme,sousrep";
                            $request = $pdo->query( $requette_select );
                            while ( $row = $request->fetch() ) {
                                $theme=$row['theme'];
                                if($theme!=$sous2){
                                    echo "<ul class='form'>";
                                    echo "<li>";
                                    echo $theme;
                                    echo "<ul class='sousform'>";
                                    $requette_select2 = "select sousrep from forum0 where theme=\"".$theme."\" order by sousrep";
                                    $request2 = $pdo->query( $requette_select2 );
                                    while ( $row2 = $request2->fetch() ) {
                                        $soustheme = $row2['sousrep'];
                                        if($sous!=$soustheme){
                                            
                                            if(!isset($_COOKIE['user']) && empty($_COOKIE['user']) || ($_COOKIE['type']!="" && $bool==0)){
                                                echo "<li><a href=\"page_forum.php?rech=".$row['theme']."&motr=".$row2['sousrep']."\">".$row2['sousrep']."</a></li>";
                                            }
                                            else if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) && $bool==1){
                                                echo "<li><a href=\"../page_forum.php?rech=".$row['theme']."&motr=".$row2['sousrep']."\">".$row2['sousrep']."</a></li>";
                                            }
                                                
                                            $sous = $soustheme;
                                        }
                                        else{
                                            $sous=$soustheme;
                                        }
                                        
                                    }
                                    echo "</ul>";
                                    $sous="";
                                    echo "</li>";
                                    echo "</ul>";
                                    echo "<br>";
                                    $sous2 = $theme;
                                }
                                else{
                                    $sous2=$theme;
        
                                }
                            }

                                ?>
                          </ul>
                        </div>
                      </li>
                      <li class="mb-1">
                        <button data-toggle="tooltip" data-placement="top" title="clicker pour voir" class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                            journal
                        </button>
                        <div class="collapse" id="dashboard-collapse">
                          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <?php
                            $sous2="";
                            $sous3 = "";
                            $sous4 = "";
                            //echo "</li>";
                            echo "<li>";
                            echo "<ul class='form'>";
                            $request = $pdo->query( "select theme from journale order by theme" );
                            while ( $row = $request->fetch() ) {
                                if($sous3!=$row['theme']){
                                    echo "<li>";
                                    echo $row['theme'];
                                    echo "<ul class='sousform'>";
                                    $requette_select3 = "select titre,lien from journale where theme=\"".$row['theme']."\"";
                                    $request2 = $pdo->query( $requette_select3);
                                    while ( $row2 = $request2->fetch() ) {
                                        echo "<li>";
                                        if(!isset($_COOKIE['user']) && empty($_COOKIE['user']) || ($_COOKIE['type']!="" && $bool==0) /*$_COOKIE['type']=="super" || $_COOKIE['type']=="noob"*/){
                                            echo "<a href=\"page_journal.php?theme=".$row['theme']."&lien=".$row2['lien']."&titre=".$row2['titre']."\">".$row2['titre']."</a>";
                                        }
                                        else if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) && hash_equals($_COOKIE['type'],hash('ripemd160', "noob")) && $bool==1){
                                            echo "<a href=\"../page_journal.php?theme=".$row['theme']."&lien=".$row2['lien']."&titre=".$row2['titre']."\">".$row2['titre']."</a>";
                                        }
                                        echo "</li>";
                                    }
                                    echo "</ul>";
                                    echo "</li>";
                                    $sous3=$row['theme'];
                                }
                                else{
                                    $sous3=$row['theme'];
                                }
                            }
                            echo "</ul>";
                            echo "</li>";

                            ?>
                          </ul>
                        </div>
                      </li>
                      <li class="mb-1">
                        <button data-toggle="tooltip" data-placement="top" title="clicker pour voir" class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                          other
                        </button>
                        <div class="collapse" id="orders-collapse">
                          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href='contacte.php'>contacte</a></li>
                          <!--<li><a href='support.php'>support</a></li>-->
                            <li><a href='info.php'>info du site</a></li>
                          </ul>
                        </div>
                      </li>
                      <li class="border-top my-3"></li>
                      <?php
            if(isset($_COOKIE['abon']) && !empty($_COOKIE['abon']) && $liste[1]=="ok"){
                print('<li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                  abonnee
                </button>
                <div class="collapse" id="account-collapse">
                  <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="abonne/abonne.php">information personnel</a></li>
                <li><a href="support.php">support</a></li>
                  </ul>
                </div>
              </li>
                ');
            }        
                //setcookie("abon","oscar",time()+3600);
                    
                ?>

                    </ul>
                  </div>

