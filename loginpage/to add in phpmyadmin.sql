<?php
include "database.php";

$fullname = $_POST['fullname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (fullname, username, email, password)
        VALUES ('$fullname', '$username', '$email', '$password')";

if (mysqli_query($conn, $sql)) {

    header("Location: login.php");
    exit();

} else {

    if (mysqli_errno($conn) == 1062) {
        echo "<script>
            alert('Username or Email already exists.');
            window.history.back();
        </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

}

mysqli_close($conn);
?>