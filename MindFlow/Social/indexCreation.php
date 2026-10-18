<?php
include_once('PostManager.php');
if(isset($_POST['descrizione']))
{
	createPost();
}





?>
<!DOCTYPE html>
<html>
    <head>
        <title>Post your Project</title>
        <link rel="stylesheet" href="../../IMAGES/Fonts.css">
        <style>
       


    body {
		background : #a6a6a6;
        height: 100vh;
        width: 100vw;
        padding:0;
        margin: 0;
        display:flex;
        align-items: center;
    }
    .login-box {
    	min-width: 35vw;
        max-height: 70vh;
    	display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0 auto; 
        padding: 3vw;       
        background: #262626;
        box-shadow: 0 15px 25px rgba(0,0,0,.6);
        border-radius: 20pt;
    }
    .title {
        margin-bottom: 3vh;
        display: flex;
        width: 100%;
        flex-direction: column;
        align-items: center;
        font-size: 8vh;
        color: white;
        font-family:  Metropolis;
    }
    .user-box{
    	width: 95%;
    }

    .subtitle
    {
      font-size: 4vh;
      margin-top: 2.5vh;
      color: white;
      font-family:  OstrichSans-Heavy;
      text-align:left;

    }
    
    .sub-button{
        margin-top: 2vh;       
        height: 7vh;
        width: 10vw;
        background-color: #5A7FD7;
        font-family: OstrichSans-Heavy;
        font-size: 20pt;
        padding: 1vh;
        border: none;
        border-radius: 20pt;
        color: white;
    }
    .sub-button:hover{
    	cursor:pointer;
        background-color: black;
        transition: 0.5s;
    }
     /*.login-box .user-box {
    position: relative;
    }*/

    .user-box input {
        	display: flex;
            flex-direction: column;     
			width: 97%;
            
            border-radius: 10px;
            height: 4vh;
            font-family: Nordique;
            font-size: 15pt;
            padding: 0.5vh;

    }
    .user-box label {
        padding: 10px 0;
        font-size: 1.5vw;
        color: #fff;
        pointer-events: none;
        font-family: OstrichSans-Heavy;
    }
    #errorBox{
    	color : white;
        font-size :1.5vw;
        font-family: OstrichSans-Heavy;
        margin-top : 1.5vh;
    }

    .custom-file-upload {
        margin: 0 auto;
        display: flex;
        align-items: center;
        font-family: OstrichSans-Heavy;
        padding-left: 1vw;
        
        color:white;
        border: 1px solid #ccc;
        font-size: 3vh;
        cursor: pointer;
        width: 95%;
        height:6vh;
        border-radius:20px;
	}

.cancel{
	font-family: Nordique;
    font-size: 13pt;
}

</style>
    </head>

    
    <body>
      <form action = 'indexCreation.php' method = 'POST' enctype="multipart/form-data" class="login-box">   
        <div class="title"> PUBLISH PROJECT</div>

        <div class="user-box">
        <div class="subtitle">Enter Title : </div>
        <input type = 'text' name = 'titolo'>
        </div>
        
        <div class="user-box">
        <div class="subtitle">Enter Description : </div>
        <input type = 'text' name = 'descrizione'>
        </div>
        <br>
        <div class="custom-file-upload" >      
        Select File: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type="file"  name="fileToUpload" class=" cancel" id="fileToUpload" >
        </div>
        <br>

        <div id="b">

        <input type = 'button' value = 'back' class="sub-button" onclick = 'window.location.replace("../Locale/ProjectsScreens/indexProject.php")'>
        <input type = 'submit' value = 'Post ' class="sub-button">
        </div>
        <div id = 'errorBox'><?php echo $errorDuringImageLoading; ?></div>

        </form>
    </body>
</html>
