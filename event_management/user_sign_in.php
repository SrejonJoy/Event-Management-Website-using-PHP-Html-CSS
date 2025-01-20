<?php
// Connecting to the database
require_once('DBConnect.php');

// Starting the session
session_start();

if (isset($_POST['mail']) && isset($_POST['password'])) {
    $u = $_POST['mail'];
    $p = $_POST['password'];
    $sql = "SELECT * from user WHERE Email='$u' AND Password='$p'";
    
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) != 0) {
        
        $user = mysqli_fetch_assoc($result);

        // Storing user details in session variables
        $_SESSION['username'] = $user['First Name'];
        $_SESSION['userID'] = $user['User_Id']; 

        header("Location: index.php");
        exit();
    } else {
        echo "Email or Password is wrong";
    }
}
?>
