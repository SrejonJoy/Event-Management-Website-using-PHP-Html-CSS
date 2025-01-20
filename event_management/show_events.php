<?php

session_start();


if (isset($_POST['mail']) && isset($_POST['password'])) {
    $u = $_POST['mail'];
    $p = $_POST['password'];
    $sql = "SELECT * from user WHERE Email='$u' AND Password='$p'";
    
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) != 0) {
        
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['First Name']; 
        $_SESSION['userID'] = $row['UserID']; 
        header("Location: index.php");
        exit();
    } else {
        echo "Email or Password is wrong";
    }
}
?>
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
    .user-info {
    position: absolute;
    top: 20px;
    right: 20px;
    background-color: #fff; 
    padding: 5px 10px;
    border: 1px solid #ccc;
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

  <div class="options">
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
</div>

<?php
require_once('DBConnect.php');


if (isset($_GET['type'])) {
    $eventType = $_GET['type'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM events WHERE `Event Type` = '$eventType'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<head>";
        echo "</head>";
        echo "<body>";
        echo "<div class='page-content'>";
        echo "<h2>Events of Type: $eventType</h2>";
        echo "<div class='event-list'>";

        while ($row = $result->fetch_assoc()) {
            echo "<div class='event-container'>";
            echo "<div class='event-box'>";
            echo "<h3>" . $row["Event_ID"] . "</h3>";
            echo "<p>Date: " . $row["Date"] . "</p>";
            echo "<p>Name: " . $row["Name"] . "</p>";
            echo "<a href='event_template.php?event_id=" . $row["Event_ID"] . "' class='details-button'>Tap to see details</a>";
            echo "</div>";
            echo "</div>";
        }

        echo "</div>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
    } else {
        echo "No events found for this type.";
    }
    $conn->close();
} else {
    echo "No event type selected.";
}
?>