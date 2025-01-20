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
    display: flex; 
    flex-wrap: wrap; 
    justify-content: center; 
    gap: 20px; 
    }

    .event-container {
    position: relative; 
    padding: 10px;
    margin-bottom: 20px;
    width: calc(33.33% - 20px);
    border-radius: 5px; 
    overflow: hidden;
  }

  .event-image {
    width: 100%;
    height: auto;
    opacity: 0.8;
    transition: opacity 0.3s ease-in-out; 
  }

  .event-box:hover .event-image {
    opacity: 1; 
  }

  .event-details {
    position: absolute;
    bottom: 10px;
    left: 10px;
    color: white;
  }

  .event-details h3,
  .event-details p {
    margin: 5px 0;
  }

  .details-button {
    display: block;
    background-color: white;
    color: black;
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s, color 0.3s;
  }

  .details-button:hover {
    background-color: black;
    color: white;
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
  <li><a href="logout.php">Logout</a></li>
</ul>
</div>

<div class="search-container">
 
  <form action="search_events.php" method="GET">
    <input type="text" name="search" placeholder="Search...">
    <button type="submit">Search</button>
  </form>
</div>

<div class="page-content">
  <h2>Events</h2>
  <div class="event-list">
    <?php
    require_once('DBConnect.php');

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
  
    $sql = "SELECT * FROM events ORDER BY Date ASC";
    $result = $conn->query($sql);
   
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='event-container'>";
        echo "<div class='event-box'>";
    
        
        $imageUrl = $row["Poster"];

       
        if (!empty($imageUrl)) {
          echo "<img src='" . $imageUrl . "' alt='Event Image' class='event-image'>";
        } else {
         
          echo "<img src='default_image.jpg' alt='Default Image' class='event-image'>";
        }
    
        echo "<h3>" . $row["Event_ID"] . "</h3>";
        echo "<p>Date: " . $row["Date"] . "</p>";
        echo "<p>Name: " . $row["Name"] . "</p>";
        echo "<a href='event_template.php?event_id=" . $row["Event_ID"] . "' class='details-button'>Tap to see details</a>";
        echo "</div>";
        echo "</div>";
    }
    } else {
      echo "No events found";
    }


    $conn->close();
    ?>
  </div>
</div>

</body>
</html>
