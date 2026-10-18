<?php
session_start();
include '../../SchermataIniziale/getUtenti.php';
include '../../connect.php';



	
    // Properties
    $project_name = array();

    
    function get_project_name($value){
    	global $project_name;
        retrive_project_name();
    	return $project_name[$value];
    }
    
    //aggiungi controllo che la condivisione non esista già
    //aggiungi controllo per verificare che l'username esista
    
    function addConnection(){ 
    global $conn;
        //echo $_POST['Username_account_ricevitore']."<br>";
       // echo "Username: ".verify_username_utente($_POST['Username_account_ricevitore'])."<br>";
        //echo "connessione: ".verificaConnessione($_SESSION['id_account'], $_POST['Username_account_ricevitore'], $_SESSION['id_project_to_share']);
        
      //  $_SESSION['id_account'] = 10;
        if(verificaConnessione($_SESSION['id_account'], $_POST['username_account_ricevitore'], $_SESSION['id_progetto']) and verify_username_utente($_POST['username_account_ricevitore'])){
          $sql = 'INSERT INTO Progetti_Condivisi (id_account_condivisore , id_account_ricevitore , id_progetto)
                VALUES ('.$_SESSION['id_account'].','.getAccountFromUserName($_POST['username_account_ricevitore']).','.$_SESSION['id_progetto'].');';
          if ($conn->query($sql) === true) {
                  return "Done";
          } else {
              return "already_shared";
          }
        }
        else{
        	return $_POST['username_account_ricevitore'];//$_POST['Username_account_ricevitore'];//verify_username_utente();
        }
    }    
    

    
    function retrive_project_name(){
    	global $project_name, $conn;
		$sql = 'SELECT * FROM Progetto WHERE id_Progetto= '.$_SESSION['id_progetto'].';';
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
 				$project_name = $row;
            }
        } else {
            $project_name .= $_SESSION['id_progetto'];
        }
    }
        	

function getAccountFromUserName($username)
{

	global $conn;
    $a = 0;
	$sql = 'SELECT id_Account FROM Account WHERE username_utente = "'.$username.'";';
    $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
 				$a = $row["id_Account"];
            }
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
        return $a;

}

function retrieveConsegna()
{
	global $conn;
    $a = 0;
	$sql = 'SELECT C.testo_cartella FROM Cartella C, Progetto P WHERE C.id_Cartella = P.id_cartella AND P.id_Progetto ='.$_SESSION['id_progetto'];
    $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
 				$a = $row["testo_cartella"];
            }
        } else {
            /*return "Error: " . $sql . "<br>" . $conn->error;*/
        }
        return $a;
	

}









?>



<?php

function verificaConnessione($id_acc, $username_ric, $id_prog){
  		global $conn;
         $sql = 'SELECT * 
         FROM Progetti_Condivisi 
         WHERE id_account_condivisore = '.$id_acc.' AND id_account_ricevitore= "'.$username_ric.'" AND id_progetto = '.$id_prog.';';
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
         //	echo "connessione esistente";
			return false;
        } else {
            return true;
        }

}

function removeProject(){ //remove all the tasks once you have deleted the project
    	global $conn;
        
        $querys = array();
     $querys[0] = "DELETE FROM Progetto WHERE id_Progetto=".$_SESSION['id_progetto'].";";
    $querys[1] ="DELETE FROM Messages WHERE id_progetto=".$_SESSION['id_progetto'].";";
    $querys[2] ="DELETE FROM Progetti_Condivisi WHERE id_progetto=".$_SESSION['id_progetto'].";";
    $querys[3]="DELETE FROM KeyWords WHERE id_progetto=".$_SESSION['id_progetto']."; ";
    $querys[4]="DELETE FROM Task WHERE id_progetto=".$_SESSION['id_progetto']."; ";
	for ($i = 0; $i < 5; $i++) {
        if (!$conn->query($querys[$i]) === TRUE) {
        return $sql." <br>" . $conn->error;
        }
         // echo "Record deleted successfully";
    }

    	//retrieveProjects();
    
    }
    
function finishProject()
{
    global $conn;
    $sql = "UPDATE Progetto SET stato_progetto = 'finished' WHERE id_Progetto=".$_SESSION['id_progetto'];

    if ($conn->query($sql) === TRUE) {
     // echo "Record deleted successfully";
     return "Record updated successfully";
    } else {
      return "Error deleting record: " . $conn->error;
	}

}

if($_POST['azione'] == 'fromWhere')
{
	if(!isset($_SESSION['fromClassroom']))
    {
    	echo 'notSetted';
    }
    else{
    	echo 'sium';
    }
}

if($_POST['azione'] == 'cancellaProgetto')
{
	echo removeProject();
	
}
if($_POST['azione'] == 'terminaProgetto')
{
	echo finishProject();
	
}




?>





