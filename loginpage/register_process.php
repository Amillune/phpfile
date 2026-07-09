<?php
include "database.php";

$fullname = $_POST['fullname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

/* Check Username */
$checkUsername = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE username='$username'"
);

if (mysqli_num_rows($checkUsername) > 0) {

    echo "<script>
        alert('Username is already taken. Please choose another username.');
        window.location.href='register.php';
    </script>";
    exit();
}

/* Check Email */
$checkEmail = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE email='$email'"
);

if (mysqli_num_rows($checkEmail) > 0) {

    echo "<script>
        alert('Email is already registered. Please use another email.');
        window.location.href='register.php';
    </script>";
    exit();
}

/* Insert User */
$sql = "INSERT INTO users(fullname, username, email, password)
        VALUES('$fullname', '$username', '$email', '$password')";

if (mysqli_query($conn, $sql)) {

    echo "<script>
        alert('Account created successfully!');
        window.location.href='login.php';
    </script>";

} else {

    echo "<script>
        alert('Registration failed.');
        window.location.href='register.php';
    </script>";

}

mysqli_close($conn);
?>