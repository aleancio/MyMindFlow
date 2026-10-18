<?php
session_start();
include 'retrieveProjects.php';  

//echo $_POST['id_progetto'];

unset($_SESSION['fromClassroom']);

if(isset($_POST['modifica_ultimo_accesso'])){
	setLastMod();
    unset($_POST['modifica_ultimo_accesso']);
    //echo '<script>window.location.reload()</script>';

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My MindFlow</title>
    <link rel="stylesheet" href="../../IMAGES/Fonts.css">
    <!--<link rel="stylesheet" href="IMAGES/HomeScreen.css">-->
    
    
   
     <script src="https://code.jquery.com/jquery-3.6.4.js"></script>  
     <script src="SocialButtonFunction.js"></script>
     <script src="../../Social/script.js"></script>
     <script type="text/javascript">
       
///////////////////////////LATERAL MENU///////////////////////       
       document.addEventListener("scroll", function() {
        var navbar = document.getElementById("Barra");
        if (window.scrollY > 200) {
            navbar.classList.add("fixed");
        } else {
            navbar.classList.add("sticky");
        }
        });
////////////////////////////////MOSTRA DESCRIZIONE PIACIUTI/////////////////////////////

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


        
   
   
///////////////////// ALTRO /////////////
        
        function showOnlineImage(retPar){
        		iconaOnline = window.document.getElementById('Online/Offline');
        	   if(retPar == "online"){
               		iconaOnline.src = 'IMAGES/ChatOnline.png' //Online
               }
               else
                 {
                   iconaOnline.src = 'IMAGES/ChatOffline.png' //offline
                }
        
        }
        
        function handleChangeStateClick(cambio)
        {
			$.ajax({
                    type : 'POST',
                    url : 'modificaStatoAccount.php',
                    data : {
                    	a : cambio
                    },
                    success : function(retPar){
                    		//result = JSON.parse(retPar);
                            
                             console.log(retPar)
							//showOnlineImage(retPar)
                            
                    }
                })       	
        }
        
        
        function ordinaPer(parametro, identifica){
			$.ajax({
                    type : 'POST',
                    url : 'retrieveProjects.php',
                    data : {
                    	criterio : parametro,
                        riordina : identifica
                    },
                    success : function(retPar){
                    		//result = JSON.parse(retPar);
                             console.log(retPar)
                             console.log('id : '+identifica)
                             document.getElementById(identifica).innerHTML = retPar; 
                    }
                })              
        
        }
        
        
        var contone =0;
        var keepPosition;
        
window.onload = function(){
        	//handleChangeStateClick("a");
            b = "<?php echo getAccountInfos($_SESSION['id_account'], 'stato_account');  ?>"
            console.log(b);
           // showOnlineImage(b)
		
            document.getElementById("Lateral").style="<?php echo $_SESSION['current_lateral_status']; ?>";
            if("<?php echo $_SESSION['current_lateral_status']; ?>" == "display: none"){
                   document.getElementById("content").style="margin-left: 5%; width:90%;";
                   contone = 1
            
            }
            
            
            
        }
        
        

       /*document.addEventListener("scroll", function() {
        var navbar = document.getElementById("Barra");
        if (window.scrollY > 200) {
            navbar.classList.add("fixed");
        } else {
            navbar.classList.add("sticky");
        }
        });*/
        function SparimentazioneBarraLaterale(){
            contone = contone+1;
           
            if(contone==1){
                document.querySelector(".Lateral").classList.toggle("slide-out-blurred-left");
                
                setTimeout(function() {
                keepPosition = "display: none";
                    document.getElementById("Lateral").style="display: none";
                    document.getElementById("content").style="margin-left: 2%; width:98%;";
                    //document.getElementById("all").style="margin-left: 5%; width: 95vw;";
                    /*document.getElementById("all").style="width: 50%";*/
                    keepLateralStatus()
                }, 600);
                
            }
            
            else if(contone=2){
                contone=0;
                document.querySelector(".Lateral").classList.toggle("slide-in-blurred-left");
                document.getElementById("Lateral").style="display: flex"; 
                keepPosition = "display: flex";
                document.getElementById("content").style="margin-left: 22vw; width:76%";
                setTimeout(function() {
                    document.querySelector(".Lateral").classList.remove("slide-in-blurred-left");
                    document.querySelector(".Lateral").classList.remove("slide-out-blurred-left");
                    keepLateralStatus()
                    
                }, 600);            
                
                
            }


            
        }
        
        function keepLateralStatus(){
			$.ajax({
                    type : 'POST',
                    url : 'retrieveProjects.php',
                    data : {
						lateral_status : keepPosition
                    },
                    success : function(retPar){
                    		//result = JSON.parse(retPar);
                            
                             console.log(retPar)
							
                            
                    }
                })                  
        }
        
        
      function hideContent(par){
                	//window.document.getElementById("content").classList.toggle("hide");
                    document.getElementById('projects').innerHTML = ' '
                    var param;
                    
                    if(par == 'hide'){
                    	param = window.document.getElementById('toSearch').value;
                    }
                    else{
                    	param = '&&&&&&&';
                    }
                    
                  $.ajax({
                    type : 'POST',
                    url : 'retrieveProjects.php',
                    data : {
						toSearch : param
                    },
                    success : function(retPar){
                    		//result = JSON.parse(retPar);
                             document.getElementById('projects').innerHTML = retPar
							console.log(document.getElementById('projects').innerHTML)
                            
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
        
        
        /*.tooltip2 {
          position: relative;
          display: inline-block;
          border-bottom: 1px dotted black;
          width: 30px;
          height: 30px;
        }*/

        .UserProject .tooltiptext {
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

        .UserProject:hover .tooltiptext {
          visibility: visible;
          opacity: 1;
        }
    </style>
    
    
    
 <?php include '../../styleSheet.php'; ?>   
    
</head>
<body style="background-color: #ececec; display: flex; flex-direction: column; margin: 0;">

<!--top bar-->
<!--new top bar-->
    <div id="Barra" >
    	<div style="display: flex; flex-direction: row; align-items: center; ">
        <div ><img src="../../IMAGES/menu.png" alt="Menu" id="Menu" onclick = "SparimentazioneBarraLaterale()"></div>
        <div id="Titolo" onclick='window.location.replace("../../Locale/IndexProfileScreen/IndexProfile.php")' >MINDFLOW</div>
        </div>
        <div style="display: flex; flex-direction: row; align-items: center; gap: 2.4vw; margin-right: 2vw;">
        <div> <form action = 'CreateProject.html' method = 'post'>
            	<input style="background-color: #5A7FD7; font-family: OstrichSans-Heavy; font-size: 15pt; padding: 8px; margin-top: 0;" type = 'submit' value = 'Create a new project'>
            </form></div>
        <div class="search-bar">
        <form action = '../../Social/indexSocial.php' method = 'POST'>
        
            <input  name = "search" type="text" class="search-input" placeholder="Don't have any ideas?...">
            <button type = 'submit' class="search-button">Search</button>
        
        </form>
        </div>
        <div id="Classroom" class="tooltip"><img src="../../IMAGES/social.png" alt="Classroom" title="Social" class="Barra" onclick = 'window.location.replace("../../Social/indexSocial.php")'></div>
        <div id="Classroom" class="tooltip"><img src="../../IMAGES/Classroom.png" alt="Classroom" title="Classroom" class="Barra" onclick = 'window.location.replace("../../Classroom/indexClassroom.php")'></div>
        <!--<div id="Chat" ><img id = "Online/Offline"src="IMAGES/Chat.png" alt="Chat" class="Barra" onclick = "handleChangeStateClick('cambio')"></div>-->
        <div id="ProfilePhoto"><img style="border-radius: 15px; width:30px; height: 30px;" src="<?php echo getAccountInfos($_SESSION['id_account'], 'foto_profilo');?>" alt="Foto Profilo" class="Barra"></div>
        <div class="reloadbutton" style="text-align: center; font-size: 13pt; max-width: 5vw;" onclick = 'window.location.href="https://mindflow.altervista.org/index.php"'>Logout</div>
        </div>
    </div>
<!-- old top bar-->
<!--
    <div id="top-bar">
        <h1>MINDFLOW</h1>
        <form action = "UpdateAccountInfo.php" method = "post">
        	<input type = "submit" value = "modifica account">
        </form>
    </div>

-->


<div id="WorkSpace" style="display: flex; flex-direction: row;  margin-top: 10vh;"><!--change attributes-->

	<!--side menu-->
    <!--new side menu-->
    <div id="Lateral" class = "Lateral" >
            <div><img style="border-radius: 60px; widht: 120px; height: 120px;" id="ProfileImageBig" src="<?php echo getAccountInfos($_SESSION['id_account'],'foto_profilo');?>" alt="FotoProfilo"></div>
            <div style="margin-bottom: 1vh;" id="NomeCognome"><?php echo getAccountInfos($_SESSION['id_account'],'nome_utente');?> <?php echo getAccountInfos($_SESSION['id_account'], 'cognome_utente');?></div>
            <div id="Username"><?php echo getAccountInfos($_SESSION['id_account'],'username_utente');?></div>
            <div>
            <form action = "UpdateAccountInfo.php" method = "post">
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
        
        
        


    
    <!--search Bar-->
    



<div id="content" style = 'width:76%;'>     
<div style="display: flex; gap: 5px; margin-top: 4vh;" id = 'searchBar'>
                    <input style="height: 4vh; padding-left:10px; width:13vw; border-radius:10px; border: none; background-color: #262626; color: white; font-family: Nordique;" type="text" id = "toSearch" placeholder="Search Project.." name = 'toSearch'>
                    <br><input style="height: 4vh; width:5vw; border-radius:15px; border: none; background-color: #262626; color: white; font-family: Nordique;" type = 'button' onclick = 'window.location.reload()' value = 'Clear'>
                    <br><input  style="height: 4vh; width:5vw; border-radius:15px; border: none; background-color: #262626; color: white; font-family: Nordique;" type = 'button' onclick = 'hideContent("hide")' value = 'Search'>
                       </div>
    <!--main-->
    <br>
<div id = 'projects'>
     <div class="Projects" id="YourProject" >
    	<?php if(isset($_POST['toSearch']))
        {
         
        	//$accountData->searchProject($_POST['toSearch']);
            //echo $accountData->getSearchResult();
            unset($_POST['toSearch']);
 
        } ?>
         <div style="display: flex; gap:3vw; margin-right: 2vw; margin-bottom: 1vh; align-items: center;">
                <div>YOUR PROJECTS:</div>
                 
    			<div class="dropdown" style="align-items: center;">
                <button style="border-radius: 15px; font-family: Nordique;" onclick="openFilter(1)" class="dropbtn1">Order by</button>
                <div id="myDropdown1" class="dropdown-content" style="border-radius: 15px; "> <!-- color: white; background-color: #262626; -->
                  <p style="font-size: 12pt; font-family: Nordique; padding-left: 10px;"onclick = "ordinaPer('data_ultima_modifica DESC', 'all')">- Ultima modifica</p>
                  <p style="font-size: 12pt; font-family: Nordique; padding-left: 10px;"onclick = "ordinaPer('data_scadenza ASC', 'all')">- Data scadenza</p>
                  <p style="font-size: 12pt; font-family: Nordique; padding-left: 10px;"onclick = "ordinaPer('nome_progetto ASC', 'all')">- Nome progetto</p>
                </div>
              </div>  
    			</div>
				<br>
        	<?php
                //tramite l'oggetto contenuto nel file ricavo le info che mi servono per poi utilizzarle qui
                //per il momento sotto forma di tabella, poi vedremo come fare la grafica e di sistemare
                if(isset($_POST['remove'])){
                   removeProject();
                }
                          
				?>
                
                <div style="height: 50vh;" id = 'all'  class = 'proj-container'>
                <?php
   					echo getProjects();           
				?>                	
                </div>
             </div>
             <br>
             <br>
             
             
             
             
<div class="Projects" id="PubblicProject" >
<div style="display: flex; gap:3vw; margin-right: 2vw; margin-bottom: 1vh; align-items: center;">
                <div >PUBBLIC PROJECTS:</div>
                           
                <div class="dropdown" style=" align-items: center;">
                  <button style="border-radius: 15px; font-family: Nordique;" onclick="openFilter(2)" class="dropbtn2">Order by</button>
                  <div id="myDropdown2" class="dropdown-content" style="border-radius: 15px; ">
                  <p style="font-size: 12pt; font-family: Nordique; padding-left: 10px;" onclick = "ordinaPer('data_ultima_modifica DESC', 'sher')">- Ultima modifica</p>
                  <p style="font-size: 12pt; font-family: Nordique; padding-left: 10px;" onclick = "ordinaPer('data_scadenza ASC', 'sher')">- Data scadenza</p>
                  <p style="font-size: 12pt; font-family: Nordique; padding-left: 10px;" onclick = "ordinaPer('nome_progetto ASC', 'sher')">- Nome progetto</p>
                  </div>
                </div>
                </div>
                <br>
                
                <div style="height: 50vh;" id = 'sher' class = 'proj-container'>
                <?php
   					echo getSharedProjects();           
				?>                	
                </div>
            
            <br>
</div>

<div class="Projects" id="PrivateProject">
<div style="display: flex; gap:3vw; margin-right: 2vw; margin-bottom: 1vh; align-items: center;">
                <div >PRIVATE PROJECTS:</div>
                           
                <div class="dropdown">
                  <button style="border-radius: 15px; font-family: Nordique;" onclick="openFilter(3)" class="dropbtn3">Order by</button>
                  <div id="myDropdown3" class="dropdown-content" style="border-radius: 15px; ">
                  <p style="font-size: 12pt; font-family: Nordique; padding-left: 10px;" onclick = "ordinaPer('data_ultima_modifica DESC', 'priv')">- Ultima modifica</p>
                  <p style="font-size: 12pt; font-family: Nordique; padding-left: 10px;" onclick = "ordinaPer('data_scadenza ASC', 'priv')">- Data scadenza</p>
                  <p style="font-size: 12pt; font-family: Nordique; padding-left: 10px;" onclick = "ordinaPer('nome_progetto ASC', 'priv')">- Nome progetto</p>
                  </div>
                </div>
                </div>

                <br>
              <div style="height: 50vh;" id = 'priv' class = 'proj-container'>
                <?php
   					echo getPrivateProjects();           
				?>                	
                </div>
                <br>
         </div>


<div class="Projects" id="PrivateProject">
<div style="display: flex; gap:3vw; margin-right: 2vw; margin-bottom: 1vh; align-items: center;">
                <div >COMPLETED PROJECTS:</div>
                           
                <div class="dropdown">
                  <button style="border-radius: 15px; font-family: Nordique;" onclick="openFilter(4)" class="dropbtn4">Order by</button>
                  <div id="myDropdown4" class="dropdown-content" style="border-radius: 15px; ">
                  <p style="font-size: 12pt; font-family: Nordique; padding-left: 10px;" onclick = "ordinaPer('data_ultima_modifica DESC', 'finis')">- Ultima modifica</p>
                  <p style="font-size: 12pt; font-family: Nordique; padding-left: 10px;" onclick = "ordinaPer('data_scadenza ASC', 'finis')">- Data scadenza</p>
                  <p style="font-size: 12pt; font-family: Nordique; padding-left: 10px;" onclick = "ordinaPer('nome_progetto ASC', 'finis')">- Nome progetto</p>
                  </div>
                </div>
                </div>

                <br>
              <div style="height: 50vh;" id = 'finis' class = 'proj-container'>
                <?php
   					echo getFinishedProjects();           
				?>                	
                </div>
         </div>
	</div>
</div>
           
</div>
    <!--
    <div id="chatbox">
    	<div id="chat-messages" class="chat-messages">
        <p><strong>Utente:</strong> Ciao!</p>
        <p><strong>Assistente:</strong> Ciao, come posso aiutarti?</p>
    </div>
    <input  type="text" id="chat-input" class="chat-input" placeholder="Scrivi un messaggio..." onkeydown="if (event.keyCode == 13) sendMessage()">
    </div>-->

   
<div>
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function openFilter(number) {
	console.log(number)
  document.getElementById("myDropdown"+number).classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn2') && !event.target.matches('.dropbtn1') && !event.target.matches('.dropbtn3') && !event.target.matches('.dropbtn4')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

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



</div>
</body>
</html>
