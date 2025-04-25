
<?php 
include 'db.php';

if(isset($_POST['imgupload'])){
 
  $name = $_FILES['file']['name'];
  $target_dir = "assets/img/profile/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);

  // Select file type
  var_dump($target_file);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
 
     // Insert record
     
      $query = "UPDATE tbl_admin SET profile ='".$target_file."'";
     mysqli_query($link,$query);
  
     // Upload file
     move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
     echo "done";
  }
 
}
?>