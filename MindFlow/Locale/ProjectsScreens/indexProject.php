<?php 
    
    session_start();

    if(isset($_POST['id_progetto'])){
    	unset($_SESSION['id_progetto']);    	
    	$_SESSION['id_progetto'] = $_POST['id_progetto']; //memorizzo progetto su cui sto lavorando
		//$_SESSION['id_progetto'] = 15; //rimuovere dopo aver finito
    }


    

    
    

    include 'ProjectManager.php';
    include 'TaskManager.php';
 //   include 'addTask.php';
    include 'ShareProjectPopUp.php';
    include 'confirmDelPopUp.php';
  //  include 'editTask.php';
    include 'MessageManager.php';
    include_once('retrieveProjects.php');
    //include '../../styleSheet.php';
    if($_SESSION['id_account'] == get_project_name('id_account'))
    {
    	$admin = 'yes';
    }
    else
    {
    	unset($admin);
    }
    
    

    
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Project - <?php echo get_project_name('nome_progetto'); ?></title> 
    <link rel="stylesheet" href="../../IMAGES/Fonts.css">
	<link rel="stylesheet" href="stile.css">
   
<script src="https://code.jquery.com/jquery-3.6.4.js"></script>  
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src = 'script.js'></script>   
   
<script>

/////////////////////////////////ONLOAD///////////////////////////////////////////
var status_task = <?php echo json_encode(getStatus_task());?>;
var html_task = <?php echo json_encode(getHTML_task());?>;

const myEvents = 0;

function updateEvents(calendar)
{
                    $.ajax({
                              type : 'POST',
                              url : 'TaskManager.php',
                              data : {
                              		action : 'update_events'
                              },
                              success : function(parRet){
                                //console.log(parRet)
                   				parRet = JSON.parse(parRet)
                             calendar.removeAllEvents(); // Rimuovi tutti gli eventi esistenti
                             for(let i = 0; i < parRet.length; i++)
                             {
                                  var obj = JSON.parse(parRet[i])
                                  calendar.addEvent(obj)
						
                                console.log(obj);
                             
                             }
                             calendar.refetchEvents();
                             
                             
                              }
                           })  
    
}




 window.onload = function(){
/* atribuisci ad ogni task un valore di partenza*/

	//putTasks();
 		var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });
        
        setInterval(updateEvents, 1000, calendar)
        //updateEvents(calendar)
		calendar.render();
  
        
        
        
    console.log( "<?php echo $_SESSION['hide_chat'];?>");
    if("<?php echo $_SESSION['hide_chat'];?>" == "display:none")
    {
    	contone = 1;
    } 
    document.getElementById("chatbox").style="<?php echo $_SESSION['hide_chat'];?>";
    aggiornaArrayMessaggi('sender'); 				
                    
                    $.ajax({
                              type : 'POST',
                              url : 'TaskManager.php',
                              data : {
                              		aggiorna_dati : true
                              },
                              success : function(parRet){
                              	 //   console.log(parRet)
                                       //  status_task = caricaVettoriTask('status')
    									 //html_task = caricaVettoriTask('html')
                            		//setTimeout(putTasks(),5000);
                                        caricaVettoriTask('status')   
                              }
                           })  
    
    
 }
</script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script>




   /*   
     var calendar = new Calendar(calendarEl, {
  events: [
  ],
  eventColor: '#378006'
});
*/
    </script>
</head>



<body>




<!-- Header -->

<header style="border-radius: 15px; width: 95vw;  padding-bottom:1vh;  margin: 0 auto; margin-top: 10px; padding-left: 20px; ">  
    <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
    	<div style="display: flex; flex-direction: row;">
    	<?php 
    	echo '<h1 style="font-size: 55px;margin: 0;padding: 0; font-family: Metropolis, sans-serif;">'.get_project_name('nome_progetto').'</h1>';
    	if($admin == 'yes')
        	{
        
          	echo  '<form action="../IndexProfileScreen/modificaProgetto.php" method="POST">
                    <input type="hidden" value="'.get_project_name('id_Progetto').'" name="id_Progetto">
                    <input type="hidden" value="'.get_project_name('nome_progetto').'" name="nome_progetto">
                    <input type="hidden" value="'.get_project_name('data_scadenza').'" name="data_scadenza">
                    <input type="hidden" value="'.get_project_name('colore_progetto').'" name="colore_progetto">                         
                    <input type = "image" src="../../IMAGES/editb.png" style="margin-left:10px; height: 25px; width: 25px; margin-top: 15px;">                           
            </form>';
        	}  
        ?>
        </div>
    
        <?php	
        if($admin == 'yes')
        {
          echo  '<div><button style="background: none; width:40px; border:none; height: 40px;"><img style="width: 100%; height: auto;" src="../../IMAGES/bin.png" onclick = "cancellaProgetto()"></button></div>';       
        }
        ?>
    </div>

    <div>
        <?php echo '<h1 style="font-size: 18px; padding: 0;margin: 0; margin-bottom: 3vh; font-family: OstrichSans-Heavy, sans-serif;"> Expiration Date: '.get_project_name('data_scadenza').'</h1>';?>
    </div>
    
    <div id = 'consegna' style=" width: 95%; margin: 0 auto; background-color: #262626; border-radius: 13px; border:none; color: white; font-family: Nordique; font-size: 13pt; padding: 2vh; margin-bottom: 2vh; margin-top: 3vh;">
        <b style="font-family: OstrichSans-Heavy;">Istructions:</b>
        <?php
        if(retrieveConsegna()=="0"){
          echo "<script>document.getElementById('consegna').style.display = 'none';</script>";
        }
        else{ echo retrieveConsegna(); }
        ?>
	</div>
   
    <div style="font-family:OstrichSans-Heavy, sans-serif; display: flex;  justify-content: space-between; align-items: center;">
	    <div style="display: flex;">
	    <?php
    	//$_SESSION['utente_admin'] = 1;
            echo '<button class="bottone" onclick = "SparizioneChat()">Chat</button>';
            if($admin == 'yes')
            {
                echo "<input type = 'button' value = 'Share Project' class='bottone' onclick = 'share_project_popUp()'>";
                echo "<button  class='bottone' onclick = "."window.location.replace("."'https://mindflow.altervista.org/Social/indexCreation.php'".")".">Post</button>";
            }
        
        ?>
    </div>
    
    <div><img src="../../IMAGES/SitoB.png" style=" width:65vw; height: 4vh;"></div>
    
    <div style="display: flex;">
    <?php
    	if($admin == 'yes')
        {
        	echo "<button class='bottone'  onclick = 'terminaProgetto()'>Finish</button>";
        	echo "<button class='bottone' onclick = "."window.location.replace("."'https://mindflow.altervista.org/Locale/ProjectsScreens/addToClass.php'".")".">Folder</button>";
        
        }
    
    ?>
    
    
	<form id = 'backForm' action = '../IndexProfileScreen/IndexProfile.php' method = "POST">
    	<input type = 'hidden' name ='modifica_ultimo_accesso'>
    	<input type = 'button' onclick = 'back()' value = 'Back' class="bottone" >
    </form>
    
    
    </div>
</div>


</header>
<br>
<br>


<div id="chatbox" class = "chatbox" >

    	<div id="chat-messages" class="chat-messages" style="margin-bottom: -16px; font-family: Nordique; font-size: 14pt; margin: 0 auto; border-radius: 10px; background-color: #e5e5e5; color: black; font-family: Nordique; font-size: 15pt;">
        	
    	</div>
        <br>
        <div>
    		<input style = 'font-family: Nordique; font-size: 14pt; width:50vw; padding: 1vh; height: 2.5vh; border-radius: 10px; margin-bottom: 2vh;'type="text" id="chat-input" class="chat-input" placeholder="type a message..." onkeydown="if (event.keyCode == 13) sendMessage()">
    	</div>

</div>
<br>
<br>
<script>
function displayAddEditError(a){
                      if(a == 'nobody_with_this_username')
                      {
						swal({
                            title: 'ERROR',
                            text: 'nobody with this username is in this project',
                            icon: 'error',
                            className: "swal-wide",
                          });
                      }
                      
}


</script>


<!-- ADD TASK -->
<div id = 'addPopUp' class='addPopUp' style = 'display: none;'>
<div class = "popUP" style="width:25vw; padding-bottom:2vh;">
    <h1>Add New Task</h1>
    <form action="indexProject.php" method="post"  id = "f1" class='f1'>      
		<div style="display: flex; flex-direction: column;">
        <label  style=" font-size: 3vh;" for="task_text" id="text" class='text'>Task Text:</label> 
        <input type = "text" id="task_text" class='task_text' autocomplete="off" autofill="off" name="task_text" style="margin: 0 auto; font-family:Nordique; max-width:90% ; font-size: 2vh; max-height:3vh; width: 80%;" rows="4" required>
        </div>
        <br>
        <div style="display: flex; flex-direction: column; margin: 0 auto; align-iems: center;">
        <div style=" font-size: 3vh; text-align: center; margin-top: 2vh; ">
        <label for="data_inizio" style="font-family:OstrichSans-Heavy, sans-serif; "> begin date:</label>
        <input type = "date" id = "data_inizio" name = "data_inizio" style="height:3vh;"> 
        </div>
        <div style=" font-size: 3vh; text-align: center; margin-top: 1vh; ">
        <label for="data_scadenza" style="font-family:OstrichSans-Heavy, sans-serif; "> expiration date:</label>
        <input type = "date" id = "data_scadenza" name = "data_scadenza" style="height:3vh;" required> 
        </div>
        <div style=" width: 100%; font-size: 3vh; text-align: center; margin-top: 1vh; ">
        <label for="id_solver" id="data_inizio" style="font-family:OstrichSans-Heavy, sans-serif; "> Solver: </label>
        <input type = "text" name = "id_solver" id = "id_solver" style="height:3vh;" required>         	   	
        </div>
        </div>
        <br>
        
        <input id="ExitButnm" type="button" value = "Exit" onclick = "closePopUp('addPopUp')"  style="margin-top:2vh; margin-right:1vh; height: 6vh; width: 6vw; background-color: #5A7FD7; font-family:OstrichSans-Heavy, sans-serif; margin-bottom:2vh; font-size: 3vh;padding: 1vh; border: none; border-radius: 20pt; color: white;" onmouseover="Pointer(this.id)" onmouseleave="Pointeroff(this.id)" >
        <input type = 'button' value = 'Add Task' id="AddButnm" onclick = aggiungiTask() style="margin-top:3vh; margin-right:1vh; height: 6vh; width: 6vw; background-color: #5A7FD7; font-family:OstrichSans-Heavy, sans-serif; margin-bottom:2vh; font-size: 3vh;padding: 1vh; border: none; border-radius: 20pt; color: white; " onmouseover="Pointer(this.id)" onmouseleave="Pointeroff(this.id)">
     </form> 
</div>
<script>

function setTask(id, a)
{
   $.ajax({
                              type : 'POST',
                              url : 'TaskManager.php',
                              data : {
									task_to_edit : id
                              },
                              success : function(parRet){
                              		
                              		result = JSON.parse(parRet)
                                    
                                    //window.document.getElementById('task_text_edit').setAttribute('value', 'sium')


                                    if(a == 'editPopUp'){
                                      	window.document.getElementById('task_text_edit').value = String(result['testo_task'])
                                     	window.document.getElementById('data_inizio_edit').value = result['data_inizio']
                                     	window.document.getElementById('data_scadenza_edit').value = result['data_scadenza']
                                     	window.document.getElementById('id_solver_edit').value = result['id_solver']
                                    	window.document.getElementById('editPopUp').style = 'display: inline'
                                    } else {
                                    	deleteTask();
                                    }

                                  }
                               });

}

function showPopUp(a, n_task)
{
 //console.log(a)
 	
    if(a != 'addPopUp')
    {
    	setTask(n_task, a);
    }
    else
    {
    	window.document.getElementById(a).style = 'display: inline';
    }
}
function closePopUp(a)
{
 	window.document.getElementById(a).style = 'display: none';
}

function aggiungiTask()
{
/*
window.document.getElementById('task_text').value = ''
window.document.getElementById('data_inizio').value = ''
window.document.getElementById('data_scadenza').value = ''
window.document.getElementById('id_solver').value = ''
*/
   $.ajax({
                              type : 'POST',
                              url : 'TaskManager.php',
                              data : {
                              		action : 'add',
                                    status : 'to_do',
                                    task_text : window.document.getElementById('task_text').value,
                                    data_inizio : window.document.getElementById('data_inizio').value,
                                    data_scadenza : window.document.getElementById('data_scadenza').value,
                                    id_solver : window.document.getElementById('id_solver').value
                              },
                              success : function(parRet){
                              	//DISPLAY ERRORI
                                window.document.getElementById('task_text').value = ''
                                window.document.getElementById('data_inizio').value = ''
                                window.document.getElementById('data_scadenza').value = ''
                                window.document.getElementById('id_solver').value = ''
                                  
                                  if(parRet.includes('Task_Added')){
                                  	closePopUp('addPopUp')
                                  } else {
                                  	displayAddEditError('nobody_with_this_username')
                                  }
                              }
                           })



}

function editTask()
{
   $.ajax({
                              type : 'POST',
                              url : 'TaskManager.php',
                              data : {
                              		action : 'edit',
                                    text_edited : window.document.getElementById('task_text_edit').value,
                                    data_inizio : window.document.getElementById('data_inizio_edit').value,
                                    data_scadenza : window.document.getElementById('data_scadenza_edit').value,
                                    id_solver : window.document.getElementById('id_solver_edit').value
                              },
                              success : function(parRet){
                              	//DISPLAY ERRORI
                              
                              	  console.log(parRet)
                                  
                                  if(parRet.includes('Task_Edited')){
                                  	closePopUp('editPopUp')
                                  } else {
                                  	displayAddEditError('nobody_with_this_username')
                                  }
                              }
                           })





}
</script>
</div>

<!-- EDIT TASK-->
<div id = 'editPopUp' class='editPopUp' style = 'display: none;'>
<div class = "popUP" style="width:25vw; padding-bottom:2vh;">
<h1>Edit Task</h1>


	
        
       <form action="indexProject.php" method="post"  id = "f1" style="align-content: center;">      
		<div style="display: flex; flex-direction: column;">
        <label  style=" font-size: 3vh;" for="task_text" id="text" class='text' >Task Text:</label> 
        <input type = "text" class="task_text" id="task_text_edit" autocomplete="off" autofill="off" name="task_text" style="margin: 0 auto;font-size: 2vh; max-height:3vh; font-family:Nordique; max-width:90% ; max-height:2vh; width: 80%;" rows="4" required>
        </div>
        <br>
        <div style="display: flex; flex-direction: column; margin: 0 auto; align-iems: center;">
        <div style=" font-size: 3vh; text-align: center; margin-top: 2vh; ">
        <label for="data_inizio" style="font-family:OstrichSans-Heavy, sans-serif; "> begin date:</label>
        <input type = "date" id = "data_inizio_edit"  name = "data_inizio" style="height:3vh;"> 
        </div>
        <div style=" font-size: 3vh; text-align: center; margin-top: 1vh; ">
        <label for="data_scadenza" style="font-family:OstrichSans-Heavy, sans-serif; "> expiration date:</label>
        <input type = "date" id = "data_scadenza_edit"  name = "data_scadenza" style="height:3vh;" required> 
        </div>
        <div style=" width: 100%; font-size: 3vh; text-align: center; margin-top: 1vh; ">
        <label for="id_solver" id="data_inizio" style="font-family:OstrichSans-Heavy, sans-serif; "> Solver: </label>
        <input type = "text" name = "id_solver" id = "id_solver_edit"  style="height:3vh;" required>         	   	
        </div>
        </div>
        <br>
        
        <input id="ExitButnm" type="button" value = "Exit" onclick = "closePopUp('editPopUp')"  style="margin-top:2vh; margin-right:1vh; height: 6vh; width: 6vw; background-color: #5A7FD7; font-family:OstrichSans-Heavy, sans-serif; margin-bottom:2vh; font-size: 3vh;padding: 1vh; border: none; border-radius: 20pt; color: white;" onmouseover="Pointer(this.id)" onmouseleave="Pointeroff(this.id)" >
        <input type = 'button' value = 'Edit Task' id="AddButnm" onclick = 'editTask()' style="margin-top:3vh; margin-right:1vh; height: 6vh; width: 6vw; background-color: #5A7FD7; font-family:OstrichSans-Heavy, sans-serif; margin-bottom:2vh; font-size: 3vh;padding: 1vh; border: none; border-radius: 20pt; color: white; " onmouseover="Pointer(this.id)" onmouseleave="Pointeroff(this.id)">
     </form> 
</div>
</div>

<!-- DELETE TASK-->

<script>
function deleteTask()
{
  $.ajax({
                              type : 'POST',
                              url : 'TaskManager.php',
                              data : {
									action : 'delete'
                              },
                              success : function(parRet){
                                   swal({
                                      title: 'DONE',
                                      text: 'Task Deleted Successfully',
                                      icon: 'error',
                                      className: "swal-wide",
                                    });
                                  }
                               });


}



</script>









<div class="TaskContainer" id="Tareoe" style="width:100%; margin: 0; padding: 0;">
<?php 
//////////////ADD TASK


/////////////////////REMOVE TASK


   
?>


<table id="Tabella" style=" margin: 0; margin: 0 auto;" >
<tr>
<td class="Colon"><div style="display: flex; justify-content:space-between;"> <button style="border:none; bacground-color: none" onclick = 'showPopUp("addPopUp", 1)' ><img title="Add new task" onmouseover="this.style.cursor='pointer'" style="height: 4vh;" src="../../IMAGES/new.png" alt=""></button><div style = "font-weight: bold; font-size: 20pt;">TO DO</div><div style="margin-right: 2vw;">
</div></div></td>
<td class="Colon"><div style = "font-weight: bold; font-size: 20pt;">IN PROGRESS</div></td>
<td class="Colon"><div style = "font-weight: bold; font-size: 20pt;">DONE</div></td>
</tr>
<tr>
<td class="Colon"><div id="to_do" class = 'div1' style = "border-radius:10px; background-color: rgb(255, 188, 188);" ondrop="drop(event)" ondragover="allowDrop(event)"></div></td>
<td class="Colon"><div id="doing"  class = 'div1' style = "border-radius:10px; background-color: #C1E5F5 ;" ondrop="drop(event)" ondragover="allowDrop(event)"></div></td> <!--#C1E5F5-->
<td class="Colon"><div id="done" class = 'div1' style = "border-radius:10px; background-color: #D9F2D0;" ondrop="drop(event)" ondragover="allowDrop(event)"></div></td>
</tr>
</table>
</div>


<div id="Calendario" >
<div id='calendar'></div>
</div>
<br>
<br>
<br>
<br>


<div id="ContenitoreTasksa"></div>

<br>
<br>
<br>
<br>



<script>
                    
function displayShareError(a){
                      if(a == 'Done')
                      {
						swal({
                            title: 'SUCCESS',
                            text: 'Project shared successfully',
                            icon: 'success',
                            className: "swal-wide",
                          });

                      }   else if(a != 'already_shared') {

                          
                         swal({
                            title: 'ERROR',
                            text: 'Username '+a+' was not found, please try another one',
                            icon: 'error',
                            className: "swal-wide",
                          });
                      
                      } else {
                          swal({
                            title: 'ERROR',
                            text: 'You already shared this project with this account',
                            icon: 'error',
                            className: "swal-wide",
                          });
                      
                      }
                      
}
</script>
                
    <?php
       if(isset($_POST['username_account_ricevitore'])){
                	//echo "inside";
                 //   $_SESSION['id_account'] = 10;
                	 $sherError = addConnection();
                   //  echo $_SESSION['id_progetto'];
                    echo "<script>displayShareError('$sherError')</script>";
                }


?>




</body>
</html>
