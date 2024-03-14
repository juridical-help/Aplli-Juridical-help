<?php
//fonction qui verifier les identite
function verifi(){
    $stat = "";
    $stat2 = "";
    if(isset($_COOKIE['user']) && isset($_COOKIE['type']) && !empty($_COOKIE['user']) && !empty($_COOKIE['type'])){
        $res = $_COOKIE['user'];
        $res2 = $_COOKIE['type'];
        $requette_sessions_admin = "select id_session,type from admin";
        $request = $GLOBALS['pdo']->query( $requette_sessions_admin );
        while ( $row = $request->fetch() ) {
            if($row['id_session']==$res && hash_equals(hash('ripemd160', $row['type']),$res2)){
                $stat="ok";
            }
        }
    }
    else if(isset($_COOKIE['abon']) && !empty($_COOKIE['abon'])){
        $res = $_COOKIE['abon'];
        $requette_sessions_abonne =  "select id_session from abonne" ;
        $request = $GLOBALS['pdo']->query($requette_sessions_abonne);
        while ( $row = $request->fetch() ) {
            if($row['id_session']==$res){
                $stat2="ok";
            }
        }
    }
    return array($stat,$stat2);
}
//fonction qui supprime les cookie en fonction de l'utilisateur
function delete_cookie($user){
    if($user=="user"){
        setcookie("user","",null,"/");
        setcookie("type","",null,"/");
    }
    else if($user=="abon"){
        setcookie("abon","",null,"/");
    }
}
function counte($colonne){
    $count=0;
    $request = $GLOBALS['pdo']->query( "select count($colonne) from forum0 order by sousrep");
        while ( $row = $request->fetch() ) {
            $count=$row['count('.$colonne.')'];
        }
        return $count;
}

function finde($recherche,$dans){
    if($dans=="question"){

    }
    else if($dans=="theme"){

    }
    return 0;
}

function getIp(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }

function  mise_en_form_donnee($question,$reponse,$user,$incr){
    if($user=="adm"){
        print("
        <div class='chat'>   
            <div class='chat-history'>
                <ul class='chat-ul'>
                <li>
                    <div class='message-data'>
                    <span class='message-data-name'><i class='fa fa-circle you'></i>question</span>
                    </div>
                    <div class='message you-message'>
                    <p  id='n_$incr' onclick=\"select($incr)\" >".$question."</p>

                    </div>
                </li>
                <li class='clearfix'>
                    <div class='message-data align-right'>
                    <span class='message-data-name'>reponse</span> <i class='fa fa-circle me'></i>
                    </div>
                    <div class='message me-message float-right'>".$reponse."</div>
                </li>
                </ul>
                
            </div> <!-- end chat-history -->
            
            </div>
        
        
        ");
    }
    else{
        print("
                                            <div class='chat'>   
                                                <div class='chat-history'>
                                                    <ul class='chat-ul'>
                                                    <li>
                                                        <div class='message-data'>
                                                        <span class='message-data-name'><i class='fa fa-circle you'></i>question</span>
                                                        </div>
                                                        <div class='message you-message'>
                                                        <p>".$question."</p>

                                                        </div>
                                                    </li>
                                                    <li class='clearfix'>
                                                        <div class='message-data align-right'>
                                                        <span class='message-data-name'>reponse</span> <i class='fa fa-circle me'></i>
                                                        </div>
                                                        <div class='message me-message float-right'>".$reponse."</div>
                                                    </li>
                                                    </ul>
                                                    
                                                </div> <!-- end chat-history -->
                                                
                                                </div>
                                            
                                            
                                            ");
    }
}

function verif_post($liste_post){
    $bool = 0;
    $nb_post = count($liste_post);
    $incr = 0;
    foreach($liste_post as $key=>$val){
        if(isset($_POST[$key]) && !empty($_POST[$key])){
            $incr++;
        }
    }
    if($incr==$nb_post){
        $bool=1;
    }
    return $bool;
}

function verif_existe($value,$table){
    $bool = 0;
    $req = $GLOBALS['pdo']->prepare("select * from $table");
    $req->execute();
    while($row = $req->fetch()){
        foreach($row as $key=>$val){
            if($val==$value){
                $bool=1;
            }
        }
    }
    return $bool;
}


function recup($table,$colonne,$condition){
    $req = $GLOBALS['pdo']->prepare("select $colonne from $table where $condition");
    $req->execute();
    return $req->fetchAll();
}
function file_exist($chemin,$name_file){
    $e = dir($chemin);
    $tr = 0;
    while($row=$e->read()){
        if($row==$name_file){
            $tr=1;
        }
    }
    return $tr;
}
?>