<?php
session_start();

include '../connect.php';
$errMsg;
function createClass()
{
	global $conn;
 	$sql = 'INSERT INTO Cartella(id_account_creatore, nome_cartella, testo_cartella, codice_cartella, data_scadenza) VALUES (
    "'.$_SESSION['id_account'].'",
    "'.$_POST['nome_cartella'].'",
    "'.$_POST['testo_cartella'].'",
    "'.$_POST['codice_cartella'].'",
    "'.$_POST['data_scadenza'].'");';
	
    
    	if($conn->query($sql) === true){
              //return "query done";
              
              return "<h2>cartella creata con successo</h2><form action = 'indexClassroom.php'> <input type = 'submit' value = 'back'> </form>";
              
              //getResult($name, $password); //set the session_id value 
              
           }	
          else{
             	return "Error: this passcode is already used, please try another one";
           }

}
if(isset($_POST['nome_cartella']) and isset($_POST['codice_cartella']))
{
	$errMsg = createClass();

}


?>
<!doctype html>

<html>
<head>
<title>Create new Folder</title>

<?php include '../styleSheet.php'; ?>
<link rel="stylesheet" href="../../IMAGES/Fonts.css">
<style>

html {  
height:100%;
}
    body {
          width:100vw;
          height: 100vh;
          margin:0;
          padding:0;
          background : #a6a6a6;
          display: flex;
          align-items: center;
    }
	.CreateBOX{
            margin: 0;
            background-color: #262626;
            border-radius: 5vh;
            border: none;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: OstrichSans-Heavy;
            color: white;
            font-size: 20pt;
            padding: 3vh;
            width: 50vw;  
    }
    .CreateBOX .CreateBOXTitle{
            	font-family: Metropolis; font-size: 40pt;
            margin-bottom: 4vh;
    
    }
          	.CreateBOX .user-box input {
          font-family: Nordique;
          font-size: 16pt;
          padding: 0.5vw;
          padding-right: 0vw;
          margin-bottom: 1.5vh;
          width: 45vw;
          border-radius: 10px;
          height: 3vh;
          max-width: 100%;
          max-height: 25vh;
          min-width: 100%;
          min-height: 3vh;
     	 }
         
    
    
    .mdof{
    	font-family: Nordique;
        font-size: 14pt;
        padding: 0.5vw;
    	width: 100%;
        border-radius: 10px;
        height: 3vh;
        max-width: 100%;
        max-height: 25vh;
        min-width: 100%;
        min-height: 3vh;
    }
    #errorBox{
    	color : white;
        text-align :center;
        margin-top : 1.5vh;
    
    }

    .bottons{ 
        margin-left:21.5vw;  
        margin-top:2vh;
        	color: white;
            font-family: OstrichSans-Heavy;
        	font-size: 15pt;
            padding-bottom:0.01vh;
            border: 0pt;
            background-color: transparent;
        }
        .bottons:hover{  	
            cursor: pointer;
            border-bottom-width: 3px;
            border-bottom-color: white;
            border-bottom-style: solid;
            transition: 0.5s;
        }
        
        .creat{
        margin-top:2vh;
        color:white;
        width:8vw;
        height:5vh;
        border: 0pt;
        border-radius:20pt;
        font-family: OstrichSans-Heavy;
        background-color: #5A7FD7;
        margin-left:18.5vw;
        font-size: 3vh;
        padding:1vh;
        }
         .creat:hover{  	
            cursor: pointer;
            background-color: black;
            transition: 0.5s;
        }
        
        
</style>

</head>

<body>




<div class="CreateBOX">
<h1 class="CreateBOXTitle">Create new Folder</h1>
<form action = 'addCartella.php' method = 'post'>
<div class="user-box">
  <label for="name" >Folder Name:</label><br>
  <input placeholder="Name..." type="text" id="name" name="nome_cartella">
  </div>
  <div class="user-box">
  <label for="lname">Folder PassCode</label><br>
  <input placeholder="PassCode..." type="text" id="lname" name="codice_cartella">
</div>
<div class="user-box">
  <label for="date">Folder Expiration Date</label><br>
  <input  type="date" id="date" name="data_scadenza">  
  </div>
  <div class="user-box">
  <label for="fname">Insert instructions</label><br>
  <textarea class="mdof" id="fname" name="testo_cartella" rows="10" cols="50" placeholder="Insert here the instructions of the project..."></textarea><br>
</div>
  
   
  
  
  <input type = 'hidden' value = 'crea_cartella' name = 'action'>
  <input class="creat" type = 'submit' value = 'Create'><br>
  <input class="bottons" onclick = 'window.location.replace("indexClassroom.php")' type = 'button' value = 'Back'>

    <div id = 'errorBox'><?php echo $errMsg;?></div>

</form>



</div>
</body>
