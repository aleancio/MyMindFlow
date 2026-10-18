<?php

function showCondividiPopUp(){
echo  '
	<link rel="stylesheet" href="../../IMAGES/Fonts.css">
    <style>
    
        /* Add your custom styles here */
        /* You can customize the appearance of the popup */
        .popUP {
        	color: white;
            width:20vw;
            
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 5vh;
            background-color: #262626;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 4;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Style for the form inputs */
        .name{
        font-size: 6vh;
        
        color: white;
        text-align:center;
        }
        .form-group{
        font-size: 4vh;
        color: white;
        text-align:center;
        font-family: OstrichSans-Heavy, sans-serif;
        }
        .bottoniss{
        	margin-top: 2vh;
        }
        .bottoniss input{
            
            height: 7vh;
            width: 5vw;
            background-color: #5A7FD7;
            font-family: OstrichSans-Heavy;
            font-size: 20pt;
            padding: 1vh;
            border: none;
            border-radius: 20pt;
            color: white;
        
        }
        .bottoniss input:hover{
        	cursor: pointer;
            background-color: black;
            transition: 0.5s;
        }
        
    </style>



<!-- The popup content -->
<div id="condivisionePopup" class="popUP">
    <div class="name">Share Project</div>
    <br>
    <!-- Form for inputting data into the Condivisione table -->
    <form id="condivisioneForm" action = "indexProject.php" method = "post">
        <div class="form-group">
            <label for="ricevitore">USERNAME recipient:</label>
            <input type="text" class="form-control" style=" font-family: Nordique; min-width: 80%;" id="ricevitore" name="username_account_ricevitore" required>
        </div>
        <div class="bottoniss">
        <!-- Submit button to add data to the Condivisione table -->
        <input type = "button" class="btn btn-secondary" value = "Exit" onclick = "window.location.reload()">
        	<input type="submit" class="okaybutton" value = "Share">  
        	
            
		</div>
    
    </form>



    <!-- Close button for the popup -->


</div>

';


}
if(isset($_POST['mostra_nuovo']))
{
showCondividiPopUp();

}




?>
