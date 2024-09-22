<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

// Database connection
$conn = new mysqli("localhost", "root", "", "yfgr_db");

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if (isset($_POST['event_title'])) {
    $event_title = $_POST['event_title'];

    // Query to fetch event details
    $sql = "SELECT event_title, event_location, start_datetime, end_datetime, event_description, organizer_name, organizer_contact, organizer_photo FROM events WHERE event_title = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $event_title);  // 's' indicates the variable type string
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if we have a result
    if ($result->num_rows > 0) {
        $event_details = $result->fetch_assoc();
        echo json_encode($event_details);  // Return the event details as JSON
    } else {
        // Return error if event is not found
        echo json_encode(['error' => 'Event not found']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'No event title provided']);
}
