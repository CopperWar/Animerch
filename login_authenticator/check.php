<?php
// Assuming you have already established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "authenticator";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the email and password from the submitted form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute a SELECT query to check if the email exists and the password matches
    $stmt = $conn->prepare('SELECT COUNT(*) FROM users WHERE email = :email AND password = :password');
    $stmt->execute(['email' => $email, 'password' => $password]);

    // Fetch the result
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // Email and password match in the database
        echo 'Email and password match.';
    } else {
        // Email and password do not match in the database
        echo '<script src="error.js"></script>
              <script>
                showAlert();
              </script>';
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
