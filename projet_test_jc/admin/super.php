<button onclick="window.location.href='<?php echo 'index.php?redirect=dec' ?>'">dec</button>
<button onclick="aff('ajouter_admin')">ajouter admin</button>
<button onclick="aff('history')">history</button>
<button onclick="aff('passwordabon')">password abonne</button>
<div id="ajouter_admin">
    <h2>formulaire d'ajout d'admin</h2>
    <form method="POST" action=<?php echo "config_aj.php" ?>>
        <input type="text" name="Nusers"/>
        <br>
        <input type="password" name="password"/>
        <br>
        <label>super:</label>
        <input type="checkbox" name="super"/>
        <label>noob:</label>
        <input type="checkbox" name="noob"/>
        <br>
        <input type="submit" value="fin"/>
    </form>
</div>
<div id="history">
    <h2>historique des connexion</h2>
    <?php
    include_once "../php/librairie/connextion_db.php";
    //$rep0 = $_GET['user'];
    $request = $pdo->query( "select da,name,action from history" );
    while ( $row = $request->fetch() ) {
        echo "<p>".$row['da']."::".$row['name']."::".$row['action']."</p><br>";
    }
    ?>
</div>
<div id="passwordabon">
    <h2>liste des abonne</h2>
    <form method="post" action="config_abonne.php">
    <?php
        $request = $pdo->query( "select id,pass from abonne" );
            while ( $row = $request->fetch() ) {
                echo "<p class='user'>".$row['id']."<input type='text' name='text_".$row['id']."'/><input type='checkbox' class='bouton' name='".$row['id']."'/></p><br>";
            }
            echo "<input type='submit' value='fin'/>";
    ?>
    </form>
</div>
<div id="support">

</div>
