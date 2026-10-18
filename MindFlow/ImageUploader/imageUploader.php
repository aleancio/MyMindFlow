<?php
session_start();
?>

<?php
include "../connect.php";
$result = 'init';
if(isset($_POST['uploadImage_fromSignUp']))
{
	uploadImage('profileImages/');
    unset($_POST['uploadImage_fromSignUp']);
}

function uploadImage($directory){
  global $result;




	$target_dir = $directory;
    	


//conto quanti file ho e aggiungo uno, poi pongo un id davanti al nome della foto, in modo di caricarla più volte, distinguendola
  $filecount = 0;
  $file_counter = glob($target_dir.'*');
  $filecount = 0;
  if( $file_counter ) {
      $filecount = count($file_counter);
  }
  $filecount += 1;

//comicio il caricamento del file
	$target_file = $target_dir .$filecount."_". basename($_FILES["fileToUpload"]["name"]);
	$filename = $filecount."_". basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      //echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      $result = "File is not an image.";
      $uploadOk = 0;
    }
  }

  // Check if file already exists
 /* if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
*/
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 40000000) {
    $result = "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    $result = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    
  }

  
  
  // Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //$result .= "<br>Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
  //  echo $_FILES["fileToUpload"]["name"];
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      if($directory == '../../ImageUploader/profileImages/'){
    		removeOldFile();
    	}	

      updateDB($filename);
    } else {
      $result = "problema";
    }
  }
  if($_FILES["fileToUpload"]["tmp_name"] != '')
  {return $result;}


} 

function updateDB($file_path){
	global $conn;
  global $result;
	//$sql = "INSERT INTO Account(foto_profilo) VALUES 'https://partener4i.altervista.org/WorkSpaceee/ImageUploader/".$file_path."' WHERE id_Account = ". $_SESSION['id_account'];
   // echo "<br>aa: ".$_SESSION['id_account'];
    if($result != 'problema'){
      $sql = "UPDATE Account SET foto_profilo='https://mindflow.altervista.org/ImageUploader/profileImages/".$file_path."' WHERE id_Account = ". $_SESSION['id_account'];
      }
      if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.replace('https://mindflow.altervista.org/Locale/IndexProfileScreen/IndexProfile.php')</script>";
      } else {
		$result = "Error : something went wrong during the loading of the image on database";
      /*  echo "Error : something went wrong during the loading of the image on database";
        echo var_dump($_SESSION);*/
        
      }
      
    
}

function removeOldFile(){
	$filePath = getImageUrl();
    $filePath = str_replace('https://mindflow.altervista.org','../../',$filePath); //taglio il nome della stringa
    //echo $filePath."<br>";
    unlink($filePath);
   // echo $filePath."  is been substituted <br>";
    
}

function getImageUrl(){
	global $conn;
	
	//$sql = "INSERT INTO Account(foto_profilo) VALUES 'https://partener4i.altervista.org/WorkSpaceee/ImageUploader/".$file_path."' WHERE id_Account = ". $_SESSION['id_account'];
    $sql = "SELECT foto_profilo FROM Account WHERE id_Account = ". $_SESSION['id_account'];
	$result = $conn->query($sql);
    $filePath = 1;
    //echo "result: ".$result."<br>";
	while ($row = $result->fetch_assoc()){
    	$filePath = $row['foto_profilo'];
    }
    return $filePath;
}







/*
if($result != 'problema' and $result != 'init'){
        echo '<br><div class="success-badge">Operation Successful!</div>
        <form action="https://partener4i.altervista.org/WorkSpaceee/Locale/IndexProfileScreen/IndexProfile.php" method="post">
        <input type="submit" value="Go to Next Page">
        </form>';


}
else
{
if($result != 'init'){
        echo '<br><div class="failure-badge">Operation not Successful!</div>
        <form action="https://partener4i.altervista.org/WorkSpaceee/SchermataIniziale/immagineProfilo.html" method="post">
        <input type="submit" value="back">
        </form>';
        }

}
*/
  
  
  
  
  
  

?>
