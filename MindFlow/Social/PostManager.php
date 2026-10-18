<?php

session_start();
include '../connect.php';

$path = "../ImageUploader/imageForPostUploader.php";
include($path);
$post_infos = array();


$errorDuringImageLoading = '';


function InfoForDescription($id)
{
        global $conn, $post_infos;
    	$sql = "SELECT * FROM Post WHERE id_Post = ".$id;
        $result = $conn->query($sql);
       if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $post_infos = $row;
            }
        }  else {
        	$post_infos = 'problema durante la creazione del post';
        }

}


function createPost()
{
		//$_SESSION['id_progetto'] = 16;
        global $conn;
        global $errorDuringImageLoading;
		//inizializzo durata
        $sql = 'SELECT * FROM Progetto P WHERE P.id_Progetto = '.$_SESSION['id_progetto'];
        $result = $conn->query($sql);
		if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
            	//echo strtotime($row['data_ultima_modifica'])."<br>";
               // echo $row['data_ultima_modifica']."<br>";

                $date1=getDate(strtotime($row['data_ultima_modifica']));
				$date2=getDate(strtotime($row['data_creazione']));
                
                $a = abs($date1['yday']-$date2['yday']); //vediamo come fare il display, intanto salvo in giorni
                $durata = $a." days";
                
                
                

            }
        }  else {
        	$errorDuringImageLoading = 'Error: an error occured during your post creation';
        }
        
        
        $sql = 'SELECT COUNT(*) as numero_task FROM Task T WHERE T.id_progetto = '.$_SESSION['id_progetto'];
        $result = $conn->query($sql);
		if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $numero_task = $row['numero_task'];
            }
        }  else {
        	$errorDuringImageLoading = 'An error';
        }

        
        
        
        $id_post = $_SESSION['id_progetto'];
       // $durata = 0;
      //  $descrizione = "a";
        $immagine = "a";
      //  $numero_like = 0;
        $id_possessore = $_SESSION['id_account'];
		$titolo = $_POST['titolo'];
		
		$descrizione = $_POST['descrizione'];
		
		//inserisco
  
        
        
		$sql = 'INSERT INTO Post(id_Post, titolo, durata, immagine, descrizione, numero_task, id_account) VALUES 
        (
        "'.$id_post.'",
        "'.$titolo.'",
        "'.$durata.'",
        "'.$immagine.'",
        "'.$descrizione.'",
        "'.$numero_task.'",
        "'.$id_possessore.'")';

        
          if ($conn->query($sql) === true) {
            	unset($_POST['descrizione']);
            	$errorDuringImageLoading = uploadImage('../ImageUploader/postImages/');
            	if($errorDuringImageLoading == 'allgood'){
            		echo '<script>window.location.replace("https://mindflow.altervista.org/Social/indexSocial.php")</script>';
            }
            
          } else {
             $errorDuringImageLoading = "Your already posted your project";
          }




}

function showSingle($id)
{
$final = '';
        global $conn;
        
    	$sql = "SELECT * FROM Post WHERE id_Post = ".$id;
        $result = $conn->query($sql);
       if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                 $final = 
                            "<img onclick='Descrizione(".$row["id_Post"].")' style='width:19vw; height: 27vh; margin: 0 auto; border-radius: 20px;' src=". $row["immagine"] .">".
                              "<div style='margin-top:1.3vh; display: flex; flex-direction: column;'> ".
                                "<div style='margin: 0 auto; margin-top: 0.5vh; font-family: OstrichSans-Heavy; font-size: 20pt; margin-bottom: -0.4vh;'> " . $row["titolo"] . "</div>".
                                "<div style='margin: 0 auto; display:flex; gap: 5vw; font-size: 15pt;'>".
                                  "<div>" . $row["durata"] ."</div>".
                                  "<div style='display: flex; gap: 0.7vw;'>".
                                    "<div>" . getNumberOfLikes($row["id_Post"]) ."</div>".
                                    "<div><img id='like".$row["id_Post"]."' src='".controllaLike($row["id_Post"])."' style='height: 20px;' onclick = 'mettiLike(" . $row["id_Post"] . ")'></div>".
                                  "</div>".
                                "</div>".
                              "</div>";
               	
			}
            
        } 
        else{
          $final = '<br><br><div style="font-family: Nordique; font-size: 20pt;">     Empty...</div>';
        }
        return $final;





}

function showAllPost() //mostra tutti i post
{
		$final;
        global $conn;
        $I = 0;
    	$sql = "SELECT p.id_Post, p.durata, p.titolo, p.immagine, p.descrizione, p.id_account, COUNT(l.id_post) AS like_count
                FROM Post p
                LEFT JOIN Cuori l ON p.id_Post = l.id_post
                GROUP BY p.id_Post, p.numero_task
                ORDER BY like_count DESC;";
        $result = $conn->query($sql);
       if ($result->num_rows > 0) {
            // output data of each row
            $final = '<table><tr>';
            while ($row = $result->fetch_assoc()) {
                if($I == 4){
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
                                 	"<div style='display: flex; gap: 0.7vw;'>".
                                    "<div>" . getNumberOfLikes($row["id_Post"]) ."</div>".
                                    "<div><img id='like".$row["id_Post"]."' src='".controllaLike($row["id_Post"])."' style='height: 20px;' onclick = 'mettiLike(" . $row["id_Post"] . ")'></div>".
                                  "</div>".
                                "</div>".
                              "</div>".
                            "</div>";
               	
			}
            $final .= '</tr></table>';
            
        } 
        else{
          $final = '<br><br><div style="font-family: Nordique; font-size: 20pt;">     Empty...</div><br><br>';
        }
        return $final;
        
}
function searchPostByAccountId($id) //cerca i post
{
		$final;
        global $conn;
    	$sql = 'SELECT * FROM Post P WHERE P.id_account ='.$id.';';
        $result = $conn->query($sql);
       if ($result->num_rows > 0) {
       $final = '<table>';
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                if($I == 3){
                    $final .= '</tr><tr>';
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
                                 	"<div style='display: flex; gap: 0.7vw;'>".
                                    "<div>" . getNumberOfLikes($row["id_Post"]) ."</div>".
                                    "<div><img id='like".$row["id_Post"]."' src='".controllaLike($row["id_Post"])."' style='height: 20px;' onclick = 'mettiLike(" . $row["id_Post"] . ")'></div>".
                                  "</div>".
                                "</div>".
                              "</div>".
                            "</div>";
               	
			}
            $final .= '</table>';
        } 
        else{
          $final = '<br><br><div style="font-family: Nordique; font-size: 20pt;">     Empty...</div><br><br>';
        }
        return $final;
        
}




function searchPost($keyword) //cerca i post
{
		$final;
        global $conn;
    	$sql = 'SELECT * FROM Post P, KeyWords K WHERE K.id_progetto = P.id_Post AND K.parola = "'.$keyword.'";';
        $result = $conn->query($sql);
       if ($result->num_rows > 0) {
       $final = '<table>';
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                if($I == 4){
                    $final .= '</tr><tr>';
                    $I = 0;
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
                                 	"<div style='display: flex; gap: 0.7vw;'>".
                                    "<div>" . getNumberOfLikes($row["id_Post"]) ."</div>".
                                    "<div><img id='like".$row["id_Post"]."' src='".controllaLike($row["id_Post"])."' style='height: 20px;' onclick = 'mettiLike(" . $row["id_Post"] . ")'></div>".
                                  "</div>".
                                "</div>".
                              "</div>".
                            "</div>";
			}
            $final .= '</table>';
        } 
        else{
          $final = '<br><br><div style="font-family: Nordique; font-size: 20pt;">     Empty...</div><br><br>';
        }
        return $final;
        
}

function likePost($id_post){ //aggiunge il like
		$final;
        global $conn;
		$sql = "INSERT INTO Cuori(id_account_liker, id_post) VALUES ('".$_SESSION['id_account']."','".$id_post."')";
        //$result = $conn->query($sql);
       	if ($conn->query($sql) === true) {
			echo   "../../IMAGES/liked.png";
        } 
        else{
          echo  'no_message';
        }

}
function getNumberOfLikes($id_post) //ti dice quanti like ha un post
{
		$final;
        global $conn;
    	$sql = "SELECT COUNT(*) as numero_like FROM Post P, Cuori C WHERE P.id_Post = ".$id_post." AND C.id_post = P.id_Post";
        $result = $conn->query($sql);
       	if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            	$final = $row["numero_like"];
            }
        } 
        else{
          $final = 'no_message';
        }
        
        return $final;
}

function controllaLike($id)
{
$final;
        global $conn;
    	$sql = "SELECT * FROM Post P, Cuori C WHERE C.id_post =".$id." AND C.id_account_liker = ".$_SESSION['id_account'];
        $result = $conn->query($sql);
       	if ($result->num_rows > 0) {
        	return "../../IMAGES/liked.png";
        } 
        else{
          return "../../IMAGES/like.png";
        }
        
        return $final;
}

function Togli_like($id)
{
		$final;
        global $conn;
		$sql = "DELETE FROM Cuori WHERE id_post = '".$id."' AND id_account_liker = ".$_SESSION['id_account'];
        //$result = $conn->query($sql);
       	if ($conn->query($sql) === true) {
			echo controllaLike($id);
        } 
        else{
          echo  'no_message';
        }


}







if($_POST['operazione'] == 'togli_like')
{
	 Togli_like($_POST['id']);

    
}


if($_POST['operazione'] == 'like')
{
	likePost($_POST['id']);

    
}
else if($_POST['operazione'] == 'mostraTutto')
{
echo showAllPost();
}
else if($_POST['operazione'] == 'mostraSingolo')
{

 echo showSingle($_POST['id']);
}
else if($_POST['operazione'] == 'getPostInfo')
{
	InfoForDescription($_POST['id']);
    $post_infos['numero_like'] =getNumberOfLikes($_POST['id']);
	echo json_encode($post_infos);
}
/*else if($_POST['operazione'] == 'getNumberOf')
{
	InfoForDescription($_POST['id']);
	echo json_encode($post_infos);
}*/













?>
