<?php

session_start();
require_once('DBConnect.php');



if (isset($_POST['mail']) && isset($_POST['password'])) {
    $u = $_POST['mail'];
    $p = $_POST['password'];
    $sql = "SELECT * from organizer_reg WHERE Email='$u' AND Password='$p'";
    
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) != 0) {
        
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['First Name']; 
        $_SESSION['userID'] = $row['Organizer_Id']; 
        header("Location: index_organizer.php");
        exit();
    } else {
        echo "Email or Password is wrong";
    }
    
}
?>
<!DOCTYPE html>
<html>
<head>
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
    
    .slider {
      width: 80%; 
      max-width: 800px; 
      margin: 20px auto; 
      overflow: hidden;
      position: relative;
    }

    .slider {
      width: 80%; 
      max-width: 800px; 
      margin: 20px auto; 
      overflow: hidden;
      position: relative;
    }

    .slides {
      display: flex;
      transition: transform 0.5s ease-in-out;
    }

    .slide {
      min-width: 100%; 
    }

    .slide img {
      width: 100%;
      height: auto;
    }

    .navigation {
      position: absolute;
      bottom: 10px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
    }

    .navigation label {
      cursor: pointer;
      border-radius: 50%;
      border: 1px solid #333;
      width: 10px;
      height: 10px;
      margin: 0 5px;
      background-color: #fff;
    }
    .who-we-are p {
        font-size: 16px;
        font-family: 'Arial', sans-serif; 
        animation: fadeInText 1.5s ease-in-out; 
        margin-bottom: 10px; 
        text-align: justify; 
    }
    .who-we-are h2 {
        font-size: 24px;
        text-align:center 
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
    
    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }
    #slide1:checked ~ .slides { transform: translateX(0%); }
    #slide2:checked ~ .slides { transform: translateX(-100%); }
    #slide3:checked ~ .slides { transform: translateX(-200%); }
    #slide4:checked ~ .slides { transform: translateX(-300%); }
    #slide5:checked ~ .slides { transform: translateX(-400%); }
    #slide6:checked ~ .slides { transform: translateX(-500%); }
    #slide7:checked ~ .slides { transform: translateX(-600%); }
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
</div>
<div class="page-content">
    
    <div class="slider">
        
        <input type="radio" name="slider" id="slide1" checked>
        <input type="radio" name="slider" id="slide2">
        <input type="radio" name="slider" id="slide3">
        <input type="radio" name="slider" id="slide4">
        <input type="radio" name="slider" id="slide5">
        <input type="radio" name="slider" id="slide6">
        <input type="radio" name="slider" id="slide7">
        

        <div class="slides">
            
            <div class="slide">
                <img src="1.png" alt="Landscape 1">
            </div>
            <div class="slide">
                <img src="2.png" alt="Landscape 2">
            </div>
            <div class="slide">
                <img src="3.png" alt="Landscape 3">
            </div>
            <div class="slide">
                <img src="4.png" alt="Landscape 4">
            </div>
            <div class="slide">
                <img src="5.png" alt="Landscape 5">
            </div>
            <div class="slide">
                <img src="6.png" alt="Landscape 6">
            </div>
            <div class="slide">
                <img src="7.png" alt="Landscape 7">
            </div>
            
        </div>

        <!-- Navigation for slides -->
        <div class="navigation">
            <label for="slide1"></label>
            <label for="slide2"></label>
            <label for="slide3"></label>
            <label for="slide4"></label>
            <label for="slide5"></label>
            <label for="slide6"></label>
            <label for="slide7"></label>
            
        </div>
    </div>
    <section id="who-we-are" class="who-we-are">
        <h2>Who We Are</h2>
        <p>Split Event Planner is an event management business in Bangladesh that has the ideal balance of enthusiasm and expertise. We've established ourselves as a business with concepts to make your business or private occasion unforgettable. We offer our services for most corporate events, including but not limited to conferences, seminars, trade shows, cultural events, company or organization milestones, exhibitions, product launches, concerts, annual meetings of the company, corporate picnics, fashion shows, and appreciation events, with the assistance of our creative team. Additionally, we'll work hard to make your birthday celebrations, wedding, and other special occasions very memorable.</p>

        <p>Bangladesh, centered in Dhaka, has emerged as a marvel to many due to its remarkable economic progress over the last ten years or so. Businesses of all kinds, organizations, and companies have emerged as the nation's main engine for economic growth. Event management services, whether they corporate or personal, are growing more and more popular in Dhaka, Chittagong, Cox's Bazar, and across Bangladesh. As an event management firm, Split Event Planner feels that it is our duty to provide our customers with services that are dependable, creative, and trustworthy. We want the events that we get to oversee for you to stick in your memory. We love combining the hottest themes and trends for your events. Since there are a lot of events taking place in Dhaka and around Bangladesh, we think it's critical that, as our customer, your activities stand out.</p>

        <p>An event is a chance to showcase your work in a favorable light and encourage others to behave in a constructive manner. In order to provide every guest an immersive experience, Split Event Planner assists you in exceeding your event's planned goals. We begin by getting to know you and your goals for the occasion. This lets us customize your event so that everyone who attends has the greatest possible experience.</p>
    </section>
    <div class="header">
    <div class="user-info">
      <?php
      if (isset($_SESSION['username']) && isset($_SESSION['userID'])) {
        $userName = $_SESSION['username'];
        $userID = $_SESSION['userID'];
        
        echo "Welcome, $userName (ID: $userID)";
      } else {
          header("Location: user_sign_in.html");
          exit();
      }
      ?>
  </div></div>
</div>

</div>
</body>
</html>