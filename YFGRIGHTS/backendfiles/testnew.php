<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "yfgr_db";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload'])) {
      $titles = $_POST['title'];
	  $type = $_POST['types'];
	  $extension = array('jpg', 'jpeg', 'png', 'webp', 'bmp', 'gif', 'mp4');
     
	    foreach ($_FILES['files']['tmp_name'] as $key => $value){
              $fileName = $_FILES['files']['name'][$key];
              $fileTmpName = $_FILES['files']['tmp_name'][$key];
			  
			  $ext = pathinfo($fileName, PATHINFO_EXTENSION);
			  $finalimg = '';
			  if(in_array($ext, $extension)){
				  if(!file_exists('gallery/'. $fileName)){
				  move_uploaded_file($fileTmpName, 'gallery/'. $fileName);
                     $finalimg = $fileName;				  
				  }else{
					  echo 'This File is uploaded before';
				  }
				  //insert
				  $insert ="INSERT INTO `file_uploads`(`title`, `types`, `file_path`) 
				  VALUES ('$titles', '$type', '$finalimg')";
				  mysqli_query($conn, $insert);
				  header("Location: news.php?Success");
				  if($insert ===true){
					  echo 'image uploaded to gallery successfull';
				}
				  
			  }else{
				  echo'This File extension is not allowed';
			  }
		}		  
              
  }
  $conn->close();
?>
