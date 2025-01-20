<?php
// Establish a database connection
require_once('DBConnect.php');

// Get form data
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
    // Update the password in the database (without hashing)
    $sql = "SELECT Organizer_Id FROM organizer_reg WHERE Email = '$email' AND `Phone Number` = '$phone'";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // User found, fetch the User_ID
        $row = $result->fetch_assoc();
        $userID = $row['Organizer_Id'];
        echo "Organizer Id: $userID";
    } else {
        echo "Organizer not found.";
    }
    $sql = "UPDATE organizer_reg SET Password = '$newPassword', `Confirm Password` = '$confirmPassword' WHERE Organizer_Id = $userID";
    
    
    if ($conn->query($sql) === TRUE) {
        header("Location: organizer_sign_in.html");
            exit();
    } else {
        echo "Error updating password: " . $conn->error;
    }
}

$conn->close();
?>