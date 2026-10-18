<?php
function confirmedDel(){
echo '
<link rel="stylesheet" href="../../IMAGES/Fonts.css">
<div class = "popUP" style=" font-family: OstrichSans-Heavy; width: 20vw;"><h1> delete successfuly</h1>
<form id="confirmationForm" action="indexProject.php" method="post">
    <input type="submit" name="action" value="confirm" style="margin-top: 2vh; margin-bottom: 2vh; margin-right:1vh; height: 6vh; width: 7vw; background-color: #5A7FD7; font-family: OstrichSans-Heavy; font-size: 20pt; padding: 1vh; border: none; border-radius: 20pt; color: white; ">
</form>
</div>';


unset($_SESSION['task_to_delete']);

}



?>
