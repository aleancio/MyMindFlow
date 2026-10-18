<?php
session_start();

include '../../connect.php';

$errMsg;
function cercaCartella($name, $codice)
{
	global $conn;
    global $errMsg;
    
    $sql = 'SELECT * FROM Cartella WHERE nome_cartella = "'.$name.'" and codice_cartella = "'.$codice.'";';
    $result = $conn -> query($sql);
    
    if($result->num_rows > 0){
    	while($row = $result->fetch_array()){
        	return $row['id_Cartella'];
        }
    }
    else
    {
    	$errMsg = "Error: the folder you are trying to connect might not exits";
    	return 'non_esistente';
    }



}



if(isset($_POST['nome_cartella']) and cercaCartella($_POST['nome_cartella'], $_POST['codice_cartella']) != 'non_esistente')
{
	
    global $conn;
    
    $sql = 'UPDATE Progetto SET id_cartella='.cercaCartella($_POST['nome_cartella'], $_POST['codice_cartella']).' WHERE id_Progetto = '.$_SESSION['id_progetto'].';';
    if ($conn->query($sql) === true) {
                  echo "<script>window.location.replace('indexProject.php')</script>"; 
          } else {
              $errMsg = "Error: error occured linking your project to the folder";
          }


}



?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="generator" content="AlterVista - Editor HTML"/>
  <title> AddToClass</title>
  <link rel="stylesheet" href="../../IMAGES/Fonts.css">
  <style>

    body {
      width: 100vw;
      height: 100vh;
      margin: 0;
      padding: 0;
      display:flex;
      align-items: center;
      justify-content: space-around;
      background : #a6a6a6;
      align-items: center;
    }
	.title {
    	width: 100%;
        text-align: center;
        margin-bottom: 3vh;
        font-size: 8vh;
        color: white;
        font-family: Metropolis;
    }

	.subtitle{
        font-size: 20pt;
        margin-top: 2.5vh;
        color: white;
        font-family: OstrichSans-Heavy, sans-serif;
        
}
    .login-box {	
    	min-width: 30vw;
        align-items: center;
        padding: 3vw;
        background: #262626;
        box-shadow: 0 15px 25px rgba(0,0,0,.6);
        border-radius: 20px;
    }
       .sub-button{
			margin: 0 auto;
            width: 15vw;
            height: 7vh;
            background-color: #5A7FD7;
            font-family: OstrichSans-Heavy, sans-serif;
            font-size: 20pt;
            padding: 1vh;
            border: none;
            border-radius: 20px;
            color: white;
            align-items: center;
      	}
        .back{ 
        	color: white;
            font-family: OstrichSans-Heavy, sans-serif;
            margin: 0 auto;
        	font-size: 15pt;
            padding-bottom:0.01vh;
            border: 0pt;
            background-color: transparent;
        }
        .back:hover{  	
            cursor: pointer;
            border-bottom-width: 3px;
            border-bottom-color: white;
            border-bottom-style: solid;
            transition: 0.5s;
        }
        .sub-button:hover{
        	background-color: black;
            cursor: pointer;
            transition: 0.5s;
        }

    .login-box .user-box input {
         	border-radius: 10px;
            height: 4vh;
            font-family: Nordique;
            font-size: 15pt;
            padding: 0.5vh;
            display: flex;
            flex-direction: column;
            width: 100%;
            margin-bottom: 2vh;

    }
    .login-box .user-box label {
    top:0;
    left: 0;
    padding: 10px 0;
    font-size: 1.5vw;
    color: #fff;
    pointer-events: none;
    transition: .5s;
        font-family: OstrichSans-Heavy;
    }
    #errorBox
    {
    	color: white;
        text-align:center;
        margin-top : 2vh;
        font-family: OstrichSans-Heavy;
    }

  </style>
</head>
<body>
	<div class="login-box">
    <div class="title"> Add a folder</div>
    <form action = 'addToClass.php' method = 'POST'>
    <div class="user-box">
    	<label for = 'nome_cartella'>destination folder name</label>
    	<input type = 'text' id = 'nome_cartella' name = 'nome_cartella'><br>
        </div>
        <div class="user-box">
        <label for = 'codice_cartella'>Folder passcode</label>
        <input type = 'text' id = 'codice_cartella' name = 'codice_cartella'><br>
        </div>
        <div style="display: flex; flex-direction: column; align-items:center;">
        <input type = 'submit' class="sub-button" value = 'Add to folder'><br>
         <input type = 'button' onclick = 'window.location.replace("indexProject.php")' class="back" value = 'Back'>
        </div>
 	<div id = 'errorBox'><?php echo $errMsg;?></div>
    </form>

                    
    </div>

    

</body>
</html>
