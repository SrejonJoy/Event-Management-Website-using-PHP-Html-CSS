<?php

session_start();

if (isset($_SESSION['userID'])) {
    $organizerID = $_SESSION['userID'];
    
} else {
    echo "Organizer ID not found in session.";
}
?>
<!DOCTYPE html>
<html>
<head>
<div class="header">
  <div class="logo">
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
  <title>Cancel Event</title>
  <style>
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      background-color: #f0f0f0;
    }

    .logo {
      width: 100px; 
    }
    .slogan {
      font-family: 'Montserrat', sans-serif; 
      font-size: 21px;
      font-style: italic;
      font-weight: 600;
      animation: fadeIn 2s ease-in-out; 
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
    display: none; 
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    z-index: 1;
    }

    .dropdown:hover .dropdown-content {
        display: block; 
    }

    .dropdown-content ul {
        list-style-type: none; 
        margin: 0;
        padding: 0;
    }

    .dropdown-content ul li {
    margin-bottom: 10px; 
    display: block; 
    }
  
    .options ul li a {
      color: red; 
      font-size: 20px; 
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
</head>
<body>
  <h1>Select Event to Cancel</h1>
  
  <!-- Additional content before the form -->
  <p>Select an event from the list below to proceed with the cancellation:</p>
  
  <!-- The form for event selection -->
  <form action="confirm_cancel.php" method="post">
    <label for="events">Choose an event to cancel:</label>
    <select id="events" name="eventToCancel">
      <?php
      session_start();

      if (isset($_SESSION['userID'])) {
        
        require_once('DBConnect.php');

       
        $organizerID = $_SESSION['userID'];

       
        $sql = "SELECT Event_ID, Name FROM events WHERE Organizer_Id = '$organizerID'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            
            echo "<option value='" . $row["Event_ID"] . "'>" . $row["Name"] . "</option>";
          }
        } else {
          echo "<option value=''>No events found</option>";
        }
      } else {
        echo "<option value=''>Organizer ID not found</option>";
      }
      ?>
      <input type="submit" value="Continue">
      </form>