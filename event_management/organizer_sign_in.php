<?php

require_once('DBConnect.php');


session_start();

if (isset($_POST['mail']) && isset($_POST['password'])) {
    $u = $_POST['mail'];
    $p = $_POST['password'];
    $sql = "SELECT * from organizer_reg WHERE Email='$u' AND Password='$p'";
    
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) != 0) {
        
        $user = mysqli_fetch_assoc($result);

        
        $_SESSION['username'] = $user['First Name']; 
        $_SESSION['userID'] = $user['Organizer_Id']; 

        
        header("Location: index_organizer.php");
        exit();
    } else {
        echo "Email or Password is wrong";
    }
}
?>
