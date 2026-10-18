<?php
session_start();

include 'connect.php'; // Assicurati di includere il file di connessione al database
include 'retrieveProjects.php';
include '../../SchermataIniziale/getUtenti.php';
//include '../../styleSheet.php';
//include 'IMAGES/styleSheet.php'; //questo dava problemi
$path = $_SERVER['DOCUMENT_ROOT'];
$path = "../../ImageUploader/imageUploader.php"; //parent di 2 livelli
include($path);

//echo $path."<br>";
//include 'https://partener4i.altervista.org/WorkSpaceee/ImageUploader/imageUploader.php';

// Controlla se il modulo è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["nomeUtente_mod"]) and isset($_POST["cognomeUtente_mod"])) {
    // Recupera i dati dal modulo
    $idAccount = $_SESSION['id_account'];
    $nomeUtente = $_POST["nomeUtente_mod"];
    $cognomeUtente = $_POST["cognomeUtente_mod"];
    $username = $_POST['username_mod'];
    $email = $_POST['email_mod'];

    
    if(!verify_username_utente($username)){

    // Puoi aggiungere la tua logica per modificare l'Account nel database
    // Ad esempio, puoi utilizzare un'istruzione SQL UPDATE

      $query = "UPDATE Account SET nome_utente='$nomeUtente', cognome_utente='$cognomeUtente', username_utente = '$username', email = '$email' WHERE id_Account='$idAccount'";

      if ($conn->query($query) === true) {
          $res = uploadImage('../../ImageUploader/profileImages/');
          if($res != '')
          {
           	$errorMessage = $res;
          }
          else
          {
          	   echo "<script>window.location.replace('IndexProfile.php')</script>";
          }
          
      } else {
          $errorMessage  = "Error: An error occured changing your account's infos ";
      }
    }
    else{
    	$errorMessage = "Error: Username already used";
    }
}








?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Account</title>
	<link rel="stylesheet" href="../../IMAGES/Fonts.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    
    <style>
        /* Aggiungi stili personalizzati qui */
        /* Stile per i messaggi di successo ed errore */
        /*.message {
            margin-top: 15px;
            padding: 10px;
            border-radius: 5px;
            
        }*/
        
        
#errorBox{
	text-align: center;
        font-size: 2.5vh;
        margin-top :1vh;

}
        
        body{
        	width: 100vw;
            height: 100vh;
        	background-color: #a6a6a6;
            margin: 0;
            display: flex;
            align-items: center;
        }
		
        /*.success {
            background-color: #d4edda;
            color: #155724;
            
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            
        }*/
        .container{    
        	margin: 0 auto;
        	max-width: 80vw;
            max-height: 90vh;
            padding: 4vh;
            padding-left: 4vw;
            padding-right: 4vw;
            background-color: #262626;
            border-radius: 20px;
            color: white;
            font-family: OstrichSans-Heavy;
            box-shadow: 0 15px 25px rgba(0,0,0,.6);
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;   
        }
        .forma{
        	width: 100%;
            
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5vh;
        }
        .form-group{
         	margin: 0;
            font-family: OstrichSans-Heavy; 
            font-size: 20pt;
            min-width: 94%;
        }
        label{
        	margin-bottom: 0.1vh;
        }
        .okaybutton{
        	height: 8vh;
            padding: 1vh;
            margin: 0;
            background-color: #5A7FD7;
            border: none;
            border-radius: 10px;
            font-family: Nordique;
            font-size: 17pt;
            color: white;
            width: 12vw;
        }
		.okaybutton:hover{
        	cursor: pointer;
            background-color: black;
            transition: 0.5s;
        }
        .image-container {
            position: relative;
            display: inline-block;
        }
        .image {
            border-radius: 12.5vw; 
            width:25vw; 
            height: 25vw;
            transition: filter 0.3s;
        }
        .overlay-image {
        	/*background-color: #262626;
            border-radius: 3vw;*/
            padding: 1vw;
            width:6vw; 
            height: 6vw;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .image-container:hover .image {
            filter: blur(3px);
        }
        .image-container:hover .overlay-image {
            opacity: 1;
            cursor: pointer;
        }
        /*.imageprof > img:hover{
        	filter: blur(5px);
           	cursor: pointer;
            transition: 0.5s;
        }*/
        
        
            
    </style>
</head>
<body>

<!--<div class="container">-->
<form class="container" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data" autofill="off" autocomplete="off" >	
    <div style="display: flex; align-items: center; width: 100%; gap: 2vw; ">     
        <div class="image-container">
        
          	<img  src="<?php echo getAccountInfos($_SESSION['id_account'], 'foto_profilo');?>" alt="Foto Profilo" class="image" >
            <label for="fileToUpload">
        		<img  src="../../IMAGES/editb.png" alt="Edit Profilo" class="overlay-image">
            </label>
            <input style="display: none;" type="file" name="fileToUpload" id="fileToUpload" value = "<?php echo getAccountInfos($_SESSION['id_account'], 'foto_profilo');?>">
          
      	</div>        
      <br>
      <div class="forma">
      <h1 style="font-family: Metropolis; text-align: center; font-size: 30pt; width: 100%; margin:0;">Edit Account</h1>
    <br>
        <div class="form-group" >
            <label for="nomeUtente">Name:</label>
            <input style="font-family: Nordique;" type="text" class="form-control" id="nomeUtente" name="nomeUtente_mod" value="<?php echo getAccountInfos($_SESSION['id_account'], 'nome_utente');?>">
        </div>
        <div class="form-group">
            <label for="cognomeUtente">Surname:</label>
            <input style="font-family: Nordique;" type="text" class="form-control" id="cognomeUtente" name="cognomeUtente_mod" value="<?php echo getAccountInfos($_SESSION['id_account'], 'cognome_utente');?>">
        </div>
         <div  class="form-group">
           <label  for="username">Username:</label>
            <input style="font-family: Nordique;" type="text" class="form-control" id="username1" name="username_mod" value="<?php echo getAccountInfos($_SESSION['id_account'], 'username_utente');?>">
        </div>
        
        <div  class="form-group" >
           <label  for="email">Email:</label>
            <input style="font-family: Nordique;" type="text" class="form-control" id="email" name="email_mod" value="<?php echo getAccountInfos($_SESSION['id_account'], 'email');?>">
        </div>
		<br>
         
        <div style="display: flex; flex-direction: row; width: 60%; align-items: center; justify-content: space-between;">
                <input type = 'button' class="okaybutton"  onclick = 'window.location.replace("IndexProfile.php")' value = 'Back'>
        <input type='submit' class="okaybutton" value = 'Save Changes'>

    	
    	</div>
        <div id = 'errorBox'><?php echo $errorMessage;?></div>

    </div>
    
    <!-- Form per modificare le informazioni dell'Account -->
     </form>  
<!--</div>-->
    <!-- Messaggi di successo o errore -->
</body>
</html>



