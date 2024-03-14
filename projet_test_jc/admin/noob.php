<button onclick="window.location.href='<?php echo 'index.php?redirect=dec' ?>'">dec</button>
<button onclick="flide('forumjournale')">forum et journale</button>
<button onclick="flide('contacte')">contacte</button>
<button onclick="flide('support')">support</button>
<div id="forumjournale">
    <a href="../index.php">retour</a>
    <form method="POST" action="config_forum.php">
                    <h2>formulaire pour ajouter ou supprimer des theme ou sous theme</h2>
                    <label>votre theme:</label>
                    <input type="text" name="texte" onkeyup="verif_di(event)" id="theme"/>
                    <br>
                    <label>votre sous theme:</label>
                    <input type="text" name="texte2" onkeyup="verif_di(event)" id="soustheme"/>
                    <br>
                    <label>ajouter</label>
                    <input type="checkbox" name="ajouter_theme"/>
                    <label>supprimer</label>
                    <input type="checkbox" name="supprimer_theme" id="checkfi0"  onchange="resformulaire()"/>
                    <input type="checkbox" name="okok0" id="finl"/>
                    <br>
                    <input type="submit" value="fin"/>
    </form>
                <br>
                <br>
                <br>
    <form method="POST" action="modifier_forum.php">
                    <h2>forumlaire de modification du theme et sous theme du forum</h2>
                    <label>le theme(mettre vide si soustheme a modifier)</label>
                    <br>
                    <input type="text" name="theme"/>
                    <br>
                    <label>le sous theme(mettre vide si theme a modifier)</label>
                    <br>
                    <input type="text" name="soustheme"/>
                    <br>
                    <label>le nouveaux theme ou sous theme:(toujours remplir)</label>
                    <br>
                    <input type="text" name="modifier"/>
                    <br>
                    <label>ajouter theme</label>
                    <input type="checkbox" name="theme1"/>
                    <label>ajouter sous theme</label>
                    <input type="checkbox" name="soustheme1"/>
                    <br>
                    <input type="submit" value="fin"/>
                </form>
            <br>
            <br>
            <br>
            <div id="repondre">
                <div id="forum">
                <?php 
                    $bool=1;
                    include_once "../php/librairie/connextion_db.php";
                    echo "<ul>";
                    include_once "../php/liste.php";
                    echo "</ul>";
                ?>
                </div>
            </div>
            <div id="journale">
                <form method="POST"  action="config_journale.php"  enctype="multipart/form-data" >
                        <label>titre du document:</label>
                        <input type="text" name="title" id="title"/>
                        <br>
                        <label>theme du document:</label>
                        <input type="text" name="theme" id="theme"/>
                        <br>
                        <label>document:</label>
                        <input type="file" name="fichier" id="fichier"/>
                        <br>
                        <label>lien du document:</label>
                        <input type="text" name="lien" id="lien"/>
                        <br>
                        <label>ajouter</label>
                        <input type="checkbox" name="oui"/>
                        <br>
                        <label>suprimer</label>
                        <input type="checkbox" name="non" id="checkfi" onchange="resjournale()"/>
                        <input type="checkbox" id="final" name="okok" />
                        <input type="submit" value="fin"/>
                </form>
            </div>
</div>
<div id="contacte">
    <h2>formulaire contacte</h2>
    <form method="post" action="config_contact.php">
        <label>numero</label>
        <input type="text" name="numero"/>
        <br>
        <label>mail</label>
        <input type="email" name="mail"/>
        <br>
        <label>ajouter</label>
        <input type="checkbox" name="ajout"/>
        <label>supprimer</label>
        <input type="checkbox" name="supp"/>
        <label>modifier</label>
        <input type="checkbox" name="modif"/>
        <br>
        <input type="submit" value="fin"/>
    </form>
</div>
<div id="support">
    <h2>support</h2>
    <?php
    $req = $pdo->prepare("select * from support where statu='en cours'");
    $req->execute();
    while($row=$req->fetch()){
        echo "<p>".$row['theme'].":::::".$row['text']."<button onclick=\"envFait(".$row['id'].")\">fait</button></p>";
    }
    ?>
</div>