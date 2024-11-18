<?php

$conn = new mysqli("localhost", "root", "", "luxe");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cusFname = $_POST['cusFname'];
    $cusLname = $_POST['cusLname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    
    if ($password != $confirm_password) {
        echo "Passwords do not match!";
    } else {
       
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        
        $query = "INSERT INTO customer (cusFname,cusLname,phone,cusEmail, password) 
        VALUES ('$cusFname','$cusLname','$phone','$email', '$hashed_password')";

        if ($conn->query($query) === TRUE) {
            echo "Registration successful!";
            header('Location: ../appointment.php');
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Luxe Designs</title>
    <link rel="stylesheet" href="body.css">
</head>
<body>
    <h2>Sign Up</h2>
    <form action="signup.php" method="POST">
    <label for="cusFname">First Name:</label>
        <input type="text" name="cusFname" required>
        <br><br>
        <label for="cusLname">Last Name:</label>
        <input type="text" name="cusLname" required>
        <br><br>
        <label for="phone">Phone Number:</label>
        <input type="text" name="phone" required>
        <br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br><br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" required>
        
        <button type="submit">Sign Up</button>
    </form>
    <p>Already have an account? <a href="login.php">Log in</a></p>
</body>
</html>
