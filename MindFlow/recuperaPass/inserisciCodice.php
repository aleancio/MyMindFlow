<?php
session_start();
$errMsg;
	if(isset($_POST['cod']))
    {
    	if($_SESSION['codice'] == $_POST['cod'])
        {
        	 echo '<script>window.location.replace("cambiaPass.php")</script>';
        	
        }
        else
        {
        	$errMsg = 'codice non corretto, riprova';
        }
    	
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Form</title>
    
    
<style>
<?php include 'styleForRecupero.php';?>

</style>
</head>
<body>

	<div id="sfondo">
    <div class="login-box" >
    	<div class = 'title'><div>MINDFLOW </div>
        <div class = 'subtitle'>LOGIN</div>
        </div>
        
           <form action="inserisciCodice.php" method="post">
                <div class="user-box" >
                  <input style="margin-top: 4px; font-family: Nordique; font-size:1.5vw;" type="number" id="cod" name="cod" required>
                  <label for="cod">Insert the code given by email:</label>
                </div>
                <div class = "sub-button-container" >
                <input class="sub-button" type="submit" value="Submit">
                </div>
			</form>
        
            <div class="words-button" id= "sentenceBelow">
            	<div id = 'errorBox'><?php echo $errMsg;?></div>
            </div>
    </div>



</body>
</html>
