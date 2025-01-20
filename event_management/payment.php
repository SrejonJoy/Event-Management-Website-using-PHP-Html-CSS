<?php
session_start();

if (!isset($_SESSION['userID'])) {
    echo "Organizer ID not found in session.";
    exit();
}

$organizerID = $_SESSION['userID'];

require_once('DBConnect.php');

if (
    isset($_POST['name']) && isset($_POST['date']) && isset($_POST['location']) &&
    isset($_POST['TYPE']) && isset($_POST['title']) && isset($_POST['description']) &&
    isset($_POST['TIME']) && isset($_POST['capacity']) && isset($_POST['ticket_price']) &&
    isset($_POST['poster'])
) {
    $a = $_POST['name'];
    $c = $_POST['date'];
    $d = $_POST['location'];
    $e = $_POST['TYPE'];
    $f = $_POST['title'];
    $g = $_POST['description'];
    $h = $_POST['TIME'];
    $i = $_POST['capacity'];
    $j = $_POST['ticket_price'];
    $k = $_POST['poster'];

    // Calculate Taka based on the submitted data
    $ticketPrice = $_POST['ticket_price'];
    $capacity = $_POST['capacity'];
    $taka = 0.05 * $ticketPrice * $capacity;
} else {
    // Redirect to the event registration page if form fields are missing
    header("Location: event_reg.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Details</title>
</head>
<body>
    <h1>Payment Details</h1>
    <p>Taka Amount: <?php echo $taka; ?></p>

    <form action="event_reg.php" method="post">
        <input type="hidden" name="name" value="<?php echo $a; ?>">
        <input type="hidden" name="organizerID" value="<?php echo $organizerID; ?>">
        <input type="hidden" name="date" value="<?php echo $c; ?>">
        <input type="hidden" name="location" value="<?php echo $d; ?>">
        <input type="hidden" name="TYPE" value="<?php echo $e; ?>">
        <input type="hidden" name="title" value="<?php echo $f; ?>">
        <input type="hidden" name="description" value="<?php echo $g; ?>">
        <input type="hidden" name="TIME" value="<?php echo $h; ?>">
        <input type="hidden" name="capacity" value="<?php echo $i; ?>">
        <input type="hidden" name="ticket_price" value="<?php echo $j; ?>">
        <input type="hidden" name="poster" value="<?php echo $k; ?>">
        <input type="hidden" name="taka" value="<?php echo $taka; ?>">

        <label for="">Enter Number:</label>
        <input type="text" name="number" id="number">
        <label for="pin">Enter Pin:</label>
        <input type="password" name="pin" id="pin">
        

        <input type="submit" value="Pay">
    </form>
</body>
</html>
