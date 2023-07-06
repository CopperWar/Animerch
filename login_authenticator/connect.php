<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$password = $_POST['password'];
$contact = $_POST['contact'];

$conn = new mysqli('localhost', 'root', '', 'authenticator');

if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed: " . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO `users` (`first`, `last`, `gender`, `email`, `password`, `contact`) VALUES (?, ?, ?, ?, ?, ?);");

    $stmt->bind_param("ssssss", $firstname, $lastname, $gender, $email, $password, $contact);
    $execval = $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Data stored successfully, redirect to a different page
        header("Location: sucess.html");
        exit(); // Terminate the script after the redirection
    } else {
        echo "Failed to register user.";
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>
