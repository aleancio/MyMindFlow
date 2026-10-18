<?php
session_start();

	$id_sender = [];
    $message_text = [];

    
   
    
    function setId_sender($ele){
    global $id_sender;
    	$id_sender[] = $ele;
    }
     function setMessage_text($ele){
     global $message_text;
    	$message_text[] = $ele;
    }
     
    function getId_sender(){
    	global $id_sender;
        //retrieveMessageInfo();
    	return $id_sender;
    }
    function getMessage_text(){
    	global $message_text;
    	//retrieveMessageInfo();
    	return $message_text;
    }
    
    
    
    function retrieveMessageInfo(){
    	global $conn;
    	$sql = "SELECT * FROM Messages WHERE id_progetto = ".$_SESSION['id_progetto']." ORDER BY id_Messaggio;";
        $result = $conn->query($sql);
       if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
 				setId_sender("<img style = 'border-radius: 50%; height: 15px; width: 15px;' src = '". getAccountInfos($row['id_sender'],'foto_profilo')."'>"); //setta per fare la chat
                setMessage_text($row['testo_messaggio']);   
            }
        } 
        else{
        // echo 'no_message'; //completa
        }
 
    }
    function newMessage($text){
    global $conn;
    	$sql = 'INSERT INTO Messages (id_sender, id_progetto, testo_messaggio)
              VALUES ('.$_SESSION['id_account'].',"'.$_SESSION['id_progetto'].'","'.$text.'");';
    	if ($conn->query($sql) === true) {
        	//	echo "Task added successfully";
                //$this->retrieve_all_tasks_informations();
            //    echo "nuovo messaggio scritto";
            echo $_SESSION['id_account']." : ".$text;
                
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
    
    }
    
    
    











include '../../connect.php';
include_once('../IndexProfileScreen/retrieveProjects.php');



if(isset($_POST['Text_to_set']))
{
	if($_POST['Text_to_set'] != ''){
		newMessage($_POST['Text_to_set']);
    }
}
if(isset($_POST['set_chat_visibility']))
{
	
	retrieveMessageInfo();
	$_SESSION['hide_chat'] = $_POST['set_chat_visibility'];
    echo $_SESSION['hide_chat'];
}

if($_POST['carica_dati'] == 'sender'){
	$id_sender = [];
	retrieveMessageInfo();
	echo json_encode(getId_sender());
}
if($_POST['carica_dati'] == 'text')
{
$message_text = [];
retrieveMessageInfo();

	echo json_encode(getMessage_text());
}









?>
