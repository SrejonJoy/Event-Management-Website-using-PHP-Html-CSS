<!DOCTYPE html>
<html>
  
  <title>Your Company</title>
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
      <li><a href="index.php">Home</a></li>
      <li><a href="index.php#who-we-are">About Us</a></li>
      <li><a href="mytickets.php">My Tickets</a></li>
      <li class="dropdown">
        <a href="#">Event Type</a>
        <div class="dropdown-content">
          <ul>
          <li><a href="show_events.php?type=CONCERT">Concerts</a></li>
          <li><a href="show_events.php?type=COLLEGE%20EVENTS">College Events</a></li>
          <li><a href="show_events.php?type=EXHIBITIONS">Exhibitions</a></li>
          <li><a href="show_events.php?type=MEETINGS">Meetings</a></li>
          <li><a href="show_events.php?type=CONFERENCES">Conferences</a></li>
          <li><a href="show_events.php?type=FASHION%20SHOWS">Fashion Shows</a></li>
          <li><a href="show_events.php?type=SEMINARS">Seminars</a></li>
        </ul>
    </div>
  </li>
  <li><a href="event1.php">Events</a></li>
  <li><a href="logout2.php">Logout</a></li>
</ul>
</div>
</head>
<body>
<div class="header">

</div>
<div class="page-content">
  <h2>Event Details</h2>
  <div class="event-details">
    <?php
    require_once('DBConnect.php');

   
    $event_id = $_GET['event_id'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    
    $sql = "SELECT * FROM events WHERE Event_ID = $event_id";
    $result = $conn->query($sql);

    
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      
      echo "<p>Event ID: " . $row["Event_ID"] . "</p>";
      echo "<p>Name: " . $row["Name"] . "</p>";
      echo "<p>Organizer ID: " . $row["Organizer_ID"] . "</p>";
      echo "<p>Date: " . $row["Date"] . "</p>";
      echo "<p>Event Type: " . $row["Event Type"] . "</p>";
      echo "<p>Title: " . $row["Title"] . "</p>";
      echo "<p>Description: " . $row["Description"] . "</p>";
      echo "<p>Time Slot: " . $row["Time Slot"] . "</p>";
      echo "<p>Capacity: " . $row["Capacity"] . "</p>";
      echo "<p>Ticket Price: " . $row["Ticket Price"] . "</p>";
     
    } else {
      echo "Event details not found";
    }
    
    $conn->close();
    ?>
    <?php
  $_SESSION['organizer_id'] = $row["Organizer_ID"];
  $_SESSION['ticket_price'] = $row["Ticket Price"];
?>
<div class="buy-ticket-button">
  <button class="glow-on-hover" type="button" onclick="window.location.href = 'ticket1.php?organizer_id=<?php echo $row["Organizer_ID"]; ?>&event_id=<?php echo $row["Event_ID"]; ?>&ticket_price=<?php echo $row["Ticket Price"]; ?>';">Buy Ticket</button>
</div>
</div>
  </div>
</div>
</body>
</html>
