<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event Scheduler Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f7fa;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .card {
      max-width: 500px;
      width: 100%;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .tabs {
     display: flex;
     justify-content: space-around;
     margin-bottom: 20px;
   }
   .tabs button {
     background-color: #fff;
     border: 1px solid #dee2e6;
     border-radius: 20px;
     color: #007bff;
     padding: 10px 20px;
     font-weight: bold;
     cursor: pointer;
   }
   .tabs button.active {
     background-color: #007bff;
     color: white;
   }
   .btn-primary {
     width: 100%;
     border-radius: 30px;
     background-color: #007bff;
     border-color: #007bff;
     height: 45px;
     font-size: 16px;
   }
   .btn-primary:hover {
     background-color: #0056b3;
   }
   .form-label {
     font-weight: bold;
     font-size: 14px;
     margin-bottom: 5px;
   }
  </style>
</head>
<body>
  <div class="card">
    <!-- Tabs for navigation -->
    <div class="tabs">
      <h3 class="mb-4 text-center">Event Scheduler</h3>
      <button class="btn active btn-sm btn-success" id="creditCardTab">Credit Card</button>
      <button id="paypalTab">PayPal</button>
    </div>
    <form class="needs-validation" action="event_upload.php" method="POST" enctype="multipart/form-data" novalidate>
      <!-- Event Title -->
      <div class="row">
      <div class="col mb-3">
        <label for="eventTitle" class="form-label">Event Title</label>
        <input type="text" class="form-control form-control-sm" id="eventTitle" name="eventTitle" placeholder="Enter event title" required>
        <div class="invalid-feedback">
          Please enter the event title.
        </div>
      </div>

      <!-- Event Location -->
      <div class="col mb-3">
        <label for="eventLocation" class="form-label">Event Location/Address</label>
        <input type="text" class="form-control form-control-sm" id="eventLocation" name="eventLocation" placeholder="Enter location or address" required>
        <div class="invalid-feedback">
          Please provide a location or address for the event.
        </div>
      </div>
    </div>

      <!-- Start Date and Time -->
      <div class="row">
      <div class="col mb-3">
        <label for="startDateTime" class="form-label">Start Date and Time</label>
        <input type="datetime-local" class="form-control form-control-sm" id="startDateTime" name="startDateTime" required>
        <div class="invalid-feedback">
          Please select a start date and time.
        </div>
      </div>

      <!-- End Date and Time -->
      <div class="col mb-3">
        <label for="endDateTime" class="form-label">End Date and Time</label>
        <input type="datetime-local" class="form-control form-control-sm" id="endDateTime" name="endDateTime" required>
        <div class="invalid-feedback">
          Please select an end date and time.
        </div>
      </div>
    </div>

      <!-- Event Description -->
      <div class="row">
      <div class="col mb-3">
        <label for="eventDescription" class="form-label">Event Description</label>
        <textarea class="form-control form-control-sm" id="eventDescription" name="eventDescription" rows="3" placeholder="Enter event description" required></textarea>
        <div class="invalid-feedback">
          Please provide a description of the event.
        </div>
      </div>
    </div>

      <!-- Organizer Name -->
      <div class="row">
      <div class="col mb-3">
        <label for="organizerName" class="form-label">Organizer Name</label>
        <input type="text" class="form-control form-control-sm" id="organizerName" name="organizerName" placeholder="Enter organizer's name" required>
        <div class="invalid-feedback">
          Please enter the organizer's name.
        </div>
      </div>

      <!-- Organizer Contact Number -->
      <div class="col mb-3">
        <label for="organizerContact" class="form-label">Organizer Contact Number</label>
        <input type="tel" class="form-control form-control-sm" id="organizerContact" name="organizerContact" placeholder="Enter contact number" required>
        <div class="invalid-feedback">
          Please provide a valid contact number.
        </div>
      </div>
    </div>

      <!-- Organizer Photo -->
      <div class="row">
      <div class="col mb-3">
        <label for="organizerPhoto" class="form-label">Organizer Photo</label>
        <input type="file" class="form-control form-control-sm" id="organizerPhoto" name="photo"  required>
        <div class="invalid-feedback">
          Please upload a photo of the organizer.
        </div>
      </div>
    </div>

      <!-- Submit Button -->
      <button type="submit" class="btn btn-primary" name="sendEvents">Confirm</button>
    </form>


  </div>

  <!-- Bootstrap JS with Popper for validation -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Form Validation Script -->
  <script>
    // Disable form submission if there are invalid fields
    (function () {
      'use strict'
      const forms = document.querySelectorAll('.needs-validation')

      Array.from(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
    })()

    // Tabs interaction
    const creditCardTab = document.getElementById('creditCardTab');
    const paypalTab = document.getElementById('paypalTab');
    const bankTransferTab = document.getElementById('bankTransferTab');

    creditCardTab.addEventListener('click', function () {
      setActiveTab(creditCardTab);
    });

    paypalTab.addEventListener('click', function () {
      setActiveTab(paypalTab);
    });

    bankTransferTab.addEventListener('click', function () {
      setActiveTab(bankTransferTab);
    });

    function setActiveTab(activeTab) {
      [creditCardTab, paypalTab, bankTransferTab].forEach(tab => {
        tab.classList.remove('active');
      });
      activeTab.classList.add('active');
    }
  </script>
</body>
</html>
