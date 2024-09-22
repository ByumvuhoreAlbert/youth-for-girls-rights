
<?php
// header('Content-Type: application/json');
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include'includes/navbars.html';

// Database connection
$conn = new mysqli("localhost", "root", "", "yfgr_db");

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

?>

<div class="container my-5">
    <div class="row">
          <!-- Recent and Last Events Sidebar -->
          <div class="col-md-4">
            <!-- Recent Scheduled Events Card -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Recent Scheduled Events</h5>
                </div>
                <div class="card-body">
                  <?php
                  $currentDateTime = date('Y-m-d H:i:s');
                  $sqlUpcoming = "SELECT event_title, event_location FROM events
                                  WHERE '$currentDateTime' BETWEEN created_at AND end_datetime
                                  ORDER BY created_at DESC";
                  $resultUpcoming = $conn->query($sqlUpcoming);

                  if ($resultUpcoming->num_rows > 0): ?>
                      <?php while($row = $resultUpcoming->fetch_assoc()): ?>
                          <div class="event-item card">
                              <div class="card-body">
                                  <!-- Use JavaScript function to load event details -->
                                  <a href="javascript:void(0)" onclick="loadEventDetails('<?php echo htmlspecialchars($row['event_title']); ?>')">
                                      <?php echo htmlspecialchars($row['event_title']); ?> At <?php echo htmlspecialchars($row['event_location']); ?>
                                  </a>
                              </div>
                          </div>
                      <?php endwhile; ?>
                  <?php else: ?>
                      <div class="card-body">No upcoming events found.</div>
                  <?php endif; ?>
              </div>
              <div >
              </div>

            </div>

            <!-- Last Scheduled Event Card -->
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Last Event Scheduled</h5>
                </div>
                <?php
                  $currentDateTime = date('Y-m-d H:i:s');
                  $sqlCompleted = "SELECT event_title, event_location FROM events
                                   WHERE '$currentDateTime' > end_datetime
                                   ORDER BY end_datetime DESC";
                  $resultCompleted = $conn->query($sqlCompleted);
              ?>

              <div class="card-body">
                  <?php if ($resultCompleted->num_rows > 0): ?>
                      <?php while($row = $resultCompleted->fetch_assoc()): ?>
                          <div class="event-item card">
                              <div class="card-body">
                                  <a href="#<?php echo htmlspecialchars($row['event_title']); ?>">
                                      <?php echo htmlspecialchars($row['event_title']); ?> At <?php echo htmlspecialchars($row['event_location']); ?>
                                  </a>
                              </div>
                          </div>
                      <?php endwhile; ?>
                  <?php else: ?>
                      <div class="card-body">No completed events found.</div>
                  <?php endif; ?>
              </div>
            </div>
          </div>

        <!-- Event Content Area -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info text-white">
                  <h5 class="mb-0 text-dark">Event Details And Contents</h5>
                </div>
                <div id="eventDetails" class="card-body">
                    <?php
                    $currentDateTime = date('Y-m-d H:i:s');
                    $dateRange = date('Y-m-d H:i:s'); // Adjusted range to 30 days

                    // SQL query to select events created within the last 30 days, ordered by start_datetime
                    $sql = "SELECT * FROM events
                          WHERE created_at BETWEEN ? AND ?
                          ORDER BY start_datetime ASC"; // Order by start_datetime for chronological order

                    // Prepare and execute the SQL statement
                    if ($stmt = $conn->prepare($sql)) {
                      $stmt->bind_param('ss', $currentDateTime, $dateRange);
                      $stmt->execute();
                      $result = $stmt->get_result();

                      // Check if there are results
                      if ($result->num_rows > 0): ?>
                                  <?php while ($row = $result->fetch_assoc()): ?>
                                    <h5 class="mb-0 text-dark"><?php echo htmlspecialchars($row['event_title']); ?></h5>
                                    <div class="text d-flex justify-content-space-between text-danger">
                                    <p><strong>At:</strong> <?php echo htmlspecialchars($row['event_location']); ?></p>
                                    <p><strong> &nbsp;&nbsp;&nbsp; From: &nbsp;</strong> <?php echo htmlspecialchars($row['start_datetime']); ?></p>
                                    <p><strong> &nbsp;&nbsp;&nbsp; To: &nbsp;</strong> <?php echo htmlspecialchars($row['end_datetime']); ?></p>
                                    </div>
                                    <p><strong><?php echo htmlspecialchars($row['event_title']); ?>: </strong> <?php echo htmlspecialchars($row['event_description']); ?></p>
                                    <p><strong>Organized by:</strong> <?php echo htmlspecialchars($row['organizer_name']); ?></p>
                                    <p><strong>Contact:</strong> <?php echo htmlspecialchars($row['organizer_contact']); ?></p>
                                    <img src="backendfiles/upload/<?php echo htmlspecialchars($row['organizer_photo']); ?>" alt="Organizer Photo" style="max-width: 100px;"/>
                                  <?php endwhile; ?>
                      <?php else: ?>
                          <p>No events found.</p>
                      <?php endif;

                      $stmt->close();
                    } else {
                      echo "Error preparing statement: " . $conn->error;
                    }

                    $conn->close();
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>


<!-- Template Javascript -->
<script src="js/main.js"></script>
<script>
function loadEventDetails(eventTitle) {
    fetch('backendfiles/get_event_details.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'event_title=' + encodeURIComponent(eventTitle)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();  // Expecting JSON response
    })
    .then(data => {
        if (data.error) {
            document.getElementById('eventDetails').innerHTML = `<p>Error: ${data.error}</p>`;
        } else {
            // Ensure the image URL is properly escaped
            const imageUrl = encodeURI(data.organizer_photo);

            document.getElementById('eventDetails').innerHTML = `
                <h3 class="text-h3 text-success">${data.event_title}</h3>
                <div class="text d-flex justify-content-space-between text-danger">
                <p><strong>At:</strong> ${data.event_location}</p>
                <p><strong> &nbsp;&nbsp;&nbsp; From: &nbsp;</strong> ${data.start_datetime}</p>
                <p><strong> &nbsp;&nbsp;&nbsp; To: &nbsp;</strong> ${data.end_datetime}</p>
                </div>
                <p><strong>${data.event_title}: </strong> ${data.event_description}</p>
                <p><strong>Organized body:</strong> ${data.organizer_name}</p>
                <p><strong>Contact:</strong> ${data.organizer_contact}</p>
                <img src="backendfiles/upload/${imageUrl}" alt="Organizer Photo" style="max-width: 100px;"/>
            `;
        }
    })
    .catch(error => {
        console.error('Error loading event details:', error);
        document.getElementById('eventDetails').innerHTML = `<p>Error loading event details.</p>`;
    });
}
</script>
