<?php
// Establish a database connection
require_once('DBConnect.php');

$email = $_POST['email'];
$phone = $_POST['phone'];
$newPassword = $_POST['new-password'];
$confirmPassword = $_POST['confirm-password'];
echo $email;
echo $phone;

// Verify if the passwords match
if ($newPassword !== $confirmPassword) {
    echo "Passwords do not match. Please try again.";
} else {

    $sql = "SELECT User_ID FROM user WHERE Email = '$email' AND `Phone Number` = '$phone'";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // User found, fetch the User_ID
        $row = $result->fetch_assoc();
        $userID = $row['User_ID'];
        echo "User ID: $userID";
    } else {
        echo "User not found.";
    }
    $sql = "UPDATE user SET Password = '$newPassword', `Confirm Password` = '$confirmPassword' WHERE User_ID = $userID";
    
    
    if ($conn->query($sql) === TRUE) {
        header("Location: user_sign_in.html");
            exit();
    } else {
        echo "Error updating password: " . $conn->error;
    }
}

$conn->close();
?>