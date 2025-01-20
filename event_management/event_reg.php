<?php

session_start();

if (isset($_SESSION['userID'])) {
    $organizerID = $_SESSION['userID'];
} else {
    echo "Organizer ID not found in session.";
    exit();
}

require_once('DBConnect.php');

if (
    isset($_POST['name']) && isset($_POST['date']) && isset($_POST['location']) &&
    isset($_POST['TYPE']) && isset($_POST['title']) && isset($_POST['description']) &&
    isset($_POST['TIME']) && isset($_POST['capacity']) && isset($_POST['ticket_price']) &&
    isset($_POST['poster'])
) {
    
    $eventName = $_POST['name'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $eventType = $_POST['TYPE'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $timeSlot = $_POST['TIME'];
    $capacity = $_POST['capacity'];
    $ticketPrice = $_POST['ticket_price'];
    $poster = $_POST['poster'];

    $sqlEvent = "INSERT INTO events (`Name`, `Organizer_ID`, `Date`, `Location`, `Event Type`, `Title`, `Description`, `Time Slot`, `Capacity`, `Ticket Price`, `Poster`)
    VALUES ('$eventName', '$organizerID', '$date', '$location', '$eventType', '$title', '$description', '$timeSlot', '$capacity', '$ticketPrice', '$poster')";
    

    $resultEvent = mysqli_query($conn, $sqlEvent);

    
    if ($resultEvent) {
        
        $phoneNumber = $_POST['phone_number'];
        $password = $_POST['password']; 

        
        $sqlPayment = "INSERT INTO payment (`Organizer_ID`, `Event_Name`, `Phone Number`, `Password`,`Amount`)
        VALUES ('$organizerID', '$eventName', '$phoneNumber', '$password','$taka')";

        $resultPayment = mysqli_query($conn, $sqlPayment);

        if ($resultPayment) {
            header("Location: index_organizer.php");
            exit();
        } else {
            echo "Payment Insertion Failed";
        }
    } else {
        echo "Event Insertion Failed";
    }
} else {

    header("Location: event_reg.html");
    exit();
}
?>
