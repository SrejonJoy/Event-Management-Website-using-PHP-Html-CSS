<?php
session_start(); // Start the session

// Check if the event ID was submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eventToCancel'])) {
    // Retrieve the selected event ID
    $selectedEventID = $_POST['eventToCancel'];
    
    // You can perform operations with the $selectedEventID here
    
    // Display the selected event ID
    echo "<p>The selected event ID is: " . $selectedEventID . "</p>";
} else {
    // If event ID wasn't submitted or is not set in POST data
    echo "No event ID found.";
}
?>
<!DOCTYPE html>
<html>
  <!-- Your existing head content -->
  <title>Your Company</title>
  <style>
    /* CSS for positioning elements */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      background-color: #f0f0f0;
    }

    .logo {
      width: 100px; /* Adjust size as needed */
    }
    .slogan {
      font-family: 'Montserrat', sans-serif; /* Change to your desired font */
      font-size: 21px;
      font-style: italic;
      font-weight: 600;
      animation: fadeIn 2s ease-in-out; /* Animation */
      padding-left: 80px;
    }
    .options {
      display: flex;
      align-items: center;
    }

    .options ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
    }

    .options ul li {
      display: inline-block;
      margin-right: 20px;
    }

    .dropdown-content {
    display: none; /* Hide dropdown content by default */
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    z-index: 1;
    }

    .dropdown:hover .dropdown-content {
        display: block; /* Show dropdown content on hover */
    }

    .dropdown-content ul {
        list-style-type: none; /* Remove default list styles */
        margin: 0;
        padding: 0;
    }

    .dropdown-content ul li {
    margin-bottom: 10px; /* Add bottom margin for spacing */
    display: block; /* Display the options vertically */
    }
    /* Adjusted option size and color */
    .options ul li a {
      color: red; /* Changes link color to red */
      font-size: 20px; /* Adjust font size as needed */
      font-weight: bold;
      padding: 4px 6px;
    }
    .buy-ticket-button {
  position: fixed;
  bottom: 20px;
  left: 50%;
  transform: translateX(-50%);
  text-align: center;
  width: 100%;
}

.buy-ticket-button button {
  width: 220px;
  height: 40px;
  border: none;
  outline: none;
  color: #fff;
  background: #111;
  cursor: pointer;
  position: relative;
  z-index: 0;
  border-radius: 10px;
  overflow: hidden;
}

.buy-ticket-button button:before {
  content: '';
  background: #fff;
  background: linear-gradient(to right, #fff, #000, #fff);
  position: absolute;
  top: -50%;
  left: -50%;
  width: 300%;
  height: 300%;
  border-radius: 50%;
  z-index: -1;
  transition: transform 0.5s, opacity 0.5s;
}

.buy-ticket-button button:hover:before {
  filter: blur(10px);
  opacity: 0;
  transform: translate(-50%, -50%) scale(0);
}

/* Add a glow effect on hover */
.buy-ticket-button button:hover {
  animation: glow 1.5s infinite;
}

    @keyframes glow {
      0% {
        box-shadow: 0 0 10px 2px #00ff00;
      }
      50% {
        box-shadow: 0 0 20px 5px #00ff00;
      }
      100% {
        box-shadow: 0 0 10px 2px #00ff00;
      }
    }
    @keyframes fadeInText {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    /* Animation keyframes */
    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }
  </style>
<head>
<div class="header">
  <!-- Your header content -->
  <div class="logo">
        <!-- Your Company Logo -->
        <img src="Split.png" alt="Company Logo" style="width: 220px; height: 150px;">
    </div>
    <div class="slogan">
        Life is an event. Make it memorable.
    </div>

  <class class="options">
  <ul>
      <li><a href="index_organizer.php">Home</a></li>
      <li><a href="event_reg.html">Create Event</a></li>
      <li><a href="myevents.php">My Events</a></li>
      <li class="dropdown">
        <a href="#">Event Type</a>
        <div class="dropdown-content">
          <ul>
          <li><a href="show_events2.php?type=CONCERT">Concerts</a></li>
          <li><a href="show_events2.php?type=COLLEGE%20EVENTS">College Events</a></li>
          <li><a href="show_events2.php?type=EXHIBITIONS">Exhibitions</a></li>
          <li><a href="show_events2.php?type=MEETINGS">Meetings</a></li>
          <li><a href="show_events2.php?type=CONFERENCES">Conferences</a></li>
          <li><a href="show_events2.php?type=FASHION%20SHOWS">Fashion Shows</a></li>
          <li><a href="show_events2.php?type=SEMINARS">Seminars</a></li>
        </ul>
    </div>
  </li>
  <li><a href="event2.php">Events</a></li>
  <li><a href="logout.php">Logout</a></li>
  <!-- Replace href with your company's Facebook page URL -->
</ul>
</div>
</head>
<body>
<?php
require_once('DBConnect.php');

// Check if the event ID was submitted via POST method
if (isset($_POST['eventToCancel'])) {
    // Assuming $selectedEventID is obtained from the posted form data or any other source
    $selectedEventID = $_POST['eventToCancel'];

    // ... your existing code for event cancellation...

    // Retrieve payment information for the selected event ID
    $sql = "SELECT bkash_number AS Phone_Number, amount AS Amount FROM bkash_payments WHERE Event_ID = '$selectedEventID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            // Display phone numbers and amounts associated with the selected event ID
            echo "<p>Phone Number: " . $row["Phone_Number"] . " Got refund- Amount: " . $row["Amount"] . "</p>";
        }
    } else {
        echo "No payments found for this event.";
    }

    // Close the database connection
        $sqlDeleteBkashPayments = "DELETE FROM bkash_payments WHERE Event_ID = '$selectedEventID'";
    if ($conn->query($sqlDeleteBkashPayments) === TRUE) {
        echo "Payments related to the event have been removed successfully.<br>";
    } else {
        echo "Error removing payments: " . $conn->error . "<br>";
    }

    // Delete related records from ticket_info table
    $sqlDeleteTicketInfo = "DELETE FROM ticket_info WHERE Event_ID = '$selectedEventID'";
    if ($conn->query($sqlDeleteTicketInfo) === TRUE) {
        echo "Tickets related to the event have been removed successfully.<br>";
    } else {
        echo "Error removing tickets: " . $conn->error . "<br>";
    }

    // Delete related records from events table
    $sqlDeleteEvents = "DELETE FROM events WHERE Event_ID = '$selectedEventID'";
    if ($conn->query($sqlDeleteEvents) === TRUE) {
        echo "Event details have been removed successfully.<br>";
    } else {
        echo "Error removing event: " . $conn->error . "<br>";
    }

    $conn->close();

} else {
    // If event ID wasn't submitted or is not set in POST data
    echo "No event ID found.";
}

?>
</body>