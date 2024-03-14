
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Eighth navbar example">
                <div class="container">
                  <a class="navbar-brand" href="index.php">Juridical-help</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <?php include_once "liste_header.php";?> 
                  <div id="recherche">
                    <?php
                      //echo "<h2>formulaire de recherche</h2>";
                      //echo "<input type='text' id='rechercher' name='rechercher' value='rechercher' onfocus='init()'/>";
                      if(isset($_GET['rech']) && isset($_GET['motr'])){
                              $rep01 = $_GET['rech'];
                              $rep01 = str_replace("'","#",$rep01);
                              $rep02 = $_GET['motr'];
                              $rep02 = str_replace("'","#",$rep02);
                          if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) && (!hash_equals($_COOKIE['type'],hash('ripemd160', "super")) || !hash_equals($_COOKIE['type'],hash('ripemd160',"noob")))){
                              
                              $rep3 = $_COOKIE['user'];
                              echo "<input  class='form-control' type='search' placeholder='Search forum' aria-label='Search' id='rechercher' name='rechercher' value='rechercher dans forum'  oninput='rech(\"".$rep01."\",\"".$rep02."\",\"".$rep3."\")' onkeyup='foncEntry(event,\"".$rep01."\",\"".$rep02."\",\"".$rep3."\")' onfocus='init(event)'/>";
                              //echo "<button onclick=\"foncButton('".$rep01."','".$rep02."','".$rep3."')\">fin</button>";
                          }
                          else{
                              $rep3="null";
                              echo "<input  class='form-control' type='search' placeholder='Search forum' aria-label='Search' id='rechercher' name='rechercher' value='rechercher dans forum'   oninput='rech(\"$rep01\",\"$rep02\",\"$rep3\")' onkeyup='foncEntry(event,\"$rep01\",\"$rep02\",\"$rep3\")' onfocus='init(event)'/>";
                              //echo "<button onclick=\"foncButton('".$rep01."','".$rep02."','".$rep3."')\">fin</button>";
                          }
                      }
                      else{
                          if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) && (!hash_equals($_COOKIE['type'],hash('ripemd160', "super")) || hash_equals($_COOKIE['type'],hash('ripemd160',"noob")))){
                              $rep3 = $_COOKIE['user'];
                              echo "<input  class='form-control' type='search' placeholder='Search forum' aria-label='Search' id='rechercher' name='rechercher' value='rechercher dans forum'   oninput=\"rech(null,null,'".$rep3."')\" onkeyup=\"foncEntry(event,null,null,'".$rep3."')\" onfocus='init(event)'/>";
                              //echo "<button onclick=\"foncButton(null,null,'".$rep3."')\">fin</button>";
                          }
                          else{
                              $rep3="null";
                              echo "<input  class='form-control' type='search' placeholder='Search forum' aria-label='Search' id='rechercher' name='rechercher' value='rechercher dans forum'  onblur='change()'  oninput=\"rech(null,null,'".$rep3."')\" onkeyup=\"foncEntry(event,null,null,'".$rep3."')\" onfocus='init(event)'/>";
                              //echo "<button onclick=\"foncButton(null,null,'".$rep3."')\">fin</button>";
                      
                          }
                      }
                      
                      ?>
                    </div>
                  <div class="flex-shrink-0 dropdown">
                        <a data-toggle="tooltip" data-placement="top" title="clicker pour voir" href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          <?php
                          $img_default = '<img src="img_profil/98681.jpg" alt="mdo" width="32" height="32" class="rounded-circle">';
                          if(verifi()[1]){
                            $id = (recup("abonne","id","id_session='".$_COOKIE['abon']."'"))[0]['id'];
                            if(file_exist("img_profil",$id.".jpg")==1){
                              echo '<img src="img_profil/'.$id.'.jpg" alt="mdo" width="32" height="32" class="rounded-circle">';
                            }
                            else if(file_exist("img_profil",$id.".jpg")!=1){
                              echo $img_default;
                            }
                          }
                          else if(verifi()[1]==""){
                            echo $img_default;
                          }
                          ?>  
                        
                        </a>
                        <ul class="dropdown-menu text-small shadow">
                          <li><a class="dropdown-item" href="abonne/index.php">abonne</a></li>
                          <li><a class="dropdown-item" href="admin/index.php">admin</a></li>
                        </ul>
                      </div>
                  </div>
                </div>
              </nav>