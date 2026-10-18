<?php
session_start();
//include_once('../../SchermataIniziale/getUtenti.php');
include_once('ProjectManager.php');

include '../../connect.php';
include_once('../IndexProfileScreen/retrieveProjects.php');
	//propreties
    $task_name;
    $task_status;
    $display_all_tasks;
    $taskStatus_displayer = array(); //this is the matrix
    $events = array();
    $task = array();
    
    $status_task = array(); //this is the task status array
    $html_task = array(); //this is the html array
    //method
    
    
    
    function setEventColor($stato)
    {
    	if($stato == 'to_do')
        {
        	return 'rgb(251,111,111)';
        } elseif ($stato == 'doing') {
        	return '#1d7595';
        } else {
        	return '#428c26';
        }
    }
    
    
    function setEvent($nome_task,  $date_begin, $date_expiration , $status)
    {
    	global $events;
        array_push($events,
'{"title":"'.$nome_task.'", "start": "'.$date_begin.'", "end": "'.$date_expiration.'", "textColor": "black", "color": "'.setEventColor($status).'"}'
             );
    
    }
    
    function getEvent()
    {
    	global $events;
    	return $events;
    }


    function get_task_name(){
    	global $task_name;
    	return $task_name;
    }
    function get_task_status(){
    	global $task_status;
    	return $task_status;
    }
    function get_display_all_tasks(){
    	global $display_all_tasks;
    	retrieve_all_tasks_informations();
    	return $display_all_tasks;
    }
    
    function getStatus_task(){
    	global $status_task;
        retrieve_all_tasks_informations();
    	return $status_task;
    }
    
    function getHTML_task(){
    	global $html_task;
        retrieve_all_tasks_informations();
    	return $html_task;
    }
    
    function retrieve_all_tasks_informations(){
    	global $conn;
        $sql = "SELECT * FROM Task WHERE id_progetto = ".$_SESSION['id_progetto']." ORDER BY data_scadenza;";
        $result = $conn->query($sql);
        display_all_result($result);
    }
    
    function setNewStatus($task, $status){
    global $conn;
    	$sql = "UPDATE Task SET stato='".$status."' WHERE id_Task = '".$task."';";
    	
        if ($conn->query($sql) === true) {
        		//echo "Task added successfully";
               // $this->retrieve_all_tasks_informations();
               // header("Refresh:0");
        } else {
           // echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    
    
    
    }
   function getTaskInfo($id_task, $field){
   		global $task;
   		getTask($id_task);
        return $task[$field];
   }
   function getTask($id_task)
   {
   		global $conn, $task;
    	$sql = "SELECT * FROM Task WHERE id_Task = ".$id_task;
        $result = $conn->query($sql);
    	  if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            	$task = $row;
            }
           }
           else
           {
          // 	echo "problema";
           }
   	
   }
    
    
    function display_all_result($result){ 
    		global $conn, $status_task, $html_task, $display_all_tasks, $events;
         //   $events = 'const myEvents = [';
            
            $status_task = array();
            $html_task = array();
    	  if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                
                if($row['stato'] == 'to_do'){
                	$finalstring =  "<div draggable='true' class = 'task' ondragstart='drag(event)' id='".$row['id_Task']."' style='font-family: OstrichSans-Heavy, sans-serif; display: flex; justify-content: space-between; padding:15px; width:90%; border-radius: 20px; background-color: rgb(251, 111, 111);'>";
                
                }
                else if($row['stato'] == 'doing')
                {
                	$finalstring =  "<div draggable='true' class = 'task' ondragstart='drag(event)' id='".$row['id_Task']."' style='font-family: OstrichSans-Heavy, sans-serif; display: flex; justify-content: space-between; padding:15px; width:90%; border-radius: 20px; background-color: #1d7595;'>";
                }
                else
                {
                $finalstring =  "<div draggable='true' class = 'task' ondragstart='drag(event)' id='".$row['id_Task']."' style='font-family: OstrichSans-Heavy, sans-serif; display: flex; justify-content: space-between; padding:15px; width:90%; border-radius: 20px; background-color: #428c26;'>";
                }
                setEvent($row["testo_task"], $row["data_inizio"], $row["data_scadenza"], $row['stato']);
             $finalstring .=  

            
        		"<div style='width: 100%; display: flex; align-items: center; justify-content: space-between;'>
                	<div style='width: 15%; display: flex; justify-content: center; align-items: center; margin-right: 1vw;'><img title='".getAccountInfos(getTaskInfo($row["id_Task"], "id_solver"), 'username_utente')."' style='width: 40px; height: 40px; border: none; border-radius: 20px;' src='".getAccountInfos(getTaskInfo($_row["id_Task"], "id_solver"), 'foto_profilo')."' alt='Error'></div>
                	<div style='width: 65%;'>
                		<div id='titolo' style='font-size: 1.1vw; text-align: left;'>" . $row["testo_task"] . "</div>";
        				
               		if($row["data_scadenza"] == $row["data_inizio"])
                    {
                    	$finalstring .= "<div id='expiration' style='font-family: Nordique; font-size: 0.8vw; text-align: left;' > ". $row["data_scadenza"] ."</div>" ;
                   	 } else {
                     
                     $finalstring .= "<div id='expiration' style='font-family: Nordique; font-size: 0.8vw; text-align: left;' > " . $row["data_inizio"] ." - " . $row["data_scadenza"] ."</div>" ;
                     }

                   $finalstring .= "</div>
                
        			<div id='Tasti' style='width: 20%; display: flex; justify-content: space-between; gap: 0.5vw; align-items: center;margin-right: 0.5vw;'>
            
            				<div>

                            <img  onclick = showPopUp('delete',". $row["id_Task"].") title='Delete task' src='../../IMAGES/remove.png' alt='Submit' style='height: 30px; border: none; border-radius: 20px; padding: 0.1vw;'>
                            </div>
                       
                            <div>
                            <img  title='Edit task' onclick = showPopUp('editPopUp',". $row["id_Task"].") src='../../IMAGES/edit.png' alt='edit' style='height: 30px; border: none; border-radius: 20px; padding: 0.1vw;'>
                    		</div>
                    </div>
	</div></div><br>"
;
                
                
                
              /*  array_push($this->status_task, $row["stato"]);
                array_push($this->html_task, $finalstring);*/
                
                array_push($status_task, $row["stato"]);
                array_push($html_task, $finalstring);
                
                //unset($row);
            }
           }
           else
           {
          // 	echo "problema";
           }
           
           
           $display_all_tasks = $finalstring;
           
    	
    }
    
    
    function addTask(){
    	global $conn;
		
        //return $_POST['id_solver'];
        
        if(verifica_username_utente($_POST['id_solver'])){
        	$id = getAccountFromUserName($_POST['id_solver']);
    
        }
        else
        {
        	echo 'nobody_with_this_username';
            return 'a';
        }
        
        $begin_date;
        
        if($_POST['data_inizio'] == '')
        {
        	$begin_date = $_POST['data_scadenza'];
        } else {
        	$begin_date = $_POST['data_inizio'];	
        }
        
        
    	$sql = 'INSERT INTO Task (id_account, id_progetto, stato, testo_task, data_scadenza, data_inizio, id_solver)
              VALUES ('.$_SESSION['id_account'].',"'.$_SESSION['id_progetto'].'","'.$_POST['status'].'","'.$_POST['task_text'].'","'.$_POST['data_scadenza'].'","'.$begin_date.'","'.$id.'");';
    
        if ($conn->query($sql) === true) {
        	//	echo "Task added successfully";
                retrieve_all_tasks_informations();
                echo 'Task_Added';
                
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }


    }
    function removeTask(){
    
    	global $conn;
		$sql = "DELETE FROM Task WHERE id_Task=".$_SESSION['id_task'];
        
        if ($conn->query($sql) === TRUE) {
          	retrieve_all_tasks_informations();

        } else {
          echo "Error deleting record: " . $conn->error;
        }

	}
    
    function setTaskToEdit($task)
    {
    	 $_SESSION['id_task'] = $task;
    }
    
    function editTask($task, $testo, $datascadenza, $data_inizio, $id){
    	global $conn;
        
    	        //echo "query: ".$sql."<br>";
        
        if(verifica_username_utente($id)){
        	$id = getAccountFromUserName($_POST['id_solver']);
    
        }
        else
        {
        	return 'nobody_with_this_username';
        }
        
        $begin_date;
        
        if(!isset($_POST['data_inizio']))
        {
        	$data_inizio = $_POST['data_scadenza'];
        } else {
        	$data_inizio = $_POST['data_inizio'];	
        }
        
        
        $sql = "UPDATE Task SET testo_task='".$testo."', data_scadenza = '".$datascadenza."', data_inizio = '".$data_inizio."', id_solver = '".$id."' WHERE id_Task = ".$task.";";

        if ($conn->query($sql) === TRUE) {
        	//$this->retrieve_all_tasks_informations();
            echo 'Task_Edited';
        }
         else {
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
    }
  
  
 
    



if(isset($_POST['Status_to_set']) and isset($_POST['task_id']))
{
	setNewStatus($_POST['task_id'], $_POST['Status_to_set']);

   // $task->retrieve_all_tasks_informations();
}
if(isset($_POST['aggiorna_dati']))
{
   retrieve_all_tasks_informations();
  /*  unset($task->status_task);
    unset($task->html_task);*/
    //echo 'dati aggiornati';
    
    //echo var_dump($html_task);
    unset($_POST['aggiorna_dati']);

}
if($_POST['carica_dati'] == 'status')
{
 //  retrieve_all_tasks_informations();
	echo json_encode(getStatus_task());
}
else if($_POST['carica_dati'] == 'html')
{
   //retrieve_all_tasks_informations();
	echo json_encode(getHTML_task());
}
else if($_POST['action'] == 'add')
{
	addTask();
}
else if($_POST['action'] == 'edit')
{
	editTask($_SESSION['id_task'], $_POST['text_edited'], $_POST['data_scadenza'], $_POST['data_inizio'], $_POST['id_solver']);
}
else if(isset($_POST['task_to_edit']))
{
	setTaskToEdit($_POST['task_to_edit']);
    getTask($_POST['task_to_edit']);
	$par = $task;
    $par['id_solver'] = getAccountInfos(getTaskInfo($_POST['task_to_edit'], 'id_solver'), 'username_utente');
    echo json_encode($par);
}
else if($_POST['action'] == 'delete')
{
	removeTask();
}
else if($_POST['action'] == 'update_events')
{
	retrieve_all_tasks_informations();
	echo json_encode(getEvent());
}



function verifica_username_utente($user){
	global $conn;
  $sql = 
  "SELECT * FROM Account A, Progetto P
WHERE username_utente = '".$user."' AND
 (A.id_Account IN (SELECT id_account_ricevitore FROM Progetti_Condivisi WHERE id_progetto = ".$_SESSION['id_progetto'].") OR (P.id_account = A.id_Account AND id_Progetto = ".$_SESSION['id_progetto']."))
 GROUP BY A.id_Account;";
  $result = $conn->query($sql);
  
  if($result->num_rows > 0){
		return true;
  }
  else{
  	return false; //username non preso
  }

}






?>
