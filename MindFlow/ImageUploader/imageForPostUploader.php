<?php
session_start();


include '../connect.php';
$result = 'innit';

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
  if ($_FILES["fileToUpload"]["size"] > 500000) {
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

    $result .= "<br>Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
  //  echo $_FILES["fileToUpload"]["name"];
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
     /* if($directory == '../../ImageUploader/postImages/'){
    		removeOldFile();
    	}	*/
      updateDB($filename);
    } else {
      $result = "problema";
    }
}
return $result;


} 

function updateDB($file_path){
	global $conn;
  	global $result;
	//$sql = "INSERT INTO Post('immagine') VALUES 'https://partener4i.altervista.org/WorkSpaceee/ImageUploader/postImages/".$file_path."' WHERE id_Post = ". $_SESSION['id_progetto'];
  //  echo " aa: ".$_SESSION['id_progetto'];
    
    if($result != 'problema'){
      $sql = "UPDATE Post SET immagine ='https://mindflow.altervista.org/ImageUploader/postImages/".$file_path."' WHERE id_Post = ". $_SESSION['id_progetto'];
      }
      if ($conn->query($sql) === TRUE) {
          $result = 'allgood';
      } else {
		//$result = "Error: ".$sql." ".$conn->error();
      }
    
}

function removeOldFile(){
	$filePath = getImageUrl();
    $filePath = str_replace('https://mindflow.altervista.org/','../../',$filePath); //taglio il nome della stringa
    echo $filePath."<br>";
    unlink($filePath);
    echo $filePath."  is been substituted <br>";
    
}

function getImageUrl(){
	global $conn;
	//$sql = "INSERT INTO Account(foto_profilo) VALUES 'https://partener4i.altervista.org/WorkSpaceee/ImageUploader/".$file_path."' WHERE id_Account = ". $_SESSION['id_account'];
    $sql = "SELECT immagine FROM Post WHERE id_Post = ". $_SESSION['id_progetto'];
	$result = $conn->query($sql);
    $filePath = 1;
    //echo "result: ".$result."<br>";
	while ($row = $result->fetch_assoc()){
    	$filePath = $row['immagine'];
    }
    return $filePath;
}


//uploadImage('postImages/');


/*
function displayResult(){
if($result != 'problema' and $result != 'init'){
        echo '<br><div class="success-badge">Operation Successful!</div>
        <form action="https://partener4i.altervista.org/WorkSpaceee/Social/indexSocial.php" method="post">
        <input type="submit" value="Go to Next Page">
        </form>';


}
else
{
if($result != 'init'){
        echo '<br><div class="failure-badge">Operation not Successful!</div>
        <form action="https://partener4i.altervista.org/WorkSpaceee/Social/creaPost/imageUploader.html" method="post">
        <input type="submit" value="back">
        </form>';
        }

}
  
} 
  */
  
  
  

?>
