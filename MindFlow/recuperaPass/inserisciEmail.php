<?php
session_start();
include '../connect.php';
include '../Locale/IndexProfileScreen/retrieveProjects.php';
$errMsg;
if(isset($_POST['email']))
{
	//echo getAccountInfos();
    global $conn;
    
    $sql = 'SELECT * FROM Account WHERE email = "'.$_POST['email'].'";';
    
    $result = $conn->query($sql);
    $nome_utente = '';
    if($result->num_rows > 0)
    {
    	while($row = $result->fetch_assoc()){
        	$_SESSION['email'] = $row['email'];
           $nome_utente = $row['username_utente'];
            $_SESSION['codice'] = rand(100000,999999);   
        }
        
        $msg = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
    <script>

    </script>
    <style>

        
        @font-face {
            font-family: OstrichSans-Heavy;
            src: url('https://mindflow.altervista.org/IMAGES/OstrichSans-Heavy.otf');
        }
        .stereonic-font {
        font-family: OstrichSans-Heavy, sans-serif;
        /* Aggiungi altri attributi di stile qui se necessario */
        }
        @font-face {
            font-family: Metropolis;
            src: url('https://mindflow.altervista.org/IMAGES/Metropolis1920-Regular.otf');
        }
        .stereonic-font {
        font-family: Metropolis, sans-serif;
        /* Aggiungi altri attributi di stile qui se necessario */
        }
        @font-face {
            font-family: Nordique;
            src: url('https://mindflow.altervista.org/IMAGES/Nordique.otf');
        }
        .stereonic-font {
        font-family: Nordique, sans-serif;
        /* Aggiungi altri attributi di stile qui se necessario */
        }
        body{
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #Titolo{
            
            display: flex;
            align-items: center;
            justify-content: center;
            width: 80%; 
            margin: 0 auto; 
            text-align: center; 
            font-family: Metropolis; 
            background: url('https://mindflow.altervista.org/IMAGES/sfondo.jpg') no-repeat fixed center;
            color: white;
            font-size: 6vw;
            padding: 2vh;
            margin-top: 6vh;
            
        }
        p{
            width: 70%;
            font-family: Nordique;
            margin: 0 auto;
            margin-top: 4vh;
            font-size: 2.6vw;
        }
    </style>
</head>
<body>
    	<div id='Titolo'>MINDFLOW</div>
        <p>Hi <b>$nome_utente</b>! <br>
        we have just receveid a password change request, was that you? <br>
        In order to restore your credentials we sent you a code. <br>
        Your code is: <b>".$_SESSION['codice']."</b> <br>
        If this wasn't you we recommend to check your logins. <br>
        <br>
        Mindflow's Team ;-)
        <br>
        <br>
        <br>
        </p>


            
</body>
</html>";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <Mindflow.altervista.org>' . "\r\n";
$headers .= 'Cc: '.$_SESSION["email"].'  "\r\n"';
                        //  $headers = "From: Mindflow.altervista.org" . "\r\n";
                       //$msg = wordwrap($msg,10);

              // send email
                  mail($_SESSION["email"],"Recover Password",$msg, $headers);

        
        
        echo '<script>window.location.replace("inserisciCodice.php")</script>';
        
        
    }
    else
    {
    	$errMsg = 'Error: can not find your e-mail address';
    }
    
    

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Form</title>
    
<style>
<?php include 'styleForRecupero.php';?>

</style>
</head>
<body>
<div id="sfondo">
    <div class="login-box" >
    	<div class = 'title'><div>MINDFLOW </div>
        <div class = 'subtitle'>RESET PASSWORD</div>
        </div>
          <form action="inserisciEmail.php" method="post">
              <div class="user-box">
              <input style="margin-top: 4px; font-family: Nordique; font-size:1.5vw;" type="email" id="email" name="email" required>
                 <label for="email">Email:</label>
              </div>
              <div class = "sub-button-container" >
                  <input class="sub-button" type="submit" value="Submit">
              </div>
              

          </form>        

        
            <div class="words-button" id= "sentenceBelow">
            	<div id = 'errorBox'><?php echo $errMsg;?></div>
            </div>
            
    </div>

</body>
</html>




