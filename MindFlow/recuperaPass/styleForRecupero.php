<?php



echo 
"
@font-face {
font-family: Nordique;
src: url('../IMAGES/Nordique.otf');
}
.stereonic-font {
font-family: Nordique, sans-serif;
/* Aggiungi altri attributi di stile qui se necessario */
}
@font-face {
font-family: Metropolis1920-Regular;
src: url('../IMAGES/Metropolis1920-Regular.otf');
}
.stereonic-font {
font-family: Metropolis1920-Regular, sans-serif;
/* Aggiungi altri attributi di stile qui se necessario */
}
@font-face {
font-family: OstrichSans-Heavy;
src: url('../IMAGES/OstrichSans-Heavy.otf');
}
.stereonic-font {
font-family: OstrichSans-Heavy, sans-serif;
/* Aggiungi altri attributi di stile qui se necessario */
}

html {
    height: 100%;
    }
    body {
    /*margin:0;
    padding:0;
    font-family: sans-serif;
    //background: linear-gradient(#141e30, #243b55);
	background : #a6a6a6;*/
    
   	  height: 100%;
      margin:0;
      background-image: url('../IMAGES/sfondo.jpg');
      /*background-position: center center; /* Center the image */
      width: 100%;
      padding:0;
      /*background-repeat: no-repeat; /* Do not repeat the image */
      background-size: 100%; /* Resize the background image to cover the entire container */
      margin-top: 0;
      display:flex;
      align-items: center;

    }

    .login-box {
    
    position: absolute;
    top: 50%;
    left: 50%;
    width: 50vw;
    padding: 5vw;
    transform: translate(-50%, -50%);
    background: #262626;
    box-sizing: border-box;
    box-shadow: 0 15px 25px rgba(0,0,0,.6);
    border-radius: 5vh;
	
    }

    .login-box h2 {
    margin: 0 0 30px;
    padding: 0;
    color: #fff;
    text-align: center;
    }

    .login-box .user-box {
    position: relative;
    }

    .login-box .user-box input {
    width: 100%;
    padding: 10px 0;
    font-size: 1.5vw;
    color: #fff;
    margin-bottom: 30px;
    border: none;
    border-bottom: 1px solid #fff;
    outline: none;
    background: transparent;

    }
    .login-box .user-box label {
    position: absolute;
    top:0;
    left: 0;
    padding: 10px 0;
    font-size: 1.5vw;
    color: #fff;
    pointer-events: none;
    transition: .5s;
        font-family: OstrichSans-Heavy;
    }

    .user-box input:focus ~ label,
    .user-box input:valid ~ label {
    top: -20px;
    left: 0;
    color: #d9d9d9;
    font-size: 1vw;
    font-family: OstrichSans-Heavy;
    }
    .sub-button{
        display: block;
        width: 11vw;
        height: 3vw;
      	background-color: #5A7FD7;
        border-radius: 20px;
        border: none/*solid #fff 2px*/;
        color: #fff;
        font-size: 1.5vw;
        margin-bottom: 1vw;
        margin-top: 1vw;
        font-family: OstrichSans-Heavy;

    }
    .sub-button:hover{
    cursor: pointer;
        background-color: blue;
        color: white/*#141e30*/;
        transition: 0.5s;
        font-size: 1.3vw;

    }

    .res-button{
        position: absolute;
        display: block;
        left: 50%;
        width: 30%;
        height: 10%;
        background-color: #141e30;
        border-radius: 20px;
        border: solid #fff 2px;
        color: #fff;
    }
    .res-button:hover{
        background-color: #fff;
        color: #141e30;
        transition: 0.5s;

    }
    .words-button{
        display: flex;
        justify-content: center;
        align-items: center;
        font-size:1.5vw;
        color: #fff;
        font-family: OstrichSans-Heavy;
    }

    .sub-button-container{
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
        


    }
.title {

    margin-bottom: 4vh;
    display: flex;
    flex-direction: column;

    align-items: center;
    font-size: 10vh;
    color: white;
    font-family:  Metropolis1920-Regular;
    margin-top:-2vh;
}

.subtitle
{
    font-size: 6vh;
        margin-top: 2.5vh;
            font-family:  OstrichSans-Heavy;

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
"




?>
