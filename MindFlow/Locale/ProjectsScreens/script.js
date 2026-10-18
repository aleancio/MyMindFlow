function SopraMouse(id){
            document.getElementById(id).style.display="flex";
        }
function FuoriMouse(id){
            document.getElementById(id).style.display="none";
        }
        
        

function Pointer(id){
    	document.getElementById(id).style.cursor="pointer";
        document.getElementById(id).style.backgroundColor="black";
    }
    
    function Pointeroff(id){
    	document.getElementById(id).style.cursor="default";
        document.getElementById(id).style.backgroundColor="#5A7FD7";
    }
var contone = 0;
////////////////////////RIMUOVI PROGETTO////////////////////

function cancellaProgetto()
{

                
                
               swal({

                              title: "Are you sure?",
                              text: "Once deleted, you will not be able to recover this!",
                              icon: "warning",
                              className: "swal-wide",
                              buttons: true,
                              dangerMode: true,
                            })
                            .then((willDelete) => {
                              if (willDelete) {
                                  	$.ajax({
                                      type : 'POST',
                                      url : 'ProjectManager.php',
                                      data : {
                                            azione : 'cancellaProgetto'
                                      },
                                          success : function(parRet){
                                              
                                               swal({
                                               title:"Your project has been deleted", 
                                               icon: "error",
 												className: "swal-wide",
                                                })
                                                .then(a => {
                                                if(a){
                                                	window.location.replace('../IndexProfileScreen/IndexProfile.php')
                                                    }
                                                });
                                          }
                                  });
                              } else {
                                swal({
                                title: "Keep editing this",
                                 className: "swal-wide",
                                });
                              }
                            });


}







///////////////////////////////////////////////////////////////////////TASK MOVEMENT//////////////////////////////
function allowDrop(ev) {
  ev.preventDefault();
}
function denyDrop(ev) {
  ev.stopPropagation();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}
function drop(ev) {
if(ev.target.classList.contains('task'))
{
	console.log('u cant move a task one over another')
}
else{
  //ev.preventDefault();
  var data = ev.dataTransfer.getData("text");
  ev.target.appendChild(document.getElementById(data));
  console.log(ev.target.id)
  console.log(document.getElementById(data).id)
  //chiamata ajax per salvare il nuovo id
  			$.ajax({
                    type : 'POST',
                    url : 'TaskManager.php',
                    data : {
                    	Status_to_set : ev.target.id,
                        task_id : document.getElementById(data).id
                    },
                    success : function(retPar){
                    		//result = JSON.parse(retPar);
                          //  var status_task 
                          	
                           //  console.log("status_setted");
                            // window.location.reload();
                            // drop(ev)
                           // location.reload(); //vedi se magliani sa risolverlo 
                           $.ajax({
                              type : 'POST',
                              url : 'TaskManager.php',
                              data : {
                              		aggiorna_dati : true
                              },
                              success : function(parRet){
                            //  	    console.log(parRet)
                  					    caricaVettoriTask('status')
                            		
                              }
                           })     
                    }
                })     
  
}
}
/*
var status_task = <?php echo json_encode(getStatus_task());?>;
var html_task = <?php echo json_encode(getHTML_task());?>;
*/
function caricaVettoriTask(par)
{
                           $.ajax({
                              type : 'POST',
                              url : 'TaskManager.php',
                              data : {
                              		carica_dati : par
                              },
                              success : function(parRet){
                              	    
                  					if(par == 'status')
                                    {
                                    	status_task = JSON.parse(parRet)
                                        caricaVettoriTask('html')
                                    }
                                    else{
                                    	html_task = JSON.parse(parRet)
                                        putTasks();
                                        //caricaVettoriTask('status')
                                        setTimeout(caricaVettoriTask, 1000, 'status')
                                    }
                                    
                                  
                            		
                              }
                           }) 


}

function putTasks(){
    containerTask()
	window.document.getElementById('to_do').innerHTML = '<div id = "to_do_inner" class = "task" ondragover="denyDrop(event)"> ';
    window.document.getElementById('doing').innerHTML = '<div id = "doing_inner" class = "task" ondragover="denyDrop(event)">';
    window.document.getElementById('done').innerHTML = '<div id = "done_inner" class = "task" ondragover="denyDrop(event)">'; 
	

    
   //	console.log(status_task)
   // console.log(html_task)
    
    i = 0;
    for(let i = 0; i < status_task.length; i++){
    	node = document.createElement('div')
        //textnode = document.createTextNode(html_task[i])
        node.innerHTML = html_task[i]
        //console.log("i: "+status_task[2]);
    	window.document.getElementById(status_task[i]+"_inner").appendChild(node);
        // Change the text of multiple elements with a loop
       // console.log('sium')
    }
    window.document.getElementById('to_do').innerHTML += '</div>'; //wrappo gli elementi
    window.document.getElementById('doing').innerHTML += '</div>';
    window.document.getElementById('done').innerHTML += '</div>'; 
    
    
   // window.document.getElementById('to_do').scrollTop = window.document.getElementById('to_do').scrollHeight
   // window.document.getElementById('doing').scrollTop = window.document.getElementById('doing').scrollHeight    
    // window.document.getElementById('done').scrollTop = window.document.getElementById('done').scrollHeight   

    
    //location.reload();
}


//////////////////////////////CONDIVIDI PROGETTO
 
function share_project_popUp()
{
                            $.ajax({
                              type : 'POST',
                              url : 'ShareProjectPopUp.php',
                              data : {
                              		mostra_nuovo : true
                              },
                              success : function(parRet){
                              	//    console.log(parRet)
                                    node = document.createElement('div')
                                    node.innerHTML = parRet
                                    window.document.body.appendChild(node)
                                  
                              }
                           })	



}

///////////////BACK

function back(){
                 
                 
                 $.ajax({
                              type : 'POST',
                              url : 'ProjectManager.php',
                              data : {
                              		azione : 'fromWhere'
                              },
                              success : function(parRet){
                              	//    console.log(parRet)
                                    
									if(parRet.includes('notSetted')){
                                    	//console.log('da home')
                                    	window.document.getElementById('backForm').submit()
                                    }
                                    else
                                    {
                                    	window.location.replace('../../Classroom/indexClassroom.php')
                                        //console.log('da classroom')
                                    }
                                  
                              }
                           })	
    
    
    
    

    
    
    
    

}


//////////////////////////CHAT
/*
var id_sender = <?php echo json_encode(getId_sender());?> ;
var message_text = <?php echo json_encode(getMessage_text());?>;
*/
function aggiornaArrayMessaggi(par){
                           $.ajax({
                              type : 'POST',
                              url : 'MessageManager.php',
                              data : {
                              		carica_dati : par
                              },
                              success : function(parRet){
                              	    
                  					if(par == 'sender')
                                    {
                                    	id_sender = JSON.parse(parRet)
                                        aggiornaArrayMessaggi('text')
                                    }
                                    else{
                                    	message_text = JSON.parse(parRet)
                                        putMessage();
                                        setTimeout(aggiornaArrayMessaggi, 1000, 'sender')
                                    }
                                    
                                  
                            		
                              }
                           })   

}


function putMessage(){


  /*  
	console.log(id_sender)
    console.log(message_text) 
  */
    var messages = document.getElementById('chat-messages');

   // input.value = '';
    messages.innerHTML = ''
    for(let i = 0; i < id_sender.length; i++){
    	var message = document.createElement('div');
		message.innerHTML = id_sender[i]+" : "+ message_text[i];
        messages.appendChild(message);
        
    }  
    
   	var chatHistory = document.getElementById("chat-messages");
	chatHistory.scrollTop = chatHistory.scrollHeight;

    //con l'id account ho la possibilità di andare a ceracare il tutto
    //mostra i messaggi in modo efficace
    

}
function SparizioneChat(){

			//sistema la funzione con gli effetti e la grafica
           contone = contone+1;
           var keep_visibility;
           console.log("contone: "+contone)
            if(contone==1){
            
              //  document.querySelector(".Lateral").classList.toggle("slide-out-blurred-left");
             keep_visibility = "display:none"
              document.getElementById("chatbox").style="display:none";
              /*  setTimeout(function() {
                	keep_visibility = "a"
                    document.getElementById("chatbox").style="display:none";
                    
                   // document.getElementById("content").style="margin-left: 5%";
                }, 600);*/
                
            }
            else if(contone==2){
                contone=0;
                //document.querySelector(".Lateral").classList.toggle("slide-in-blurred-left");
                document.getElementById("chatbox").style="display : flex"; 
                document.getElementById("Tareoe").style="margin-left: 2vw"; 
                /*document.getElementById("Tabella").rows[0].style.width = "200px";*/
                keep_visibility = 'display : flex'
               // document.getElementById("content").style="margin-left: 0%";
               /* setTimeout(function() {
                    document.querySelector(".Lateral").classList.remove("slide-in-blurred-left");
                    document.querySelector(".Lateral").classList.remove("slide-out-blurred-left");
                    
                }, 600);            */
 
            }
			$.ajax({
                              type : 'POST',
                              url : 'MessageManager.php',
                              data : {
                              		set_chat_visibility : keep_visibility
                              },
                              success : function(parRet){
                              //		console.log(keep_visibility)
                              //	    console.log(parRet);
                              }
                           })


            
}



function sendMessage() {
/* UTILE PER IL DISPLAY DEI MESSAGGI
    var input = document.getElementById('chat-input');
    var messages = document.getElementById('chat-messages');
    var message = document.createElement('p');
    message.textContent = 'Tu: ' + input.value;
    messages.appendChild(message);
    input.value = '';
    */
    
    
    
    var input = document.getElementById('chat-input')
    var messages = document.getElementById('chat-messages');
	//console.log(input)
     $.ajax({
                    type : 'POST',
                    url : 'MessageManager.php',
                    data : {
                    	Text_to_set : input.value
                        
                    },
                    success : function(retPar){
                                console.log('from Send Message: '+retPar);
                                input.value = ''
                                //location.reload();
                               // window.document.getElmentById('chat-messages').innerHTML = retPar;
								//putMessage();
                               /*   var message = document.createElement('p');
                                  message.textContent = retPar;
                                  messages.appendChild(message);
                                 var chatHistory = document.getElementById("chat-messages");
								chatHistory.scrollTop = chatHistory.scrollHeight;*/
                                
                                //aggiorna vettori con ajax
                                
                                aggiornaArrayMessaggi('sender')

                                //chatHistory.scrollTop = "50px";
                                
                    }
                })    
    
    
    
    
}

////////////////////////////TEMRMINAZIONE DI UN PROGETTO////////////////////
function terminaProgetto()
{
				
                           swal({
                              title: "Are you sure?",
                              text: "Once completed, you will not be able to edit this anymore!",
                              icon: "warning",
                              className: 'swal-wide',
                              buttons: true,
                              dangerMode: true,
                            })
                            .then((willDelete) => {
                              if (willDelete) {
                               $.ajax({
                                          type : 'POST',
                                          url : 'ProjectManager.php',
                                          data : {
                                                azione : 'terminaProgetto'
                                          },
                                          success : function(parRet){
                                              
                                               swal({
                                               	title:"Your project has been finished, you can find it in your completed project section", 
                                                icon: "success",    
 												className: "swal-wide",
                                                })
                                                .then(a => {
                                                if(a){
                                                	window.location.replace('../IndexProfileScreen/IndexProfile.php')
                                                    }
                                                });
                                          }
                                  });
                              } else {
                                swal({
                                title: "Keep editing this",
                                 className: "swal-wide",});
                              }
                            });
                           
                           

}



///////////////////////////////////UNDER CONTAINER
function containerTask()
{
	//caricaVettoriTask('status');
	var container = window.document.getElementById('ContenitoreTasksa');
    var finalstring = '<table style="width: 100%; height: 100%; margin-bottom: 1vh;">'
        finalstring +=    '<tr id="BarraTaska">'
                +'<th style="width: 30%;"><img id="AddTaska" style="z-index: 2; position: absolute; left: 11vw;" id="AddImg" src="../../IMAGES/Add.png" alt="" title="Add new task" onclick=showPopUp("addPopUp",1)><div style="z-index: 1;" id="TaskButa">Task:</div></th>'
                +'<th>Date:</th>'
                +'<th>Status:</th>'
                +'<th style="width: 21%;" >Assigned to:</th>'
                +'<th style="width: 10%;"></th>'
            +'</tr>'
            +'<tr style="height: 2vh;"></tr>'    
    
      for(let i = 0; i < status_task.length; i++){
      //titolo
       let firstSlice = html_task[i].slice(html_task[i].indexOf("<div id='titolo' style='font-size: 1.1vw; text-align: left;'>")+61,html_task[i].indexOf("<div id='titolo' style='font-size: 1.1vw; text-align: left;'>")+150)
       let titolo = firstSlice.slice(0, firstSlice.indexOf("</div>"))
      
      //data
      	 firstSlice = html_task[i].slice(html_task[i].indexOf("<div id='expiration' style='font-family: Nordique; font-size: 0.8vw; text-align: left;' >")+90,html_task[i].indexOf("<div id='expiration' style='font-family: Nordique; font-size: 0.8vw; text-align: left;' >")+150)
      let data = firstSlice.slice(0, firstSlice.indexOf("</div>"))
      //let data = firstSlice.slice(0, firstSlice.indexOf(" -"))
      //status
      let status = status_task[i]
      if(status == 'done')
      {
      	status = '<td class="TestoBoxa"> <div style=" padding: 0.2vh; margin:  0 auto; width:50%; background-color: #D9F2D0; color: #8ED973; border-radius: 10px; font-family: Nordique;">Done</div> </td>'
      } else if (status == 'to_do') {
      	status = '<td class="TestoBoxa"> <div style=" padding: 0.2vh; margin:  0 auto; width:50%; background-color: #F2CFEE; color: #D66870; border-radius: 10px; font-family: Nordique;">To Do</div> </td>'
      
      } else {
      
      status = '<td class="TestoBoxa"> <div style=" padding: 0.2vh; margin:  0 auto; width:50%; background-color: #C1E5F5; color: #0070C0; border-radius: 10px; font-family: Nordique;">Doing</div> </td>'
      
      }
      
      //username assegnato
      firstSlice = html_task[i].slice(html_task[i].indexOf("<img title='")+12,html_task[i].indexOf("<img title='")+150)
      let username = firstSlice.slice(0, firstSlice.indexOf("' style"))
      
      //src immagine
      firstSlice = html_task[i].slice(html_task[i].indexOf("src='")+5,html_task[i].indexOf("src='")+150)
      let src = firstSlice.slice(0, firstSlice.indexOf("' alt"))
      
      //task id
     
      firstSlice = html_task[i].slice(html_task[i].indexOf("<img  title='Edit task' onclick = showPopUp('editPopUp',")+56,html_task[i].indexOf("<img  title='Edit task' onclick = showPopUp('editPopUp',")+150)
      let id_task = firstSlice.slice(0, firstSlice.indexOf(")"))

      
      
      
        finalstring += '<tr class="BoxTaska">'
                +'<td class="TestoBoxa">'+titolo +'</td>'
                +'<td class="TestoBoxa">'+data+'</td>'
               +status
               +'<td class="TestoBoxa"><div id="UserTaska">'
               +'<div>' +username+'</div>' 
                 +'   <img src="'+src+'" alt="">'
              +'  </div></td>'
               +' <td class="TestoBoxa"><div id="imgTaska" >'
               /*+' 	<form action = "indexProject.php" method = "POST">'
                 +'           <input type = "hidden" value = "'.$row["id_Task"].'" name = "task_to_delete">'
                +'            <input  title="Delete task" type="image" src="../../IMAGES/bin.png" alt="Bin"></form>'
               +' 	<form action = "indexProject.php" method = "POST">'
                 +'           <input type = "hidden" value = "'.$row['id_Task'].'" name = "task_to_edit">'
                +'            <input  title="Delete task" type="image" src="../../IMAGES/Edit.png" alt="Edit"></form>'    */
                 +'     <img src="../../IMAGES/bin.png" alt="Bin" onclick=showPopUp("delete",'+id_task+')>'
                +'    <img src="../../IMAGES/Edit.png" alt="Edit" onclick=showPopUp("editPopUp",'+id_task+')>'
               +' </div></td>'
            +'</tr>'
        
        
        
        //console.log("i: "+status_task[2]);
    	//window.document.getElementById(status_task[i]+"_inner").appendChild(node);
        // Change the text of multiple elements with a loop
    }
   // console.log(finalstring)

    container.innerHTML = finalstring;
    
    
    

}
s