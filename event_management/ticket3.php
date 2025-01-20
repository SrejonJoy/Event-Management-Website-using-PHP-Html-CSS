<?php
require_once('DBConnect.php');
session_start();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Access the submitted array values

    $userIDs = $_POST['user_id'];
    $eventIDs = $_POST['event_id'];
    $organizerIDs = $_POST['organizer_id'];
    $ticketQuantity = intval($_POST['ticket_quantity']);
    $participantNames = $_POST['participant_name'];
    $ages = $_POST['age'];
    $phoneNumbers = $_POST['phone_number'];
    $bkashNumber = $_POST['number'];
    $amount = $_POST['amount'];
    $password = $_POST['password'];
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
    
    
    .search-container {
      text-align: center;
      margin-top: 20px; 
    }

    .search-container input[type="text"] {
      padding: 10px;
      align-content: center;
      border-radius: 25px;
      border: 2px solid #ccc;
      font-size: 16px;
      transition: 0.5s;
      width: 200px; 
      outline: none;
    }

    .search-container input[type="text"]:focus {
      border-color: #ff6f61;
    }

    .search-container button[type="submit"] {
      padding: 10px 20px;
      border: none;
      border-radius: 25px;
      background-color: #ff6f61;
      color: white;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
      margin-left: -5px; 
    }

    .search-container button[type="submit"]:hover {
      background-color: #f44336;
    }
    .page-content {
    max-width: 800px; 
    margin: 0 auto; 
    text-align: center; 
    }

    .event-list {
    display: inline-block; 
    text-align: left; 
    }
    
    .event-container {
    background-color: black;
    color: white;
    padding: 10px;
    margin-bottom: 20px;
    }
    .details-button {
    display: inline-block;
    padding: 8px 16px;
    border: 2px solid white;
    color: white;
    text-decoration: none;
    transition: background-color 0.3s, color 0.3s;
    }

 
    .details-button:hover {
    background-color: white;
    color: black;
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
<!-- Page content -->
<div class="page-content">
  <h2>Ticket Confirmed</h2>
  <div class="event-list">
<?php
require_once('DBConnect.php');


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Access the submitted array values

    $userIDs = $_POST['user_id'];
    $eventIDs = $_POST['event_id'];
    $organizerIDs = $_POST['organizer_id'];
    $ticketQuantity = intval($_POST['ticket_quantity']);
    $participantNames = $_POST['participant_name'];
    $ages = $_POST['age'];
    $phoneNumbers = $_POST['phone_number'];
    $bkashNumber = $_POST['number'];
    $amount = $_POST['amount'];
    $password = $_POST['password'];

    // Display the array values
    for ($i = 0; $i < count($userIDs); $i++) {
        echo "User ID: " . $userIDs[$i] . "<br>";
        echo "Event ID: " . $eventIDs[$i] . "<br>";
        echo "Organizer ID: " . $organizerIDs[$i] . "<br>";
        echo "Participant Name: " . $participantNames[$i] . "<br>";
        echo "Ticket Quantity: " . $ticketQuantity . "<br>";
        echo "Age: " . $ages[$i] . "<br>";
        echo "Phone Number: " . $phoneNumbers[$i] . "<br><br>";
        echo "bKash Number: " . $bkashNumber . "<br>";
        echo "Amount: " . $amount . "<br>";
        echo "Password: " . $password . "<br>";
    
    }
    for ($i = 0; $i < count($userIDs); $i++) {
        $participantName = mysqli_real_escape_string($conn, $participantNames[$i]);
        $age = mysqli_real_escape_string($conn, $ages[$i]);
        $phoneNumber = mysqli_real_escape_string($conn, $phoneNumbers[$i]);

        $userID = mysqli_real_escape_string($conn, $userIDs[$i]);
        $eventID = mysqli_real_escape_string($conn, $eventIDs[$i]);
        $organizerID = mysqli_real_escape_string($conn, $organizerIDs[$i]);

        $insertQuery = "INSERT INTO ticket_info (`Participant Name`, `Age`, `Phone_Number`, `User_ID`, `Event_ID`, `Organizer_ID`)
                        VALUES ('$participantName', '$age', '$phoneNumber', '$userID', '$eventID', '$organizerID')";
        
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            echo "Ticket $i information added successfully.<br>";
        } else {
            echo "Error adding ticket $i information: " . mysqli_error($conn) . "<br>";
        }
    }
    $bkashSql = "INSERT INTO bkash_payments (bkash_number, amount, password,Event_ID) VALUES ('$bkashNumber', '$amount', '$password','$eventID')";
    if ($conn->query($bkashSql) === TRUE) {
        echo "bKash payment record created successfully<br>";
    } else {
        echo "Error inserting bKash payment record: " . $conn->error;
    }
    
}
?>

