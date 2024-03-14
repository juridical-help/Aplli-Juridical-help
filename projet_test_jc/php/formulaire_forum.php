
                <?php $link ="php/page0.php?rech=$rep&motr=$rep2";?>
                <form method="POST" action="<?php echo $link ?>" >
                    <?php
                    if(isset($_GET['erreur']) && !empty($_GET['erreur']) && $_GET['erreur']=="champ"){
                        echo "<p class='text-danger'>erreur un champ n'est pas remplis</p>";
                    }
                    ?>
                    <label>votre question:</label>
                    <input type="text" name="commantaire"/>
                    <br>
                    <input type="submit" value="fin"/>
                </form>