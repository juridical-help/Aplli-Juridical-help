<?php
            include_once "../php/librairie/connextion_db.php";
            //$rep = $_POST['user'];
            $rep2 = $_POST['Nusers'];
            $rep3 = hash('ripemd160', $_POST['password']);
            if(!empty($rep2) && !empty($rep3)){
                $requette_tableaux = array("insert into admin (id,pass,type,id_session) VALUES ('$rep2','$rep3','noob','null')","insert into statue (online,id,id_session) VALUES ('non','$rep2','null')","insert into history (da,name,action) VALUES (sysdate(),'super',\"ajout d'un admin\")");
                $res = $pdo->exec($requette_tableaux[0] );
                $res = $pdo->exec( $requette_tableaux[1] );
                $res = $pdo->exec( $requette_tableaux[2] );
                echo $rep2.";".$rep3;
            }

?>