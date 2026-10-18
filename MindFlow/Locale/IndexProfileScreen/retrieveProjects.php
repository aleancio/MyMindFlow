<?php
session_start();
//$_SESSION['id_account'] = 13; //da togliere una volta collegati i progetti
//la logica nelle funzioni è quella di creare stringhe html da applicare poi all'interno di altri script
include '../../connect.php';
include '../../Social/PostManager.php';
    // Properties
    $projects = 0;
    $account_infos = array();
    $shared_progects = 0;
    $private_progects = 0;
    $finished_projects = 0;
    $search_results = 0;
    $progress = 0;
  //inizializzo le proprietà
 //inizializzo le proprietà


    // Methods
    
    //getters
     function getImageProfile(){
    	return $image_profile;
    }
    
     function getProjects() {
     	global $projects;
     	retrieveProjects($_SESSION['ordine_progetti']);
        return $projects;
    }

     function getAccountInfos($id, $field) {
     	global $account_infos;
     	retrieveAccountData($id);
        return $account_infos[$field];
    }
     function getSharedProjects() {
     	global $shared_progects;
     	retrieveSharedProjects();
        return $shared_progects;
    }
     function getPrivateProjects() {
     	global $private_progects;
     retrievePrivateProject();
        return $private_progects;
    }
    function getFinishedProjects() {
     	global $finished_projects;
     retrieveFinishedProjects();
        return $finished_projects;
    }
     function getSearchResult(){
    	return $search_results;
    
    }

    //own projects retriever
     function retrieveProjects($order) { 
    	global $conn, $projects;
        $sql = "SELECT * FROM Progetto WHERE id_account = ".$_SESSION['id_account']." and stato_progetto <> 'finished' ORDER BY ".$order;  // corrected table name: Progetto instead of Progetti
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
			$finalstring ='<script>
            			function sub(numeroform){
                        	window.document.getElementById(numeroform).submit()
                            
                        }
            			</script>';
            $finalstring .= '<div style = "display: flex; flex-direction: row;">';
            while ($row = $result->fetch_assoc()) {     
                $finalstring .=
                '<div class="BOX" style = "background-color: '.$row['colore_progetto'].'">
                         
                    	<div>'.imageRetriever($row["id_Progetto"]).'</div>
                        <form id = "go_form_'.$row["id_Progetto"].'" action = "../ProjectsScreens/indexProject.php" method = "POST">
                         <input name = "id_progetto" type = "hidden" value ='.$row['id_Progetto'].'>   
                       </form>
						<div id="BOXDati"  onclick = sub("go_form_'.$row["id_Progetto"].'")> 
                        	<div class="DatiProject" id="TitoloProgetto">'.$row["nome_progetto"].'</div>
                            <div class="DatiProject" >Last edit: '.$row["data_ultima_modifica"].'</div>
                            <div class="DatiProject" >Expiration date: '.$row["data_scadenza"].'</div>
                            <div class="DatiProject" style="display: flex; flex-direction: row; justify-content: center;"><div>Progress: &nbsp  </div><div id="Percentuale" >'.percentualeCompletamento($row["id_Progetto"]).'</div></div>
                        </div>      

                  </div>';
            }
            $finalstring .= '</div>';
        } else {
            $finalstring = "0 results";
        }

        $projects = $finalstring;  // store the result in the class property
    }
    
    
    function retrieveFinishedProjects() { 
    	global $conn, $finished_projects;
        $sql = "SELECT * FROM Progetto WHERE id_account = ".$_SESSION['id_account']." and stato_progetto = 'finished' ORDER BY ".$_SESSION['ordine_progetti_finiti'];  // corrected table name: Progetto instead of Progetti
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
			$finalstring ='<script>
            			/*function sub(numeroform){
                        	window.document.getElementById(numeroform).submit()
                            
                        }*/
            			</script>';
            $finalstring .= '<div style = "display: flex; flex-direction: row;">';
            while ($row = $result->fetch_assoc()) {     
                $finalstring .=
                '<div class="BOX" style = "background-color: '.$row['colore_progetto'].'">
                         
                    	<div>'.imageRetriever($row["id_Progetto"]).'</div>
                        <form id = "form_'.$row["id_Progetto"].'" action = "../ProjectsScreens/indexProject.php" method = "POST">
                         <input name = "id_progetto" type = "hidden" value ='.$row['id_Progetto'].'>   
                       </form>
						<div id="BOXDati"  onclick = sub("go_form_'.$row["id_Progetto"].'")> 
                        	<div class="DatiProject" id="TitoloProgetto">'.$row["nome_progetto"].'</div>
                            <div class="DatiProject" >Finished: '.$row["data_ultima_modifica"].'</div>
                        </div>      

                  </div>';
            }
            $finalstring .= '</div>';
        } else {
            $finalstring = "0 results";
        }

        $finished_projects = $finalstring;  // store the result in the class property
    }    
    
    //account data retriever
     function retrieveAccountData($id) {
    	global $conn, $account_infos;
        $sql = "SELECT * FROM Account WHERE id_Account = ".$id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            $finalstring = '<table>';
            while ($row = $result->fetch_assoc()) {
                //carico tutte le info su un array e le sfrutto da qua
                $account_infos = $row;
            }
            $finalstring .= '</table>';
        } else {
            $finalstring = "0 results";
        }

          // store the result in the class property
        //  $this->account_infos =$finalstring;
        //echo $this->account_infos['foto_profilo']; 
        
    }
    
    
    function imageRetriever($id_progetto){
    	global $conn;
        $finalstring ='';
        //$finalstring = '<img class="UserProject" src = "'.getAccountInfos($_SESSION['id_account'], 'foto_profilo').'">';
/*
        $sql = 'SELECT * FROM Progetti_Condivisi WHERE id_account_condivisore <> '.$_SESSION['id_account'].' and id_progetto = '.$id_progetto.';';
        $result = $conn->query($sql);
       // $finalstring = '<img class="UserProject" src = "'.getAccountInfos($_SESSION['id_account'], 'foto_profilo').'">';
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                //carico tutte le info su un array e le sfrutto da qua
                    $finalstring = '<img class="UserProject" src = "'.getAccountInfos($row['id_account_condivisore'], 'foto_profilo').'">';
            }
        }
        else{
        	$finalstring = '<img class="UserProject" src = "'.getAccountInfos($_SESSION['id_account'], 'foto_profilo').'">';
        
        }

*/
        $sql = 'SELECT * FROM Progetto WHERE id_Progetto = '.$id_progetto.';';
        $result = $conn->query($sql);
       // $finalstring = '<img class="UserProject" src = "'.getAccountInfos($_SESSION['id_account'], 'foto_profilo').'">';
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                //carico tutte le info su un array e le sfrutto da qua
               
                $finalstring = '<img class= "UserProject" title="'.getAccountInfos($row['id_account'], 'username_utente').'" src = "'.getAccountInfos($row['id_account'], 'foto_profilo').'">';
                            
                
            }
        }



        $sql = 'SELECT * FROM Progetti_Condivisi WHERE id_progetto = '.$id_progetto.';';
        $result = $conn->query($sql);
       // $finalstring = '<img class="UserProject" src = "'.getAccountInfos($_SESSION['id_account'], 'foto_profilo').'">';
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                //carico tutte le info su un array e le sfrutto da qua
                    $finalstring .= '<img class="UserProject" title="'.getAccountInfos($row['id_account_ricevitore'], 'username_utente').'" src = "'.getAccountInfos($row['id_account_ricevitore'], 'foto_profilo').'">';
            }
        }
      
      

        
    	return $finalstring;
    
    }
    
    //shared projects retriever
     function retrieveSharedProjects() {
    	global $conn, $shared_progects;
        $sql = 'SELECT * FROM Progetto P, Progetti_Condivisi C, Account A WHERE stato_progetto <> "finished" and A.id_Account = '.$_SESSION['id_account'].' and (A.id_Account = C.id_account_ricevitore OR A.id_Account = C.id_account_condivisore) and P.id_Progetto = C.id_progetto GROUP BY P.id_Progetto ORDER BY '.$_SESSION['ordine_progetti_condivisi'];
        $result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$finalstring ='<script>
            			function sub(numeroform){
                        	window.document.getElementById(numeroform).submit()
                            
                        }
            			</script>';
            $finalstring .= '<div style = "display: flex; flex-direction: row;">';
            while ($row = $result->fetch_assoc()) {     
                $finalstring .=
                '<div class="BOX" style = "background-color: '.$row['colore_progetto'].'">
                         
                    	<div>'.imageRetriever($row["id_Progetto"]).'</div>
                        <form id = "go_form_'.$row["id_progetto"].'" action = "../ProjectsScreens/indexProject.php" method = "POST">
                         <input name = "id_progetto" type = "hidden" value ='.$row['id_Progetto'].'>   
                       </form>
						<div id="BOXDati"  onclick = sub("go_form_'.$row["id_Progetto"].'")> 
                        	<div class="DatiProject" id="TitoloProgetto">'.$row["nome_progetto"].'</div>
                            <div class="DatiProject" >Last edit: '.$row["data_ultima_modifica"].'</div>
                            <div class="DatiProject" >Expiration date: '.$row["data_scadenza"].'</div>
                            <div class="DatiProject" style="display: flex; flex-direction: row; justify-content: center;"><div>Progress: &nbsp  </div><div id="Percentuale" >'.percentualeCompletamento($row["id_progetto"]).'</div></div>
                        </div>      

                  </div>';
            }
            $finalstring .= '</div>';
        } else {
            $finalstring = "0 results";
        }

        $shared_progects = $finalstring;  // store the result in the class property
    }
    
    
    
    
    
    function retrievePrivateProject(){
    	global $conn, $private_progects;
        $sql = 'SELECT * FROM Progetto WHERE  stato_progetto <> "finished" and id_account = '.$_SESSION['id_account'].'  and  id_Progetto not in (SELECT C.id_progetto FROM Progetti_Condivisi C, Account A WHERE A.id_Account = '.$_SESSION['id_account'].'   and (C.id_account_ricevitore <> A.username_utente or C.id_account_condivisore <> A.id_Account )) ORDER BY '.$_SESSION['ordine_progetti_privati'].";";
        $result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$finalstring ='<script>
            			function sub(numeroform){
                        	window.document.getElementById(numeroform).submit()
                            
                        }
            			</script>';
            $finalstring .= '<div style = "display: flex; flex-direction: row;">';
            while ($row = $result->fetch_assoc()) {     
                $finalstring .=
                '<div class="BOX" style = "background-color: '.$row['colore_progetto'].'">
                         
                    	<div>'.imageRetriever($row["id_Progetto"]).'</div>
                        <form id = "go_form_'.$row["id_Progetto"].'" action = "../ProjectsScreens/indexProject.php" method = "POST">
                         <input name = "id_progetto" type = "hidden" value ='.$row['id_Progetto'].'>   
                       </form>
						<div id="BOXDati"  onclick = sub("go_form_'.$row["id_Progetto"].'")> 
                        	<div class="DatiProject" id="TitoloProgetto">'.$row["nome_progetto"].'</div>
                            <div class="DatiProject" >Last edit: '.$row["data_ultima_modifica"].'</div>
                            <div class="DatiProject" >Expiration date: '.$row["data_scadenza"].'</div>
                            <div class="DatiProject" style="display: flex; flex-direction: row; justify-content: center;"><div>Progress: &nbsp  </div><div id="Percentuale" >'.percentualeCompletamento($row["id_Progetto"]).'</div></div>
                        </div>      

                  </div>';
            }
            $finalstring .= '</div>';
        } else {
            $finalstring = "0 results";
        }

        $private_progects = $finalstring;  // store the result in the class property    
    
    
    
    }
    
    
    //search
    function searchProject($nome_progetto){
    	global $conn, $search_results;
    	$sql = 'SELECT * FROM Progetto P WHERE id_account = '.$_SESSION['id_account'].' AND nome_progetto = "'.$nome_progetto.'";';
     //   echo $sql;
        $result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$finalstring ='
            
            	<script>
            			function sub(numeroform){
                        	window.document.getElementById(numeroform).submit()
                            
                        }
            			</script>';
            $finalstring .= '<div style = "display: flex; flex-direction: row;">';
            while ($row = $result->fetch_assoc()) {     
                $finalstring .=
                '<div><div><h1 style="font-family: OstrichSans-Heavy; font-size: 32px; ">Result:</h1></div> 
                        <div class="BOX" style = "background-color: '.$row['colore_progetto'].'">                
                    	<div>'.imageRetriever($row["id_Progetto"]).'</div>
                        <form id = "go_form_'.$row["id_Progetto"].'" action = "../ProjectsScreens/indexProject.php" method = "POST">
                         <input name = "id_progetto" type = "hidden" value ='.$row['id_Progetto'].'>   
                       </form>
						<div id="BOXDati"  onclick = sub("go_form_'.$row["id_Progetto"].'")> 
                        	<div class="DatiProject" id="TitoloProgetto">'.$row["nome_progetto"].'</div>
                            <div class="DatiProject" >Last edit: '.$row["data_ultima_modifica"].'</div>
                            <div class="DatiProject" >Expiration date: '.$row["data_scadenza"].'</div>
                            <div class="DatiProject" style="display: flex; flex-direction: row; justify-content: center;"><div>Progress: &nbsp  </div><div id="Percentuale" >'.percentualeCompletamento($row["id_Progetto"]).'</div></div>
                        </div>      
					</div> 
                  </div>';
            }
            $finalstring .= '</div>';
        } else {
            $finalstring = "0 results";
        }        
        
        $search_results = $finalstring;
        echo $search_results;
    
    }
    
    
    
    
    //sposta questa
    function setLastMod(){
    	global $conn;
       $sql = "UPDATE Progetto SET data_ultima_modifica = CURRENT_TIMESTAMP  WHERE id_Progetto = ".$_SESSION['id_progetto'];
        if ($conn->query($sql) === TRUE) {
         // echo "Record deleted successfully";
        } else {
          echo "Error deleting record: " . $conn->error;
        }
        retrieveProjects($_SESSION['ordine_progetti']);
        retrieveSharedProjects();
        retrievePrivateProject();
      }
    
    
////////////////////////SOCIAL///////////////////////////    
function postPiaciuti()
{
global $conn;
$sql = 'SELECT * FROM Post P, Cuori C WHERE P.id_Post = C.id_post AND C.id_account_liker ='.$_SESSION['id_account'].';';
$result = $conn->query($sql);
       if ($result->num_rows > 0) {
            // output data of each row
            $final = '<table>';
            while ($row = $result->fetch_assoc()) {
            	if($I == 3){
                    $final .= "</tr><tr>" ;
                    $I = 1;
                 }
                 else{
                 	$I+=1;                	
                 }
                 $final .= "<td><div  id = 'post".$row["id_Post"]."' style=' padding-top: 1vh; background-color: #262626; border-radius: 22px; margin: 1.7vw; height: 41vh; width:20vw; color: white; font-family: Nordique; margin-bottom: 5vh; display: flex; flex-direction: column; align-items: center;'>".
                              "<img onclick='Descrizione(".$row["id_Post"].")' style='width:19vw; height: 27vh; margin: 0 auto; border-radius: 20px;' src=". $row["immagine"] .">".
                              "<div style='margin-top:1.3vh; display: flex; flex-direction: column;'> ".
                                "<div style='margin: 0 auto; margin-top: 0.5vh; font-family: OstrichSans-Heavy; font-size: 20pt; margin-bottom: -0.4vh;'> " . $row["titolo"] . "</div>".
                                "<div style='margin: 0 auto; display:flex; gap: 5vw; font-size: 15pt;'>".
                                  "<div>" . $row["durata"] ."</div>".
                                 
                                "</div>".
                              "</div>".
                            "</div>";
               	
			}
            $final .= '</table>';
        } 
        else{
          $final = '<br><br><div style="font-family: Nordique; font-size: 20pt;">     Empty...</div>';
        }
	
    return $final;
}
function countPostPiaciuti(){
    	global $conn;
        $sql = 'SELECT COUNT(*) numero_post_piaciuti FROM Post P, Cuori C WHERE P.id_Post = C.id_post AND C.id_account_liker ='.$_SESSION['id_account'].';';
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
           while ($row = $result->fetch_assoc()) {
                //carico tutte le info su un array e le sfrutto da qua
              return $row['numero_post_piaciuti'];
            }
        } else {
            return  "0 results";
        }

}
function countlikes(){
    	global $conn;
        $sql = 'SELECT COUNT(*) as numero_like FROM Cuori C, Post P WHERE C.id_Post = P.id_Post AND P.id_account = '.$_SESSION['id_account'].';';
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
           while ($row = $result->fetch_assoc()) {
                //carico tutte le info su un array e le sfrutto da qua
              return $row['numero_like'];
            }
        } else {
            return  "0 results";
        }    	
    	
    }
    
function countFriends()
{

    	global $conn;
        $sql = 'SELECT COUNT(DISTINCT(P.id_account_ricevitore)) as numero_amici FROM Progetti_Condivisi P WHERE P.id_account_condivisore = '.$_SESSION['id_account'].';';
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
           while ($row = $result->fetch_assoc()) {
                //carico tutte le info su un array e le sfrutto da qua
              return $row['numero_amici'];
            }
        } else {
            return  "0 results";
        }    





}
function retrieveFriends()
{

global $conn;
$sql = 'SELECT DISTINCT(P.id_account_ricevitore) FROM Progetti_Condivisi P WHERE P.id_account_condivisore = '.$_SESSION['id_account'].';';
$result = $conn->query($sql);
       if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
            	$final .= '<div class = "Lateral" style="width: 30vw; background-color: #262626;margin-top: 4vh; border-radius: 60px;  display: flex; gap:2vw; align-items: center; ">
             
            	<div ><img style="border-radius: 60px; widht: 120px; height: 120px;" id="ProfileImageBig" src="'.getAccountInfos($row['id_account_ricevitore'],"foto_profilo").'" alt="FotoProfilo"></div>
            	<div style="display: flex; flex-direction: column; gap:1vh; margin-top: 2vh;">
                    <div style="text-align: left; font-size: 25pt; color:white;" id="Username">'.getAccountInfos($row['id_account_ricevitore'],"username_utente").'</div>
            		<div style="text-align: left; font-size: 18pt; color:rgb(133, 133, 133);" id="NomeCognome">'.getAccountInfos($row['id_account_ricevitore'],"nome_utente")." ".getAccountInfos($row['id_account_ricevitore'], "cognome_utente").'</div>            
            </div></div><br>
            ';
            }
        } 
        else{
          $final = '<br><br><div style="font-family: Nordique; font-size: 20pt;">     Empty...</div>';
        }
	
    return $final;
}









function percentualeCompletamento($progetto){
	global $conn;
       $sql = "SELECT COUNT(T.id_Task) AS totaleTask FROM Progetto P, Task T WHERE P.id_Progetto =" .$progetto." and T.id_progetto = P.id_Progetto";
		$result_tot = $conn->query($sql); //prima interrogazione, prendo tutte le task
        
        $sql2 = "SELECT COUNT(T.id_Task) AS taskComplete FROM Progetto P, Task T WHERE P.id_Progetto = ".$progetto." AND T.id_progetto = P.id_Progetto AND T.stato='done'";
        $result_done = $conn->query($sql2); //seconda interrogazione, prendo solo le task completate
        
        if ($result_tot->num_rows > 0 and $result_done->num_rows > 0){
            // output data of each row
            while ($row_tot = $result_tot->fetch_assoc()) {
 				while ($row_done = $result_done->fetch_assoc()){
                	if($row_tot["totaleTask"] == 0){
                    	return "no task"; //cambia l'output
                    }
                    else{
                    	$a = $row_done['taskComplete']/$row_tot["totaleTask"]*100;
                		return round($a)."%"; //returno la percentuale
                    }
                }
            }
    	}
    }
    
    
    
    
    
    




//create the object to use 
/*

retrieveProjects($_SESSION['ordine_progetti']);  //inizializzo le proprietà
retrieveAccountData(); //inizializzo le proprietà
retrieveSharedProjects();
retrievePrivateProject();
*/
if(!isset($_SESSION['ordine_progetti'] )){
        	$_SESSION['ordine_progetti'] = 'data_ultima_modifica DESC';
            
        }
if(!isset($_SESSION['ordine_progetti_condivisi'] )){
        	$_SESSION['ordine_progetti_condivisi'] = 'data_ultima_modifica DESC';
        }
if(!isset($_SESSION['ordine_progetti_privati'] )){
        	$_SESSION['ordine_progetti_privati'] = 'data_ultima_modifica DESC';
        }
if(!isset($_SESSION['ordine_progetti_finiti'] )){
        	$_SESSION['ordine_progetti_finiti'] = 'data_ultima_modifica DESC';
        }




if(isset($_POST['riordina']) and isset($_POST['criterio'])){
	if($_POST['riordina'] == 'all'){ //tutti i progetti
    		$_SESSION['ordine_progetti'] = $_POST['criterio'];
            echo getProjects();
    }
    else if($_POST['riordina'] == 'sher'){ //progetti condivisi
    	$_SESSION['ordine_progetti_condivisi'] = $_POST['criterio'];
        echo getSharedProjects();
        
    }
    else if($_POST['riordina'] == 'priv') { //progetti locali
    	$_SESSION['ordine_progetti_privati'] = $_POST['criterio'];
        echo getPrivateProjects();
        
    } else {
    	$_SESSION['ordine_progetti_finiti'] = $_POST['criterio'];
        echo getFinishedProjects();
    }
    
    
	
    



}
if(isset($_POST['lateral_status'])){

	$_SESSION['current_lateral_status'] = $_POST['lateral_status'];

}

if(isset($_POST['toSearch']) and $_POST['toSearch'] != '&&&&&&&')
{
	searchProject($_POST['toSearch']);
    unset($_POST['toSearch']);
}
if(isset($_POST['mostra_piaciuti'])){
	
    echo postPiaciuti();

}
if(isset($_POST['mostra_amici']))
{
	echo retrieveFriends();

}
if(isset($_POST['mostra_post']))
{
	echo searchPostByAccountId($_SESSION['id_account']);
}

?>
