
<?php

session_start();

if (isset($_POST['mail']) && isset($_POST['password'])) {
    $u = $_POST['mail'];
    $p = $_POST['password'];
    $sql = "SELECT * from user WHERE Email='$u' AND Password='$p'";
    
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) != 0) {
        // Save username and user ID in session variables
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
<!-- Page content -->
<?php
    echo "Ticket quantity :" . $_POST['ticket_quantity']."<br/>";
    echo "Organizer ID :" .$_POST['organizer_id']."<br/>";
    echo "Event ID :" .$_POST['event_id']."<br/>";
    echo "Ticket Price:".$_POST['ticket_price']."<br/>";
    $price=$_POST['ticket_price'];
    $ticketQuantity = intval($_POST['ticket_quantity']);
    $total=$ticketQuantity*$price;
  

    echo "<form method='POST' action='ticket3.php'>"; 
    
    
    for ($i = 1; $i <= $ticketQuantity; $i++) {
        echo "
        <fieldset>
            <legend>Ticket $i</legend>
            <input type='hidden' name='user_id[]' value='{$_SESSION['userID']}'> <!-- Assuming you have the user ID in the session -->
            <input type='hidden' name='event_id[]' value='{$_POST['event_id']}'>
            <input type='hidden' name='organizer_id[]' value='{$_POST['organizer_id']}'>
            <input type='hidden' name='ticket_quantity' value='{$_POST['ticket_quantity']}'>
            <input type= name='ticket_no[]' value='$i'> <!-- Ticket number -->
            
            <label for='participant_name_$i'>Participant Name:</label>
            <input type='text' name='participant_name[]' id='participant_name_$i'><br>
    
            <label for='age_$i'>Age:</label>
            <input type='text' name='age[]' id='age_$i'><br>
    
            <label for='phone_number_$i'>Phone Number:</label>
            <input type='text' name='phone_number[]' id='phone_number_$i'><br>
        </fieldset>
        ";
    }
    ?>
    <br></br>
    <label id="1" for="Bkashnumber">Enter your Bkash Number</label>
    <input type="text" id="Bkash" name="number" placeholder="01700000000">
    <label for="Taka" id="2">Amount to pay:</label>
    <input type="text" id="amount" name="amount" value="<?php echo $total; ?>" readonly>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" placeholder="Enter password">
    <input type="submit" value="Submit">
    <br></br>
    <br></br>
</form>


