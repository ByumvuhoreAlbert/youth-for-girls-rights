<?php
//include 'testnew.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple Files Upload</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="upload-container">
        <h2>Multiple Files Upload</h2>
        <form id="uploadForm" action="testnew.php" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
            <div class="file-row">
			     <label>Image Title:</label>
                <input type="text" name="title" placeholder="Title" required><br>
				</div>
				<div class="file-row">
				</label>Image Types: <label>
				<select name="types" required>
				<option value="">Select type</option>
				<option value="Event Image">Event Image</option>
				<option value="News Image">News Image</option>
				<option value="Post Image">Post Image</option>
				</div>
				<div class="file-row">
                <input type="file" name="files[]" multiple required>
            </div>
            <div id="extraFiles"></div>
            <button type="submit" class="upload-btn" name="upload">Upload</button>
        </form>
    </div>
    
</body>
</html>
