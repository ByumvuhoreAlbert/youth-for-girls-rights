<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
      <input type="text" name="title" placeholder="enter title" value="">
      <input type="file" name="file" value="">
      <button type="submit" name="submit">upload</button>
    </form><br><br>

    <?php

    $conn = new mysqli("localhost", "root", "", "yfgr_db");

    // Check connection
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM file_uploads";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $img = $row['file_path'];
        $title = $row['title'];
      }
    }else{
      echo"no result found";
    }
    ?>
    <img src="uploads/<?php echo $img; ?>" alt="img" height="120px" width="120px"><br>
    <p><?php echo $title; ?></p>
  </body>
</html>
