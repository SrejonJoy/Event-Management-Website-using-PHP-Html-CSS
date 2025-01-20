<?php
require_once('DBConnect.php');
if (
    isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['mail']) &&
    isset($_POST['phone']) && isset($_POST['pass']) && isset($_POST['cpass']) &&
    isset($_POST['hn']) && isset($_POST['rn']) && isset($_POST['city'])
) {
    $a = $_POST['fname'];
    $b = $_POST['lname'];
    $c = $_POST['mail'];
    $d = $_POST['phone'];
    $e = $_POST['pass'];
    $f = $_POST['cpass'];
    $g = $_POST['hn'];
    $h = $_POST['rn'];
    $i = $_POST['city'];

    if ($e === $f) {
        $sql = "INSERT INTO user (`First Name`, `Last Name`, Email, `Phone Number`, Password, `Confirm Password`, `House No`, `Road No`, City)
            VALUES ('$a', '$b', '$c', '$d', '$e', '$f', '$g', '$h', '$i')";
        $result = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn)) {
            header("Location: user_sign_in.html");
            exit();
        } else {
            echo "Insertion Failed";
        }
    } else {
        echo "Password and Confirm Password do not match.";
    }
}
?>