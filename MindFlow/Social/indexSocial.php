<?php
include 'PostManager.php';

include '../Locale/IndexProfileScreen/retrieveProjects.php';
include '../styleSheet.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>My Mindflow - Social</title>
<link rel="stylesheet" href="../IMAGES/Fonts.css">
<script src="https://code.jquery.com/jquery-3.6.4.js"></script>
<script src="script.js"></script>
<script>
function Descrizione(id_prog){
		console.log(id_prog)
 		$.ajax({
                    type : 'POST',
                    url : 'PostManager.php',
                    data : {
                        operazione : 'getPostInfo',
                        id: id_prog
                    },
                    success : function(retPar){
                            //console.log(JSON.parse(retPar))
                           // retPar = retPar.split("</html>").pop()
                            console.log(JSON.parse(retPar))
                            result = JSON.parse(retPar)
                           // document.getElementById('content').innerHTML = retPar;
                            //document.getElementById('like'+id_pos).src='stile/liked.png';
                            
                            
                            window.document.getElementById('titolo_progetto').innerHTML = result['titolo']
                            window.document.getElementById('descrizione').innerHTML = "<b>Descrizione: </b>" + result['descrizione']
                            window.document.getElementById('durata').innerHTML = 'Build time: ' + result['durata']
                            window.document.getElementById('numero_like').innerHTML = 'Likes: ' +result['numero_like']
                            window.document.getElementById('post_image').src = result['immagine']
                            document.getElementById("Descrizione").style.display='block';
                              
                    }
                }) 
    
    
    
    
}
function Chiusura(){
	document.getElementById("Descrizione").style.display='none';
}


var id_pos

function showAllPost(){
			$.ajax({
                    type : 'POST',
                    url : 'PostManager.php',
                    data : {
                        operazione : 'mostraTutto'
                    },
                    success : function(retPar){
                      //      console.log(retPar)
                            document.getElementById('content').innerHTML = retPar;
                            document.getElementById('like'+id_pos).src='stile/liked.png';
                            
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
img:hover{
	cursor:pointer;
}
    </style>


</head>


<body style = 'display: flex; flex-direction: column;margin:0;'>
    <div id="Barra" >
    	<div style="display: flex; flex-direction: row; align-items: center; ">
        <!--<div ><img src="../IMAGES/menu.png" alt="Menu" id="Menu" onclick = "SparimentazioneBarraLaterale()"></div>-->
        <div id="Titolo" onclick='window.location.replace("../Locale/IndexProfileScreen/IndexProfile.php")' >MINDFLOW</div>
        </div>
        <div style="display: flex; flex-direction: row; align-items: center; gap: 2.4vw; margin-right: 2vw;">
        <div> <form style="margin:0;" action = 'https://mindflow.altervista.org/Locale/IndexProfileScreen/CreateProject.html' method = 'post'>
            	<input style="background-color: #5A7FD7; font-family: OstrichSans-Heavy; font-size: 15pt; padding: 8px; margin-top: 0;" type = 'submit' value = 'Create a new project'>
            </form></div>
        <div class="search-bar">
        <form style="margin:0;" action = '../Social/indexSocial.php' method = 'POST'>
        
            <input  name = "search" type="text" class="search-input" placeholder="Don't have any ideas?...">
            <button type = 'submit' class="search-button">Search</button>
        
        </form>
        </div>
        <div id="Classroom" class="tooltip"><img title="Social" src="../IMAGES/social.png" alt="Classroom" class="Barra" onclick = 'window.location.replace("../../Social/indexSocial.php")'></div>
        <div id="Classroom" class="tooltip"><img title="Classroom" src="../IMAGES/Classroom.png" alt="Classroom" class="Barra" onclick = 'window.location.replace("../Classroom/indexClassroom.php")'></div>
        <!--<div id="Chat" ><img id = "Online/Offline"src="IMAGES/Chat.png" alt="Chat" class="Barra" onclick = "handleChangeStateClick('cambio')"></div>-->
        <div id="ProfilePhoto"><img style="border-radius: 15px; width:30px; height: 30px;" src="<?php echo getAccountInfos($_SESSION['id_account'], 'foto_profilo');?>" alt="Foto Profilo" class="Barra"></div>
        
        </div>
    </div>


	<div id = 'content' style = 'max-width: 96vw; margin-top: 13vh; margin-left: 2vw; z-index: 0;'>
    	<div style='font-family: Nordique; font-size: 30pt; color: #262626; margin-bottom: 2vh;'> Results: </div>
        <div style='display: flex;'>


<?php
/* echo showAllPost();
 echo "<h1>Results: </h1>";
 echo searchPost('mamma');
  echo "<h1>POST a cui hai messo like: </h1>";
//	likePost(1);
 echo getNumberOfLikes(1);
  echo searchPost('mamma');*/
  
  
//visualizza risultati ricerca
if(isset($_POST['search'])){
	/*echo "<h1>Results: </h1>";*/
  	echo searchPost($_POST['search']);
    unset($_POST['search']);
}
else
{
	echo showAllPost();
}

?>
</div>
</div>
<form style = 'margin-top: 5vh; margin-left: 2vw; z-index: 0; margin: 0 auto;' action = "indexSocial.php">
<div><button style='margin: 0 auto; border-radius: 10px; border: none; font-size: 15pt; padding: 10px; background-color: #5A7FD7; font-family: OstrichSans-Heavy; color: white;' type = submit> Show all posts</button></div>
</form>
<br>
<br>


<div id="Descrizione" style="position: fixed; z-index: 1; width: 100%; height: 100%; display:none; margin: 0;">
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
                <div><img src="../IMAGES/like.png" style='height: 25px;'></div>
                
            </div>
            <div onclick="Chiusura()" style='font-size: 20px; text-align: center; justify-content: center; align-content: center; border: none; border-radius: 10px; background-color:#5A7FD7; padding: 1vh; padding-right: 3vh; padding-left: 3vh;' >Back</div>
        </div>
    </div>
</div>
</div>
</div>
</body>
</html>
