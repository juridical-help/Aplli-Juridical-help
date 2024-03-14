<h3>formulaire pour répondre</h3>
                    <form method="POST" action="<?php echo "admin/page2.php?rech=".$rep."&motr=".$rep2 ?>" >
                        <label>ecrie la question:</label>
                        <input id="rep" type="text" name="nom"/>
                        <br>
                        <label>ecrire la reponse ou modifier la reponse:</label>
                        <br>
                        <textarea wrap="hard" type="text" name="commantaire"></textarea>
                        <br>
                        <label>supprimer ou modifier une question</label>
                        <input type="checkbox" name="supprimer"/>
                        <br>
                        <input type="submit" value="hello"/>
                    </form>