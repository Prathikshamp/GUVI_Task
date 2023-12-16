<?php
session_start();

$host = "localhost"; // Your host
$username = "username"; // Your database username
$password = "password"; // Your database password
$dbname = "database"; // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("location: welcome.php"); // Redirect to welcome page
        } else {
            echo "Incorrect username or password";
        }
    } else {
        echo "Incorrect username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>

<h2>Login</h2>

<form method="post" action="">
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" required>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" required>
    </div>
    <div>
        <input type="submit" value="Login">
    </div>
</form>

</body>
</html