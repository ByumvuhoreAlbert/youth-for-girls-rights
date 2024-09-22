<?php

$conn = new mysqli("localhost", "root", "", "yfgr_db");

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $files = $_FILES['file'];
  print_r($files);

  $image ="";

  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowedExt = array('jpg', 'jpeg', 'png', 'pdf', 'mp4', 'mpg', 'docx');

  if(in_array($fileActualExt, $allowedExt)){
    if($fileError === 0){
      if($fileSize < 5000000){
        $fileNameNew = uniqid('', true).".".$fileActualExt;
        $fileDestPath = 'uploads/'. $fileNameNew;
        $image = $fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestPath);
        header("location: test.php?uploadsuccess");
      }else{
        echo "<script>alert('This File is bigger than specified size'); </script>";
      }
    }else{
      echo "<script>alert('The was an error uploading file'); </script>";
    }
  }else {
    echo "<script>alert('Fail to upload file'); </script>";
  }

  // Prepare the SQL statement to insert event data
    $stmt = $conn->prepare("INSERT INTO file_uploads (title, file_path) VALUES (?, ?)");

    if ($stmt === false) {
        echo "<script>alert('SQL prepare error: " . htmlspecialchars($conn->error) . "');</script>";
    } else {
        // Bind parameters (all are strings, including the image file name)
        $stmt->bind_param("ss", $title, $image);

        // Execute the query and check the result
        if ($stmt->execute()) {
            echo "<script>alert('New event posted successfully');</script>";
        } else {
            echo "<script>alert('Error executing query: " . $stmt->error . "');</script>";
        }

        // Close the statement
        $stmt->close();
    }
}
?>
