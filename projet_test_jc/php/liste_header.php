<?php
include_once "php/librairie/connextion_db.php";
include_once "php/librairie/fonction_php.php";
include_once "php/appel_fonc.php";

?>
<div class="collapse navbar-collapse" id="navbarsExample07">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Forum</a>
    <ul class="dropdown-menu men">
<?php
$sous = "";
$sous2 = "";
$sousrep = [];
$nb = [];
$nn = "";
$increm = 0;
$increm=0;
$sous2="";
$sous3 = "";
$sous4 = "";
echo "<li><p class='titre'>partie forum: </p></li>";
$requette = "select theme,sousrep from forum0 order by theme,sousrep";
$request = $pdo->query( $requette );
while ( $row = $request->fetch() ) {
$theme=$row['theme'];
if($theme!=$sous2){
    if($increm>=2){
        echo "<li class='tex seco'>";
    }
    else{
        echo "<li class='tex'>";
    }
    echo "<ul class='blockon'>";
  echo "<li class='nolink'><p class='text-dark nav-link  dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false' >".$theme."</p>";
  echo "<ul class='sousform01'>";
  $requette2 = "select sousrep from forum0 where theme=\"".$theme."\" order by sousrep";
  $request2 = $pdo->query( $requette2 );
  while ( $row2 = $request2->fetch() ) {
      $soustheme = $row2['sousrep'];
      if($sous!=$soustheme){

          if(!isset($_COOKIE['user']) && empty($_COOKIE['user']) || hash_equals($_COOKIE['type'],hash('ripemd160', "super")) || hash_equals($_COOKIE['type'],hash('ripemd160', "noob"))){
                  echo "<li><a href=\"page_forum.php?rech=".$row['theme']."&motr=".$row2['sousrep']."\">".$row2['sousrep']."</a></li>";
          }
          else if(isset($_COOKIE['user']) && !empty($_COOKIE['user'])){
              echo "<li><a href=\"../page_forum.php?rech=".$row['theme']."&motr=".$row2['sousrep']."\">".$row2['sousrep']."</a></li>";
          }
              
          $sous = $soustheme;
      }
      else{
          $sous=$soustheme;
      }
      
  }
  echo "</ul></li>";
  $sous="";
  echo "</ul>";
  echo "</li>";
  
  $sous2 = $theme;
  $increm++;
}
else{
  $sous2=$theme;

}

}

?>
</ul>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">journal</a>
<ul class="dropdown-menu men">
<?php
$sous = "";
                    $increm=0;
                    $sous2="";
                $sous3 = "";
                $sous4 = "";
                echo "<li><p class='titre'>partie journale: </p></li>";
                          $requette_journale = "select theme from journale order by theme";
                          $request = $pdo->query( $requette_journale );
                          while ( $row = $request->fetch() ) {
                              if($sous3!=$row['theme']){
                                  echo "<li class='tex'>";
                                  echo "<ul class='blockon'>";
                                  echo "<li class='nolink'><p class='text-dark nav-link dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>".$row['theme']."</p>";
                                  echo "<ul class='sousform01'>";
                                  $requette_journale2 = "select titre,lien from journale where theme=\"".$row['theme']."\"";
                                  $request2 = $pdo->query( $requette_journale2);
                                  while ( $row2 = $request2->fetch() ) {
                                      echo "<li>";
                                      if(!isset($_COOKIE['user']) && empty($_COOKIE['user']) || hash_equals($_COOKIE['type'],hash('ripemd160', "super")) || hash_equals($_COOKIE['type'],hash('ripemd160', "noob"))){
                                          echo "<a href=\"page_journal.php?theme=".$row['theme']."&lien=".$row2['lien']."&titre=".$row2['titre']."\">".$row2['titre']."</a>";
                                      }
                                      else if(isset($_COOKIE['user']) && !empty($_COOKIE['user'])){
                                          echo "<a href=\"../page_journal.php?theme=".$row['theme']."&lien=".$row2['lien']."&titre=".$row2['titre']."\">".$row2['titre']."</a>";
                                      }
                                      echo "</li>";
                                  }
                                  echo "</ul></li>";
                                  echo "</ul>";
                                  echo "</li>";
                                  $sous3=$row['theme'];
                                  if($increm>=2){
                                      echo "<br>";
                                  }
                                  $increm++;
                              }
                              else{
                                  $sous3=$row['theme'];
                              }
                          }
            


?>
</ul>
</li>
<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">other</a>
                        <ul class="dropdown-menu men">
                            <li class="tex"><a href="support.php">support</a></li>
                            <li class="tex"><a href="contacte.php">contact</a></li>
                            <li class="tex"><a href="info.php">info</a></li>
                        </ul>
</ul>