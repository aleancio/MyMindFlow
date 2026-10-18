<?php
session_start();
include '../../connect.php';
include 'retrieveProjects.php';
global $result;
// Check if the form is submitted
if (isset($_POST['crea_progetto'])) {
    // Retrieve project information from the form
    $projectName = $_POST["projectName"];
    $projectCategory = $_POST["projectCategory"];
    $expiration_date = $_POST["data_scadenza"];
    $colore = $_POST["colore_progetto"];
    $t=time();
    /*echo($t . "<br>");
    echo(date("Y-m-d",$t));*/
    
    $stato_progetto = 'incomplete';
    $dataCreazione = date("Y-m-d",$t);

    // You should perform proper validation and sanitization here

    // Insert the record into the Progetto table in your database
    $query = 'INSERT INTO Progetto(id_account, nome_progetto, colore_progetto ,data_creazione, stato_progetto, data_scadenza ) VALUES '
        . "('" . $_SESSION['id_account'] . "',"
        . "'" . $projectName . "',"
        . "'" . $colore . "',"
        . "'" . $dataCreazione . "',"
         . "'" . $stato_progetto . "',"
        . "'" . $expiration_date . "');";

    if ($conn->query($query) === true) {
        // Redirect to a success page or display a success message
			        for ($i = 0; $i <= 2; $i++) {
            $word = "k".$i;
            $query = 'INSERT INTO KeyWords(id_progetto, parola) VALUES '
            . "('" . retrive_id_current_project(). "',"
            . "'" . $_POST[$word] . "');";
             if (!$conn->query($query) === true) {
                echo 'an error occured while putting in the words for your project, please try again';
            }
            
        }
     $_SESSION['id_progetto'] = retrive_id_current_project();
     echo "project_created"; 

    } else {
        // Display an error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}


// Display success badge if the operation was successful





function retrive_id_current_project(){
	global $conn;
	$query = 'SELECT MAX(id_Progetto) AS id_Progetto FROM Progetto;';
   	$result = $conn->query($query);
	$row = $result->fetch_assoc();
    return $intValue = (int)$row['id_Progetto'];
    
}


if (isset($_POST['modifica_progetto']))
{
    $projectName = $_POST["projectName"];
    $expiration_date = $_POST["data_scadenza"];
    $colore = $_POST["colore_progetto"];

    // You should perform proper validation and sanitization here

    // Insert the record into the Progetto table in your database
    $query = ' UPDATE Progetto SET nome_progetto = "'.$projectName.'", colore_progetto = "'.$colore.'" , data_scadenza = "'.$expiration_date.'" WHERE id_Progetto = '.$_POST['id_progetto'];
    if ($conn->query($query) === true) {
        // Redirect to a success page or display a success message
       echo "project_edited"; 
    } else {
        // Display an error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

     showResult($_POST['id_progetto']);
    
}

function showResult($id){
	global $result;
	
/*
  if ($result === "query done") {
      echo '<div class="success-badge">Operation Successful!</div>
      <form action="https://partener4i.altervista.org/WorkSpaceee/Locale/ProjectsScreens/indexProject.php" method="post">
      <input type = hidden name = "id_progetto" value ="'.$id.'">
      <input type="submit" value="Go to Next Page">
      </form>;';
  }
  else{
  	echo var_dump($_SESSION);
  }*/
}
?>


