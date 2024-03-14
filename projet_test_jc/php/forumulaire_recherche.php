<div id="recherche">
<?php
//echo "<h2>formulaire de recherche</h2>";
//echo "<input type='text' id='rechercher' name='rechercher' value='rechercher' onfocus='init()'/>";
if(isset($_GET['rech']) && isset($_GET['motr'])){
        $rep01 = $_GET['rech'];
        $rep02 = $_GET['motr'];
    if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) && (!hash_equals($_COOKIE['type'],hash('ripemd160', "super")) || !hash_equals($_COOKIE['type'],hash('ripemd160', "noob")))){
        
        $rep3 = $_COOKIE['user'];
        echo "<input type='text' id='rechercher' name='rechercher' value='rechercher dans forum' onkeyup=\"foncEntry(event,'".$rep01."','".$rep02."','".$rep3."')\" onfocus='init()'/>";
        echo "<button onclick=\"foncButton('".$rep01."','".$rep02."','".$rep3."')\">fin</button>";
    }
    else{
        $rep3="";
        echo "<input type='text' id='rechercher' name='rechercher' value='rechercher dans forum' onkeyup=\"foncEntry(event,'".$rep01."','".$rep02."','".$rep3."')\" onfocus='init()'/>";
        echo "<button onclick=\"foncButton('".$rep01."','".$rep02."','".$rep3."')\">fin</button>";
    }
}
else{
    if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) && (!hash_equals($_COOKIE['type'],hash('ripemd160', "super")) || !hash_equals($_COOKIE['type'],hash('ripemd160', "noob")))){
        $rep3 = $_COOKIE['user'];
        echo "<input type='text' id='rechercher' name='rechercher' value='rechercher dans forum' onkeyup=\"foncEntry(event,null,null,'".$rep3."')\" onfocus='init()'/>";
        echo "<button onclick=\"foncButton(null,null,'".$rep3."')\">fin</button>";
    }
    else{
        $rep3="";
        echo "<input type='text' id='rechercher' name='rechercher' value='rechercher dans forum' onkeyup=\"foncEntry(event,null,null,'".$rep3."')\" onfocus='init()'/>";
        echo "<button onclick=\"foncButton(null,null,'".$rep3."')\">fin</button>";

    }
}

?>
</div>