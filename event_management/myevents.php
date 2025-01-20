<?php
// Start the session on the other page
session_start();

if (isset($_SESSION['userID'])) {
    // Access the organizer ID
    $organizerID = $_SESSION['userID'];
    
    // Use $organizerID as needed, such as performing database queries or displaying it
    echo "Organizer ID: $organizerID";
} else {
    echo "Organizer ID not found in session.";
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
</ul>
</div>
</head>
<body>
<?php
if (isset($_SESSION['userID'])) {
    require_once('DBConnect.php');
    
    // Retrieve the organizer ID from the session
    $organizerID = $_SESSION['userID'];
    
    
    $sql = "SELECT * FROM events WHERE Organizer_Id = '$organizerID'";
    $result = $conn->query($sql);
    // Display events if there are any
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='event-container'>";
        echo "<div class='event-box'>";
        echo "<h3>" . $row["Event_ID"] . "</h3>";
        echo "<p>Date: " . $row["Date"] . "</p>";
        echo "<p>Name: " . $row["Name"] . "</p>";
        echo "</div>";
        echo "</div>";
      }
    } else {
      echo "No events found";
    }
} else {
    echo "Organizer ID not found in session.";
    
    
}
echo "<div class='buy-ticket-button'>";
echo "<a href='cancel_event.php'><button>Cancel Event</button></a>";
echo "</div>";
?>