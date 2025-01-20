<!DOCTYPE html>
<html>
<head>
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
<?php
require_once('DBConnect.php');

if (isset($_GET['search'])) {
    $search = $_GET['search'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $sql = "SELECT * FROM events WHERE Name LIKE '%$search%' ORDER BY Date ASC ";
    $result = $conn->query($sql);
    
    // Display events if there are any
    if ($result->num_rows > 0) {
        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<head>";
        echo "</head>";
        echo "<body>";
        echo "<div class='page-content'>";
        echo "<h2>Search Results</h2>";
        echo "<div class='event-list'>";

        while ($row = $result->fetch_assoc()) {
            echo "<div class='event-container'>";
            echo "<div class='event-box'>";
            echo "<h3>" . $row["Event_ID"] . "</h3>";
            echo "<p>Date: " . $row["Date"] . "</p>";
            echo "<p>Name: " . $row["Name"] . "</p>";
            echo "<a href='event_template2.php?event_id=" . $row["Event_ID"] . "' class='details-button'>Tap to see details</a>";
            echo "</div>";
            echo "</div>";
        }

        echo "</div>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
    } else {
        echo "No events found";
    }

    
    $conn->close();
} else {
    
    header("Location: index_organizer.html");
    exit();
}
?>
</body>
</html>
