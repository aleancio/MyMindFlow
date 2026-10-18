<?php

session_start();

include ('../connect.php');
include_once('../Locale/Cifrario.php');



if(isset($_POST['verificaUtente'])){
   // $pass = $cifra->cifratura($_POST['pass']);

	getResult($_POST['nomeUtente'], $_POST['pass']);
    unset($_POST['verificaUtente']);
}
function verify_username_utente($user){
	global $conn;
  $sql = "SELECT * FROM Account WHERE username_utente = '".$user."' AND id_Account <> ".$_SESSION['id_account'].";";
  $result = $conn->query($sql);
  
  if($result->num_rows > 0){
		return true;
  }
  else{
  	return false; //username non preso
  }

}

function getUtenti($nomeUtente, $password){
	global $conn, $cifra;
  $sql = "SELECT * FROM Account WHERE username_utente = '".$nomeUtente."';";
  $result = $conn->query($sql);
  $pass = $cifra->cifratura($password);
  if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          //  echo "pass: ".$password;
        	if($pass != $row['password']){
            	return false;
            }
           set_id_account($row["id_Account"]);
         }
         return true;

  } else {    
          return false;
        }
}

function getResult($nomeUtente, $password){
     if(isset($_POST['verificaUtente'])){
        if(getUtenti($nomeUtente, $password)){
            echo 'Corretti';
        }
        else{
            echo "0 results ".$_POST['nomeUtente'].' '.$password;
        }
      }
      else{
		return getUtenti($nomeUtente, $password);
      }

}
function set_id_account($val){
	$_SESSION['id_account'] = $val;
 //   echo "session_id impostato a: ".$val;
}





?>
