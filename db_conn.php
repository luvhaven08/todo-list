<?php

$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "TODOLIST";

try {
  $conn = new PDO(
    "mysql:host=$sName;dbname=$db_name",
    $uName,
    $pass
  );
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed : " . $e->getMessage();
}
//user login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Check if the username exists in the database
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->execute([$username]);
  $user = $stmt->fetch();

  if ($user && password_verify($password, $user['password'])) {
    // Authentication successful, store user ID in session
    $_SESSION['user_id'] = $user['id'];
    // Redirect to the dashboard or any desired page after successful login
    header("Location: homePage.php");
    exit();
  } else {
    // User does not exist, create new user
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $hashedPassword]);

    // Get the ID of the newly created user
    $userId = $conn->lastInsertId();

    // Store user ID in session
    $_SESSION['user_id'] = $userId;

    // Redirect to the dashboard or any desired page after successful login
    header("Location: homePage.php");
    exit();
  }
}
if (isset($_POST['logout'])) {
  // Redirect to logout.php to handle the logout process
  header("Location: logout.php");
  exit();
}
?>
