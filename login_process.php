<?php
session_start();
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['password'])) {

            // Save user data in session
            $_SESSION['id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            // Redirect to your page
            header("Location: placeholder.php");
            exit();

        } else {

            echo "<script>
                alert('Incorrect password.');
                window.location.href='login.php';
            </script>";

        }

    } else {

        echo "<script>
            alert('No account found with that email.');
            window.location.href='login.php';
        </script>";

    }

}

mysqli_close($conn);
?>