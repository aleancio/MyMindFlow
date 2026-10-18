<?php
session_start();


include 'retrieveProjects.php';

include '../connect.php';


if($_POST['a'] == "cambio"){
	if(getAccountInfos('stato_account') == "online"){
        $stato = "offline";
    }
    else
    {
        $stato = 'online';
    }
  $sql = "UPDATE Account SET stato_account = '".$stato."' WHERE id_Account = ".$_SESSION['id_account'];
  if ($conn->query($sql) === true) {
          // Redirect to a success page or display a success message
         $result = "query done"; 
      } else {
          // Display an error message
         // echo "Error: " . $sql . "<br>" . $conn->error;
      }
   $_POST['a'] = "cambiato";
}

echo $stato;

?>
