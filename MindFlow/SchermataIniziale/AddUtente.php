<?php


include 'getUtenti.php';
include '../connect.php';
include_once('../Locale/Cifrario.php');
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve registration information from the form
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $online = 'online';
    $email = $_POST['email'];
    $confirmPassword = $_POST["confirm_password"];
    $genere = "b";

    // You should perform proper validation and sanitization here
    if($genere == "A"){
    	echo "<h1 style = 'font-size: 10vw; text-align: center;'> AH SEI FROCIO(omosessuale è un termine medico)</h1><br>"
         ."<h1 style = 'font-size: 5vw; text-align: center;'> ecco a te una foto che potrebbe piacerti</h1><br>"
         ."<img style = 'width: 50vw; height: 50vw' src = 'https://mostra24h.altervista.org/AaaTutu/neri-gay.jpg'>";
    }
    //check if the account already exist

    elseif(getResult($username, $password)){ 
     	echo 'already_exist'; //errore sull'esistenza
    } elseif(!verify_username_utente($username)) {
    // Check if passwords match
      if ($password !== $confirmPassword) {
            echo 'pass_match'; //errore sulle pass
      } else {
          //insrimento nuovo utente
          global $conn; 
          $password = $cifra->cifratura($password); //pass cifrata
          $query = 'INSERT INTO Account(nome_utente, cognome_utente,username_utente, email, stato_account , password) VALUES '
                  ."('".$name."',"
                  ."'".$surname
                  ."','".$username
                  ."','".$email
                  ."','".$online
                  ."','".$password."');";

          if($conn->query($query) === true){
                $password = $cifra->decifratura($password); //pass decifrata
                getResult($username, $password); //set the session_id value


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
        <p>🎉 <b>".$username."</b> Welcome Mindflow's community! 🎉 <br>
            Your account has been created successfully. <br>
            Log in now and finds out about the beautiful world of Mindflow. <br>
            Click here to join <a href='https://mindflow.altervista.org/'>Mindflow's world</a> !<br>
            <br>
            
            Thank you ❤️, <br>
            Mindflow's team ;-) <br><br><br><br>
            </p>


            
</body>
</html>";
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <Mindflow.altervista.org>' . "\r\n";
$headers .= 'Cc: '.$email.'  "\r\n"';
                        //  $headers = "From: Mindflow.altervista.org" . "\r\n";
                       //$msg = wordwrap($msg,10);

              // send email
                  mail($email,"Confirmation ",$msg, $headers);
             }	
             else{
                echo "email_already_in"; //email duplication error
             }
        }
      }
      else{
          echo 'user_error'; //username already taken error
      }
  }


?>
