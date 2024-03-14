<?php
if(isset($_FILES['file']) && !empty($_FILES['file'])){
    echo $_FILES['file']['name']."<br>";
    echo $_FILES['file']['type']."<br>";
    echo $_FILES['file']['size']."<br>";
    $dir = dirname(__FILE__,2);
    if($_FILES['file']['type']=="image/jpeg"){
        move_uploaded_file($_FILES['file']['tmp_name'],$dir.'/img_profil/'.basename($_GET['id'].".jpg"));
    }
    else{
        echo "ce n'est pas un jpeg";
    }
}
else{
    echo "<p>pas d'image<a href='abonne.php'>retour</a></p>";
}
?>