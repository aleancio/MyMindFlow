<!DOCTYPE html>

<html lang="en">
<head>
	
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Project</title>
    <link rel="stylesheet" href="../../IMAGES/Fonts.css">
          <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
          <style>
    <?php 
    include '../../Stylesheet.php';
    ?>
    </style>
    <style>
     @font-face {
    font-family: Nordique;
    src: url('IMAGES/Nordique.otf');
 }
 .stereonic-font {
   font-family: Nordique, sans-serif;
   /* Aggiungi altri attributi di stile qui se necessario */
 }
 @font-face {
    font-family: OstrichSans-Heavy;
    src: url('IMAGES/OstrichSans-Heavy.otf');
 }
 .stereonic-font {
   font-family: OstrichSans-Heavy, sans-serif;
   /* Aggiungi altri attributi di stile qui se necessario */
 }
  @font-face {
    font-family: Metropolis;
    src: url('IMAGES/Metropolis1920-Regular.otf');
 }
 .stereonic-font {
   font-family: Metropolis, sans-serif;
   /* Aggiungi altri attributi di stile qui se necessario */
 }
       
  
       body{
            height:100vh;
            width: 100vw;
            font-family: 'Nordique';
            background-color: #a6a6a6;
            display:flex;   
            align-items: center;
            margin: 0;
            padding: 0;
            /*filter: blur(8px);*/
        }

		h1{        
         text-align: center;
         font-family: Metropolis;
         font-size : 50pt;
         /*margin-top : -2%;
         margin-bottom : -1%;*/
         margin: 0;
        }
        
        .container {  
        
            width: 50%;
            /*height: 50%;*/
            margin : 0 auto;
            /*margin-top: 8%;*/
            /*margin-right: 10%;
            margin-left: 10%;*/
            padding: 3%;
            border-radius : 20pt;
            text-align: left;
            background-color: #262626;
            color: white;
            align-items: center;
            
            
        }

        form {
            display: flex;
            flex-direction: column;
            font-size: 20pt;
            
        }

        label {
			font-family: OstrichSans-Heavy;
            margin-bottom: 8pt;
        }

        input {
        border-radius: 20px;
        border: none;
        font-family: Nordique;
        font-size: 15pt;
            padding: 8px;
            margin-bottom: 15px;
        }
/*
        button {
            margin-top: 3vh;
            height: 1vh;
            background-color: #5A7FD7;
            font-family: OstrichSans-Heavy;
            font-size: 20pt;
            padding: 1vh;
            border: none;
            border-radius: 20pt;
            color: white;

        }*/
       .container .sub-button{
       		margin: 0 auto;
            width: 10vw;
            height: 7vh;
            background-color: #5A7FD7;
            font-family: OstrichSans-Heavy;
            font-size: 20pt;
            padding: 1vh;
            border: none;
            border-radius: 20pt;
            color: white;
        
        }
        .sub-button:hover{
        	background-color: black;
            cursor: pointer;
            transition: 0.5s;
        }
        .back{
        	margin: 0 auto;
        	font-size: 15pt;
            margin-top: 2vh;
            padding-bottom:0.01vh;
            border-bottom-width: 3px;
            border-bottom-color: rgba(0, 0, 0, 0);
            border-bottom-style: solid;
        }
        .back:hover{  	
            cursor: pointer;
            border-bottom-width: 3px;
            border-bottom-color: white;
            border-bottom-style: solid;
            transition: 0.5s;
        }
        .color{
        	align-items: center;
        	width: 35px;
            height: 35px;
            border-radius: 22px;
            border: solid;
            border-color: rgb(84, 84, 84);
            border-width: 1px;
        }
        .color:hover{cursor: pointer;}
        #rosso {background: #f77070;}
        #blu {background: #424fe4;}
        #verde {background: #69c87e;}
        #giallo {background: #eee97e;}
        #arancione {background: #fa9f71;}
        #viola {background: #917cfa;}
        #marrone {background: #694c4c;}
        #azzurro {background: #69a8dc;}
    </style>
    <script>

        var colore_progetto
    	window.onload = function(){
                	projName = document.getElementById('projectName');
                    data_scadenza = document.getElementById('data_scadenza');
        }
    
    
    	function colore (color, id){
        	document.getElementById('marrone').style.width="35px";
        	document.getElementById('marrone').style.width="35px";
            document.getElementById('arancione').style.width="35px";
            document.getElementById('giallo').style.width="35px";
            document.getElementById('verde').style.width="35px";
            document.getElementById('blu').style.width="35px";
            document.getElementById('azzurro').style.width="35px";
            document.getElementById('viola').style.width="35px";
            document.getElementById('marrone').style.height="35px";
            document.getElementById('rosso').style.height="35px";
            document.getElementById('arancione').style.height="35px";
            document.getElementById('giallo').style.height="35px";
            document.getElementById('verde').style.height="35px";
            document.getElementById('blu').style.height="35px";
            document.getElementById('azzurro').style.height="35px";
            document.getElementById('viola').style.height="35px";
        	document.getElementById(id).style.width="43px";
            document.getElementById(id).style.height="43px";
            colore_progetto = color;
        }
        
        function modificaProgetto()
        {
        	   $.ajax({
                    type : 'POST',
                    url : 'CreateProject_handler.php',
                    data : {
                    	modifica_progetto : 'a',
                        id_progetto : "<?php echo $_POST['id_Progetto']?>",
                        projectName : projName.value,
                        data_scadenza : data_scadenza.value,
                        colore_progetto : colore_progetto
                    },
                    success : function(retPar){
                    		//result = JSON.parse(retPar);
                            
                             console.log(retPar)
								if(retPar.includes('project_edited')){
                                	window.location.replace("../ProjectsScreens/indexProject.php");
                                }
                                else {
                                	
                                	document.getElementById('errorBox').innerHTML ="Error: "+ retPar;
                                }
    
                    }
                })   
        
        
        }
        
        
        
        
        
    </script>
</head>
<body id="Edit">

<!-- Form Container -->
<div class="container">
    <h1>Edit Project</h1>
	<br>
    <form action="CreateProject_handler.php" method="post">
    
    	<input type = 'hidden' name  = 'modifica_progetto' value ='a'>
        <label for="projectName">Project Name:</label>
        <input type="text" id="projectName" name="projectName" value = "<?php echo $_POST['nome_progetto']?>" required>
        
        <label for="data_scadenza">Expiration date:</label>
        <input type="date" id="data_scadenza" name="data_scadenza" value = "<?php echo $_POST['data_scadenza']?>" required>
        
        <label for="colore_progetto">Project color:</label>
        <div style="display:flex; flex-direction: row; justify-content: space-around; align-items: center; background-color: white; border-radius: 30px; border: none; padding: 1vh; height: 6vh;">
        	<div id="marrone" class="color" onclick="colore('#694c4c', 'marrone')"></div>
        	<div id="rosso" class="color" onclick="colore('#f77070', 'rosso')"></div>
            <div id="arancione" class="color" onclick="colore('#fa9f71', 'arancione')"></div>
            <div id="giallo" class="color" onclick="colore('#eee97e', 'giallo')"></div>       
            <div id="verde" class="color" onclick="colore('#69c87e', 'verde')"></div>
            <div id="azzurro" class="color" onclick="colore('#69a8dc', 'azzurro')"></div>
            <div id="viola" class="color" onclick="colore('#917cfa', 'viola')"></div>
            <div id="blu" class="color" onclick="colore('#424fe4', 'blu')"></div>
           
        </div>
        
 
		<br>
        <input type="button" class="sub-button" value = 'Edit Project' onclick = 'modificaProgetto()'>
        <div class="back" onclick = 'window.location.replace("https://mindflow.altervista.org/Locale/ProjectsScreens/indexProject.php")'>Back</div>
    	<div id = 'errorBox'></div>
    </form>
    </div>   

</body>
</html>
