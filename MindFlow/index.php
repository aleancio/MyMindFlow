<?php

session_start();
unset($_SESSION['id_account']);
include 'styleSheet.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mindflow</title>
    <link rel="stylesheet" href="IMAGES/Fonts.css">
    <style>
    body{
    	height: 100%;
        margin:0;
    	background-image: url("IMAGES/sfondo.jpg");
        /*background-position: center center; /* Center the image */
        width: 100%;
        padding:0;
        /*background-repeat: no-repeat; /* Do not repeat the image */
        background-size: 100%; /* Resize the background image to cover the entire container */
        margin-top: 0;
        display:flex;
        align-items: center;
    }
    * {
  		box-sizing: border-box;
	}
    #sfondo{
    	width: 100%;
        height: 100vh;
        background-color: rgba(83, 83, 83, 0.46);
        margin:0;
        padding:0;
        display:flex;
        align-items: center;
    }
	h1{
    	font-family: Metropolis;
        color: white;
        margin: 0;
        text-align: center;
        font-family: Metropolis;
        font-size: 17vh;
    }
    #content{
    	padding: 7vh;
    	margin: 0 auto;
        display: flex;
        flex-direction: column;
        width: 45vw;
        height: 70vh;
        border: none;
        background-color: #262626;
        border-radius:6vh;
        align-items: center;
        justify-content: space-around;
        border: solid;
        border-color: rgb(84, 84, 84);
        border-width: 1px;
        box-shadow: 25px 45px 45px rgba(0,0,0,.9);
    }
    button{
    	width: 40%;
        height: 8vh;
        background-color:#5A7FD7;
        border: none;
        border-radius: 4vh;
        margin: 0 auto;
        color: white;
        padding: 1.5vh;
        font-family: OstrichSans-Heavy;
        font-size: 20pt;
    }
    p{
    	font-size: 20pt;
        font-family: OstrichSans-Heavy;
        color: white;
        text-align: center;
    }
    button:hover{
    	cursor: pointer;
        background-color:black;
        font-size:17pt;
         transition: 0.5s;
    }
    </style>
    
    
    <script>
    function Login(){
      	window.location.href ="SchermataIniziale/LoginPage.html";
      }  
      function Register(){
      	window.location.href ="SchermataIniziale/SignUpPage.html";
      }  
      
    </script>
</head>
<body >
<div id="sfondo">
	
	<div id="content">
		<h1>MINDFLOW</h1>
        
        <p>The perfect website for project organisation</p>
        <button onclick="Login()" >Sign in</button>
        <button onclick="Register()">Create an account</button>      
        
	</div>  
</div>    
</body>
</html>
<!--https://s615.altervista.org/lf.pl?sid=c31df202f66d3888fc3cdb03195ecb25-->