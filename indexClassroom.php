<?php
session_start();


//$_SESSION['id_account'] = 13;

include 'ClassManager.php';
include '../Locale/IndexProfileScreen/retrieveProjects.php';



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My MindFlow - Classroom</title>
    <link rel="stylesheet" href="../IMAGES/Fonts.css">
   <?php include '../IMAGES/styleSheet.php'; ?>
   
   <script src="../Locale/IndexProfileScreen/SocialButtonFunction.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script type="text/javascript">
        var contone =0;
       document.addEventListener("scroll", function() {
        var navbar = document.getElementById("Barra");
        if (window.scrollY > 200) {
            navbar.classList.add("fixed");
        } else {
            navbar.classList.add("sticky");
        }
        });
        function SparimentazioneBarraLaterale(){
            contone = contone+1;
            console.log(contone);
           
            if(contone==1){
                document.querySelector(".Lateral").classList.toggle("slide-out-blurred-left");
                setTimeout(function() {
                    document.getElementById("Lateral").style="display: none";
                    document.getElementById("content").style="width: 100%";
                    document.getElementById("content").style.marginLeft="5vw";
                   
                }, 600);
                
            }
            
            else if(contone=2){
                contone=0;
                document.querySelector(".Lateral").classList.toggle("slide-in-blurred-left");
                document.getElementById("Lateral").style="display: flex";  
                document.getElementById("content").style.marginLeft="22vw";
                document.getElementById("content").style="width: 84%";
                setTimeout(function() {
                    document.querySelector(".Lateral").classList.remove("slide-in-blurred-left");
                    document.querySelector(".Lateral").classList.remove("slide-out-blurred-left");
                    
                }, 600);            
                
                
            }


            
        }
        
        
function Descrizione(id_prog){
		console.log(id_prog)
 		$.ajax({
                    type : 'POST',
                    url : '../../Social/PostManager.php',
                    data : {
                        operazione : 'getPostInfo',
                        id: id_prog
                    },
                    success : function(retPar){
                            //console.log(JSON.parse(retPar))
                            //result = retPar.split("</html>").pop()
                           // document.getElementById('content').innerHTML = retPar;
                            //document.getElementById('like'+id_pos).src='stile/liked.png';
                               result = JSON.parse(retPar)
                            
                            window.document.getElementById('titolo_progetto').innerHTML = result['titolo']
                            window.document.getElementById('descrizione').innerHTML = "<b>Descrizione: </b>" + result['descrizione']
                            window.document.getElementById('durata').innerHTML = 'Build time: ' + result['durata']
                            window.document.getElementById('numero_like').innerHTML = 'Likes: ' +result['numero_like']
                            window.document.getElementById('post_image').src = result['immagine']
                            document.getElementById("Descrizione").style.display='block';
                            //document.getElementById("Descrizione").style.z-index=13;
                    }
                }) 
    
}
function Chiusura(){
	document.getElementById("Descrizione").style.display='none';
}


        
function openProject(id){
				$.ajax({
                    type : 'POST',
                    url : 'ClassManager.php',
                    data : {
                        action : 'openProject',
                        id_progetto : id
                    },
                    success : function(retPar){
                            console.log(retPar)
                            window.location.replace('https://mindflow.altervista.org/Locale/ProjectsScreens/indexProject.php');
                    }
                }) 
}
        
function loadAllProject(id_progetto){
			$.ajax({
                    type : 'POST',
                    url : 'ClassManager.php',
                    data : {
                        action : 'loadProject',
                        id_progetto : id_progetto
                    },
                    success : function(retPar){
                            console.log(retPar)
                            document.getElementById('content').innerHTML = retPar;	
                    }
                }) 

}
      function Homing(){
      	window.location.href ="https://mindflow.altervista.org/Locale/IndexProfileScreen/IndexProfile.php";
      }
      
      
    </script>
     <style>
    	.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 100px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 4px 0;
  position: absolute;
  font-size: 15px;
  font-family: Nordique;
  z-index: 1;
  bottom: 50%;
  left: 50%;
  margin-left: -60px;
  opacity: 0;
  transition: opacity 0.3s;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
    </style>
    <?php include '../styleSheet.php'; ?>
</head>



<!-- sistema la barra laterale-->
<body style="display: flex; flex-direction: column; margin: 0;">

	<div id="Barra" >
    	<div style="display: flex; flex-direction: row; align-items: center; ">
        	<div ><img src="../IMAGES/menu.png" alt="Menu" id="Menu" onclick = "SparimentazioneBarraLaterale()"></div>
        	<div id="Titolo" onclick='window.location.replace("../Locale/IndexProfileScreen/IndexProfile.php")' >MINDFLOW</div>
        </div>
        <div style="display: flex; flex-direction: row; align-items: center; gap: 2.4vw; margin-right: 2vw;">
        	<div> <form action = 'addCartella.php' >
            	<input style="background-color: #5A7FD7; font-family: OstrichSans-Heavy; font-size: 15pt; padding: 8px; margin-top: 0;" type = 'submit' value = 'New Folder'>
            	</form>
            </div>
        	<div class="search-bar">
        		<form action = '../Social/indexSocial.php' method = 'POST'>
            		<input  name = "search" type="text" class="search-input" placeholder="Don't have any ideas?...">
            		<button type = 'submit' class="search-button">Search</button>
				</form>
        	</div>
        	<div id="Classroom" class="tooltip"><img src="../IMAGES/social.png" alt="Social" title="Social" class="Barra" onclick = 'window.location.replace("../Social/indexSocial.php")'></div>
        <div id="Classroom" class="tooltip"><img src="../IMAGES/Classroom.png" alt="Classroom" title="Classroom" class="Barra" onclick = 'window.location.replace("../Classroom/indexClassroom.php")'></div>
        
        	<div id="ProfilePhoto"><img style="border-radius: 15px; width:30px; height: 30px;" src="<?php echo getAccountInfos($_SESSION['id_account'], 'foto_profilo');?>" alt="Foto Profilo" class="Barra"></div>
        </div>
    </div>



   <div id="WorkSpace" style="display: flex; flex-direction: row;  margin-top: 10vh;"><!--change attributes-->

	<!--side menu-->
    <!--new side menu-->
    <div id="Lateral" class = "Lateral" >
            <div><img style="border-radius: 60px; widht: 120px; height: 120px;" id="ProfileImageBig" src="<?php echo getAccountInfos($_SESSION['id_account'],'foto_profilo');?>" alt="FotoProfilo"></div>
            <div style="margin-bottom: 1vh;" id="NomeCognome"><?php echo getAccountInfos($_SESSION['id_account'],'nome_utente');?> <?php echo getAccountInfos($_SESSION['id_account'], 'cognome_utente');?></div>
            <div id="Username"><?php echo getAccountInfos($_SESSION['id_account'],'username_utente');?></div>
            <div>
            <form action = "../Locale/IndexProfileScreen/UpdateAccountInfo.phpUpdateAccountInfo.php" method = "post">
        		<input id="EditButton" type = "submit" value = "EDIT">
        	</form>
            
            </div>
            <div id="Dati">
                <div class="AccountDetails" onclick = 'mostraAmici()'>
                    <div id="NumeroFollowers"><?php echo countFriends();?></div>
                    <div style="font-size: 10pt;">Friends</div>
                </div>
                <div class="AccountDetails" onclick = 'mostraPropriPost()'>
                    <div id="NumeroLikes"><?php echo countlikes();?></div>
                    <div style="font-size: 10pt;">Likes</div>
                </div>
                <div class="AccountDetails"  onclick = 'mostraPostPiaciuti()'>
                    <div id="NumeroLiked"><?php echo countPostPiaciuti();?></div>
                    <div style="font-size: 10pt;">Liked</div>
                </div>
                
            </div>
        </div>
        
        <div id = 'searchBar' style = 'display: none;'></div>
	<div id="content" style = ' width:80%;'>
		<div id = "projects">
        <!--<div id = 'content' style = 'width:100%;'>-->
          <?php echo getClass() ?>
        </div>
                                   

    	</div>
	</div>
	<div id="Descrizione" style="position: fixed; top:0; z-index: 10; width: 100%; height: 100%; display:none; margin: 0;">
<div  style=" background-color: rgb(0,0,0); background-color: rgba(0,0,0, 0.4); z-index: 1; width: 100%; height: 100%;  padding-top: 10vh;">
<div  style=" font-family: OstrichSans-Heavy; display:flex; flex-direction: column; margin:0 auto; width: 70vw;  background-color: #262626; color: white; font-size: 20pt; padding: 20px; border: none; border-radius:20px; z-index: 3;">
	<div style="margin:0 auto;"><img id = 'post_image' style="margin:0 auto; max-width:70vw; height: 40vh; border-radius: 20px;"></div>
    <div>
    	<div id = 'titolo_progetto' style='font-size: 35px; margin:0 auto; margin-bottom: 0.5vh;'>Titolo progetto</div>
        <div id = 'descrizione' style='font-family: Nordique; font-size: 15px; margin:0 auto; margin-bottom: 1vh;'> <b>Descrizione:</b> progètto s. m. [dal fr. projet, der. di projeter: v. progettare]. – 1. a. Ideazione, piano, proposta per l’esecuzione di a monte, è fallito, è naufragato; che progetti hai per queun lavoro o di una serie di lavori: p. di bonifica; p. di nuove costruzioni, di nuovi impianti; il p. dell’ampliamento dell’autostrada; essere in p., di ciò che è in fase di progettazione, della cui realizzazione si sta concretando l’idea: è in p. la costruzione di una galleria sotto la collina; era in p. di abbattere la vecchia cinta di mura. b. Più genericam., idea, proposito più o meno definito, riguardo a qualcosa che si ha intenzione di fare o d’intraprendere: il p. di un viaggio all’estero; fare progetti di matrimonio; il p. è andato st’estate?; hai qualche p. per stasera?; fare progetti; comunicare a qualcuno i proprî p.; mettere qualcuno a parte di un p.; lasciar</div>
        <div style='font-size: 25px; margin:0 auto; display: flex; justify-content: space-between;'>
        	<div id = 'durata'>Build time: 20 days</div>
            <div style='display: flex; align-items: center;'>
            	<div id = 'numero_like'>Likes: 38</div>
                <div><img src="../../IMAGES/like.png" style='height: 25px;'></div>
                
            </div>
            <div onclick="Chiusura()" style='font-size: 20px; text-align: center; justify-content: center; align-content: center; border: none; border-radius: 10px; background-color:#5A7FD7; padding: 1vh; padding-right: 3vh; padding-left: 3vh;' >Back</div>
        </div>
    </div>
</div>
</div>
</div>

</body>



</html>
