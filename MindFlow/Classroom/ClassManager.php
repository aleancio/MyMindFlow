<?php
session_start();

include '../connect.php';





function getClass() //mostra le cartelle
{
	//global $conn;
    global $conn;
    $sql = 'SELECT * FROM Cartella WHERE id_account_creatore = '.$_SESSION['id_account'];
    $result = $conn->query($sql);
    if($result->num_rows > 0){
    	
        $final = '<h1 style="font-family: OstrichSans-Heavy; font-size: 24pt;">Your Folders:</h1><br><div style = "width: 100%">';
        while($row = $result->fetch_assoc()){
        	$final .= 
            "<div onclick = 'loadAllProject(".$row['id_Cartella'].")'>".
            "<div class='Folder' style='font-family: Nordique; align-items: center;  gap: 1vw; font-size: 15pt; display:flex; max-width: 95%; border-radius: 20px; flex-diection: row; background-color: #262626; color: white; padding-bottom: 1.5vh;'>".
            "<div><img class='ImgFolder' src='../../IMAGES/folder.png' style='width: 8vw;'></div>".
            "<div style='display:none'>id_account_creatore : ".$row['id_account_creatore']."</div>".
            
            "<div style='display: flex; flex-direction: column; margin-top: 2vh;'>".
            	"<div style='display: flex; gap: 1vw; align-items: center;'>".
                	"<div><b>Name:</b></div>".
                	"<div  style='color: #5A7FD7; font-size: 25pt; font-family: OstrichSans-Heavy;'>".$row['nome_cartella']."</div>".
                "</div>".
                "<div style='font-size: 13pt; font-family: Nordique;'><b style='font-size: 13pt; font-family: Nordique;' >Folder code: </b>".$row['codice_cartella']."</div>".
                "<div style='margin-right: 2vw; margin-bottom: 2vh'><b>Instructions: </b><div style = 'display: inline-block;'>".$row['testo_cartella']."</div></div>".
            
            "</div></div></div><br>";
        	
        }
    	$final .= '</div>';
    }
    else
    {
    	$final = '<br><br><button class="reloadbutton" onclick = "window.location.replace(../Locale/IndexProfileScreen/IndexProfile.php)">Home</button>';
    	$final .= '<br><br><div style="font-size: 20pt; font-family: Nordique;"><b>No folder found,</b> you can create one with the button in the bar above</div>';
    	
    }
    
    return $final;
    
}


function loadProject($id) //mostra i progetti
{
    global $conn;
    $sql = 'SELECT * FROM Progetto WHERE id_cartella = '.$id; //cambia project
    $result = $conn->query($sql);
    if($result->num_rows > 0){ //cambia visualizzazione
    	
        $final = '<h1 style="font-family: OstrichSans-Heavy; font-size: 24pt;"> Projects:  </h1><br><div>';
        while($row = $result->fetch_assoc()){
        	$final .= 
            "<div onclick = 'openProject(".$row['id_Progetto'].")' class='Folder' style='font-family: Nordique;  gap: 1vw; font-size: 15pt; display:flex;min-width:60vw; max-width: 70vw; border-radius: 20px; flex-diection: row; background-color: #262626; color: white; padding-bottom: 1.5vh; align-items: center;'>".
            "<div style='margin: 1vh;'><img class='ImgFolder' src='../../IMAGES/group.png' style='width: 8vw; '></div>".
            "<div style='display: flex; flex-direction: column; margin-top: 2vh;'>".
            	"<div style='display: flex; gap: 1vw; align-items: center;'>".
                	"<div><b>Name:</b></div>".
                	"<div  style='color: #5A7FD7; font-size: 25pt; font-family: OstrichSans-Heavy;'>".$row['nome_progetto']."</div>".
                "</div>".
                "<div>Creation Date : ".$row['data_creazione']."</div>".
                "<div>Expiration Date: ".$row['data_scadenza']."</div>".
            
            "</div></div></div><br>";
        }
    	$final .= '</div><button class="reloadbutton" onclick = "window.location.reload()">Back</button>';
    }
    else
    {
    	
    	$final .= '<br><br><button class="reloadbutton" onclick = "window.location.reload()">Back</button>';
        $final .= '<br><br><div style="font-size: 20pt; font-family: Nordique;"><b>No project</b> for this folder</div>';
    }
    
    return $final;


}




if($_POST['action'] == 'crea_cartella'){
  echo createClass();
}
if($_POST['action'] == 'loadProject')
{
	echo loadProject($_POST['id_progetto']);
}
if($_POST['action'] == 'openProject')
{
	$_SESSION['id_progetto'] = $_POST['id_progetto'];
    $_SESSION['fromClassroom'] = 'from';
    echo 'done';

}



?>


