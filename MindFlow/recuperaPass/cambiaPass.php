<?php
session_start();
include '../connect.php';
 include_once('../Locale/Cifrario.php');
$errMsg;
if($_POST['password'] == $_POST['confirm_password'] and isset($_POST['action']))
{

 global $conn;
 $pass = $cifra->cifratura($_POST['password']);
 
 
 $sql = 'UPDATE Account SET password ="'.$pass.'" WHERE email = "'.$_SESSION['email'].'";';
 
 if($conn->query($sql) === true)
 {
 	$errMsg = 'Your password has been updated : <a href = "https://mindflow.altervista.org/SchermataIniziale/LoginPage.html">Login</a>';
 }
 else{
 	$errMsg = $sql;
 }




}
else if(isset($_POST['action'])){
	$errMsg = 'Error: passwords do not match';
}
else{
	$errMsg = '';
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Form</title>
    <style>
<?php include 'styleForRecupero.php';?>

</style>
<style>

/* style.css */



#top { 
	color: green; 
} 

.group { 
display:flex;
justify-content:center;
	width: auto; 
	text-align: center; 
    margin-top:-2vh;
    margin-bottom : 3vh;
} 

.group label { 
	display: block; 
	padding: 20px 0; 
} 

.group input { 
	border: none; 
	outline: none; 
	padding: 20px; 
	width: calc(100% - 40px); 
	border-radius: 10px; 
	background-color: #eaeff2; 
	color: #3ba62f; 
	font-size: 20px; 
} 





.group .power-container { 


	background-color: #2E424D; 
    
	width: 80%; 
	height: 2vh; 
	border-radius: 5px; 
} 

.group .power-container #power-point { 
	background-color: #D73F40; 
	width: 1%; 
	height: 100%; 
	border-radius: 5px; 
	transition: 0.5s; 
}
#pass_label{
	font-size : 2.5vh;
    color:white;
    text-align:center;
    font-family: OstrichSans-Heavy;

}


</style>
<script>
// script.js 
window.onload = function(){
let password = document.getElementById("password"); 
let power = document.getElementById("power-point"); 
password.oninput = function () { 
	let point = 0; 
	let value = password.value; 
	let widthPower = 
		["1%", "25%", "50%", "75%", "100%"]; 
	let colorPower = 
		["#D73F40", "#DC6551", "#F2B84F", "#BDE952", "#3ba62f"]; 

	if (value.length >= 6) { 
		let arrayTest = 
			[/[0-9]/, /[a-z]/, /[A-Z]/, /[^0-9a-zA-Z]/]; 
		arrayTest.forEach((item) => { 
			if (item.test(value)) { 
				point += 1; 
			} 
		}); 
	} 
	power.style.width = widthPower[point]; 
	power.style.backgroundColor = colorPower[point]; 
};
}


</script>

</head>
<body>


	<div id="sfondo">
    <div class="login-box" >
    	<div class = 'title'><div>MINDFLOW </div>
        <div class = 'subtitle'>LOGIN</div>
        </div>
 <form action="cambiaPass.php" method="post">
 <input type = 'hidden' name = 'action' value = 'aggiorna'>
    <div class="user-box">
    	<input type="password" id="password" name="password" style="margin-top: 4px; font-family: Nordique; font-size:1.5vw;" required>
    	<label for="password">Password:</label>
    </div>
    <div class="user-box"> 
    	<input type="password" id="confirm_password" name="confirm_password" style="margin-top: 4px; font-family: Nordique; font-size:1.5vw;" required>
    	<label for="confirm_password">Confirm Password:</label>
    </div>
    
    <div class = 'group'>
        <div class="power-container"> 
            <div id="power-point"></div> 
        </div> 
    
    </div>
    
    
    <div class = "sub-button-container">
    	<input class="sub-button" type="submit" value="Submit">
    </div>
    
            <div class="words-button" id= "sentenceBelow">
            	<div id = 'errorBox'><?php echo $errMsg;?></div>
            </div>    
    
    
    
    
    
        
      
	</form>       

</div>



















</body>
</html>


