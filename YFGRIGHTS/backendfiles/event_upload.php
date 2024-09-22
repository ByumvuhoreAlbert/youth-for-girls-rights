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

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sendEvents'])) {
    // Collect event data from the form
    $event_title = $_POST['eventTitle'];
    $event_location = $_POST['eventLocation'];
    $start_datetime = $_POST['startDateTime'];
    $end_datetime = $_POST['endDateTime'];
    $event_description = $_POST['eventDescription'];
    $organizer_name = $_POST['organizerName'];
    $organizer_contact = $_POST['organizerContact'];

    // Initialize photo variable
    $organizer_photo = '';

    // Check if a file is uploaded
        $fileName = $_FILES['photo']['name'];
        $fileTmpPath = $_FILES['photo']['tmp_name'];
        $fileSize = $_FILES['photo']['size'];
        $fileError = $_FILES['photo']['error'];
        $fileType = $_FILES['photo']['type'];

        // Extract file extension
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Allowed file types
        $allowedExt = array('jpg', 'jpeg', 'png', 'pdf', 'mp4', 'mpg', 'docx');

        // Validate file extension
        if (in_array($fileExt, $allowedExt)) {
              // Check for upload errors
              if ($fileError === 0) {
            // Validate file size (limit: 5MB)
            if ($fileSize < 5000000) {
                    // Create a unique file name and move the uploaded file
                    $fileNameNew = uniqid('', true) . "." . $fileExt;
                    $fileDestPath = "upload/" . $fileNameNew;

                    // Move the uploaded file to the destination
                    if (move_uploaded_file($fileTmpPath, $fileDestPath)) {
                        $organizer_photo = $fileNameNew;
                    } else {
                        echo "<script>alert('There was an error moving the uploaded file.');</script>";
                    }

                } else {
                    echo "<script>alert('File is too large. Maximum size is 5MB.');</script>";
                }
                } else {
                    echo "<script>alert('There was an error during the file upload.');</script>";
                }
        } else {
            echo "<script>alert('Invalid file type. Allowed types: jpg, jpeg, png, pdf, mp4, mpg, docx.');</script>";
        }

    // Prepare the SQL statement to insert event data
    $stmt = $conn->prepare("INSERT INTO events (event_title, event_location, start_datetime, end_datetime, event_description, organizer_name, organizer_contact, organizer_photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        echo "<script>alert('SQL prepare error: " . htmlspecialchars($conn->error) . "');</script>";
    } else {
        // Bind parameters (all are strings, including the image file name)
        $stmt->bind_param("ssssssss", $event_title, $event_location, $start_datetime, $end_datetime, $event_description, $organizer_name, $organizer_contact, $organizer_photo);

        // Execute the query and check the result
        if ($stmt->execute()) {
            echo "<script>alert('New event posted successfully');</script>";
            header("location: events.php?uploadsuccess"); // Redirect after successful event posting
        } else {
            echo "<script>alert('Error executing query: " . $stmt->error . "');</script>";
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>

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

// SQL query to fetch all data from the events table
$sql = "SELECT * FROM events";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    echo "<table border='1' cellpadding='10' cellspacing='0'>
            <tr>
                <th>ID</th>
                <th>Event Title</th>
                <th>Event Location</th>
                <th>Start DateTime</th>
                <th>End DateTime</th>
                <th>Description</th>
                <th>Organizer Name</th>
                <th>Organizer Contact</th>
                <th>Organizer Photo</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['event_title'] . "</td>
                <td>" . $row['event_location'] . "</td>
                <td>" . $row['start_datetime'] . "</td>
                <td>" . $row['end_datetime'] . "</td>
                <td>" . $row['event_description'] . "</td>
                <td>" . $row['organizer_name'] . "</td>
                <td>" . $row['organizer_contact'] . "</td>
                <td><img src='upload/" . $row['organizer_photo'] . "' alt='Photo' width='100' height='100'></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No events found.";
}

// Close the database connection
$conn->close();
?>
