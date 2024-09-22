
<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$conn = new mysqli("localhost", "root", "", "yfgr_db");

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sendEvents'])) {
    // Collect event data from the form and escape inputs
    $eventTitle = $conn->real_escape_string($_POST['eventTitle']);
    $place = $conn->real_escape_string($_POST['eventPlace']);
    $eventDescription = $conn->real_escape_string($_POST['eventDescription']);
    $date = $_POST['eventDate'];

    // Initialize variables for storing file names
    $eventImages = isset($_POST['eventImages']);
   $eventVideos = isset($_POST['eventVideos']);

    $imageDir = 'images/';
    if (!is_dir($imageDir)) {
        mkdir($imageDir, 0777, true);
    }
    $videoDir = 'videos/';
    if (!is_dir($videoDir)) {
        mkdir($videoDir, 0777, true);
    }

    // Handle Event Images
    if (isset($_FILES['eventImages']) && $_FILES['eventImages']['error'][0] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['eventImages']['tmp_name'][0];
        $fileName = $_FILES['eventImages']['name'][0];
        $fileSize = $_FILES['eventImages']['size'][0];
        $fileType = $_FILES['eventImages']['type'][0];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Valid image extensions
        $allowedImageExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        // Check if valid image
        if (in_array($fileExtension, $allowedImageExtensions)) {
            // Set a unique filename
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $destPath = $imageDir . $newFileName;

            // Move uploaded image to destination
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $eventImages = $newFileName; // Store the file name
            } else {
                echo "<script>alert('Image upload failed: " . htmlspecialchars($fileName) . "');</script>";
            }
        } else {
            echo "<script>alert('Invalid image file type: " . htmlspecialchars($fileName) . "');</script>";
        }
    } else {
        if (isset($_FILES['eventImages']) && $_FILES['eventImages']['error'][0] !== UPLOAD_ERR_OK) {
            echo "<script>alert('Error uploading image: " . $_FILES['eventImages']['error'][0] . "');</script>";
        }
    }

    // Handle Event Videos
    if (isset($_FILES['eventVideos']) && $_FILES['eventVideos']['error'][0] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['eventVideos']['tmp_name'][0];
        $fileName = $_FILES['eventVideos']['name'][0];
        $fileSize = $_FILES['eventVideos']['size'][0];
        $fileType = $_FILES['eventVideos']['type'][0];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Valid video extensions
        $allowedVideoExtensions = ['mp4', 'avi', 'mov', 'wmv'];

        // Check if valid video
        if (in_array($fileExtension, $allowedVideoExtensions)) {
            // Set a unique filename
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $destPath = $videoDir . $newFileName;

            // Move uploaded video to destination
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $eventVideos = $newFileName; // Store the file name
            } else {
                echo "<script>alert('Video upload failed: " . htmlspecialchars($fileName) . "');</script>";
            }
        } else {
            echo "<script>alert('Invalid video file type: " . htmlspecialchars($fileName) . "');</script>";
        }
    } else {
        if (isset($_FILES['eventVideos']) && $_FILES['eventVideos']['error'][0] !== UPLOAD_ERR_OK) {
            echo "<script>alert('Error uploading video: " . $_FILES['eventVideos']['error'][0] . "');</script>";
        }
    }

    // Prepare SQL query to insert event data
    $stmt = $conn->prepare("INSERT INTO events (title, place, description, event_date, images, videos) VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        echo "<script>alert('SQL prepare error: " . htmlspecialchars($conn->error) . "');</script>";
    } else {
        // Bind parameters to the SQL query
        $stmt->bind_param('ssssss', $eventTitle, $place, $eventDescription, $date, $eventImages, $eventVideos);

        // Execute the query and check the result
        if ($stmt->execute()) {
            echo "<script>alert('New event posted successfully');</script>";
        } else {
            echo "<script>alert('Error executing query: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    }
}
// Close connection
$conn->close();
?>
