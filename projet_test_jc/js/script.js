function foncEntry(event,x,y,z,t){
    if(event.keyCode=="13"){
        let find = document.getElementById("rechercher").value;
        
        if(z=="null"){
            
            if(x!=null && y!=null){
                if(x.includes("#")){
                    x=x.replace("#","'");
                }
                else if(y.includes("#")){
                    y=y.replace("#","'");
                }
                window.location.href = "page_forum.php?rech="+x+"&motr="+y+"&find="+find;
            }
            else{
                window.location.href = "page_find.php?find="+find;
            }
        }
        else if(z!="null"){
            if(x!=null && y!=null){
                if(x.includes("#")){
                    x=x.replace("#","'");
                }
                else if(y.includes("#")){
                    y=y.replace("#","'");
                }
                window.location.href = "page_forum.php?rech="+x+"&motr="+y+"&find="+find;
            }
            else{
                window.location.href = "page_find.php?find="+find;
            }
        }
    }
}


function foncButton(x,y,z,t){
        let find = document.getElementById("rechercher").value;
        if(z==""){
            if(x!=null && y!=null){
                
                window.location.href = "page_forum.php?rech="+x+"&motr="+y+"&find="+find;
            }
            else{
                window.location.href = "page_find.php?find="+find;
            }
        }
        else if(z!=""){
            if(x!=null && y!=null){
                
                window.location.href = "page_forum.php?rech="+x+"&motr="+y+"&find="+find;
            }
            else{
                window.location.href = "page_find.php?find="+find;
            }
        }
}


function init(event){
    let find = document.getElementById("rechercher").value="";

}
after = "";
function aff(x){
    if(after!=""){
        let af = document.getElementById(x).style.display="block";
        document.getElementById(after).style.display="none";
        after=x;
    }
    else{
        let af = document.getElementById(x).style.display="block";
        after=x;
    }
}

function resjournale(){
    let check = document.getElementById("checkfi");
    let titre = document.getElementById("title");
    let theme = document.getElementById("theme");
    let lien = document.getElementById("lien");
    if(check.checked==true && titre.value=="" && theme.value=="" && lien.value==""){
        document.getElementById("final").style.display="block";
    }
    else if(check.checked==false){
        document.getElementById("final").style.display="none";
    }
}

function resformulaire(){
    let check = document.getElementById("checkfi0");
    let theme = document.getElementById("theme");
    let soustheme = document.getElementById("soustheme");
    if(check.checked==true && theme.value=="" && soustheme.value==""){
        document.getElementById("finl").style.display="block";
    }
    else if(check.checked==false){
        document.getElementById("finl").style.display="none";
    }
}

function select(x){
    res = 0;
    rest = "";
    let val = document.getElementById("n_"+x).textContent;
    val2 = val.replace("question:","");
    document.getElementById("rep").value = val2;
}

after2="";
function flide(x){
    if(after2==""){
        document.getElementById(x).style.display="block";
        after2=x;
    }
    else if(after2!=""){
        document.getElementById(x).style.display="block";
        document.getElementById(after2).style.display="none";
        after2=x;
    }
}

function sup(){
    let user = document.getElementsByClassName("user");
    let ch = document.getElementsByClassName("bouton");
    for(let i=0;i<ch.length;i++){
        if(ch[i].checked){
            alert(user[i].textContent);
        }
    }
}

function verif_di(event){
    return 0;
}

function rech(x,y,z,t){
    let find = document.getElementById("rechercher").value;
        if(z=="null"){
            if(x!=null && y!=null){
                if(x.includes("#")){
                    x=x.replace("#","'");
                }
                else if(y.includes("#")){
                    y=y.replace("#","'");
                }
                //request("php/find_header/find-3.php?rech="+x+"&motr="+y+"&find="+find);
            }
            else{
                request("php/find.php?find="+find);
            }
        }
        else if(z!="null"){
            if(x!=null && y!=null){
                if(x.includes("#")){
                    x=x.replace("#","'");
                }
                else if(y.includes("#")){
                    y=y.replace("#","'");
                }
                //request("php/find_header/find-3.php?rech="+x+"&motr="+y+"&find="+find);
            }
            else{
                request("php/find.php?find="+find);
            }
        }
}


function request(url){
    let rech = document.getElementById("recherche");
    let tr = rech.querySelectorAll("#div_champ");
    if(tr){
        for(let i=0;i<tr.length;i++){
            tr[i].remove();
        }
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState==4 && this.status == 200){
            nb=this.response;
            let div = document.createElement("div");
            div.id = "div_champ";
            div.style.backgroundColor="white";
            div.style.position = "absolute";
            div.style.borderRadius = "15px";
            div.style.border = "double";
            div.innerHTML = nb;
            document.getElementById("recherche").appendChild(div);
            let lien = div.querySelectorAll("a");
            for(let i=0;i<lien.length;i++){
                lien[i].style.textDecoration = "none";
                lien[i].style.color = "black";
                lien[i].style.borderColor = "blue";
                lien[i].style.borderRadius = "15px";
            }

            
        }
    };
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

function change(){
    let recherhce = document.getElementById("recherche");
    let div = recherhce.querySelectorAll("#div_champ");
    //alert(recherhce.querySelectorAll("#div_champ:hover").length);
    //alert(recherhce.querySelectorAll("#div_champ a:hover").length);
    if(!recherhce.querySelectorAll("#div_champ:hover").length || !recherhce.querySelectorAll("#div_champ a:hover").length){
        for(let i=0;i<div.length;i++){
            div[i].remove();
        }
    }
}
function envFait(id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET","script_support_fait.php?id="+id,true);
    xmlhttp.send();
    window.location.href = "admin.php";
}