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

    /* Animation keyframes */
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

$userID = $_SESSION['userID'];
echo $_SESSION['userID'];

$sql = "SELECT * FROM ticket_info WHERE User_ID = '$userID'";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<h2>Ticket Information</h2>";
        echo "<p>Ticket No: " . $row['Ticket_No'] . "</p>";
        echo "<p>Participant Name: " . $row['Participant Name'] . "</p>";
        echo "<p>Age: " . $row['Age'] . "</p>";
        echo "<p>Phone Number: " . $row['Phone_Number'] . "</p>";
        echo "<p>Event ID: " . $row['Event_ID'] . "</p>";
        $eventID = $row['Event_ID'];
        $eventSql = "SELECT Name FROM events WHERE Event_ID = '$eventID'";
        $eventResult = mysqli_query($conn, $eventSql);
    
        if ($eventResult && mysqli_num_rows($eventResult) > 0) {
            $eventRow = mysqli_fetch_assoc($eventResult);
            echo "<p>Event Name: " . $eventRow['Name'] . "</p>";
        } else {
            echo "<p>Event Name: Not Available</p>";
        }
        
        echo "<hr>";
        echo "<hr>";
    }
} else {
    echo "No tickets found for this user.";
}
?>