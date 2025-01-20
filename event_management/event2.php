<!DOCTYPE html>
<html>
<head>
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
    /* Your existing CSS styles */

    /* New styles for the search container */
    .search-container {
      text-align: center;
      margin-top: 20px; /* Adjust margin as needed */
    }

    .search-container input[type="text"] {
      padding: 10px;
      align-content: center;
      border-radius: 25px;
      border: 2px solid #ccc;
      font-size: 16px;
      transition: 0.5s;
      width: 200px; /* Adjust width as needed */
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
      margin-left: -5px; /* Adjust positioning */
    }

    .search-container button[type="submit"]:hover {
      background-color: #f44336;
    }
    .page-content {
    max-width: 800px; /* Adjust the maximum width of the events container */
    margin: 0 auto; /* Center-align the events container */
    text-align: center; /* Center-align text content inside the events container */
    }

    .event-list {
    display: inline-block; /* Ensure the events are displayed in a block */
    text-align: left; /* Left-align text content inside the events */
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

  /* Hover effect for the button */
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

<div class="search-container">
  <!-- Your search bar -->
  <form action="search_events2.php" method="GET">
    <input type="text" name="search" placeholder="Search...">
    <button type="submit">Search</button>
  </form>
</div>
<!-- Page content -->
<div class="page-content">
  <h2>Events</h2>
  <div class="event-list">
    <?php
    require_once('DBConnect.php');

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch events
    $sql = "SELECT * FROM events ORDER BY Date ASC";
    $result = $conn->query($sql);
    // Display events if there are any
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        // Start of event container
        echo "<div class='event-container'>";
        // Individual event details within the black box
        echo "<div class='event-box'>";
        echo "<h3>" . $row["Event_ID"] . "</h3>";
        echo "<p>Date: " . $row["Date"] . "</p>";
        echo "<p>Name: " . $row["Name"] . "</p>";
        // Button to see details
        echo "<a href='event_template2.php?event_id=" . $row["Event_ID"] . "' class='details-button'>Tap to see details</a>";
        echo "</div>";
        // End of event container
        echo "</div>";
      }
    } else {
      echo "No events found";
    }

    // Close the connection
    $conn->close();
    ?>
  </div>
</div>

</body>
</html>
