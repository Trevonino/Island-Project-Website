<html>
<head>
<link rel="stylesheet" href="CSS-CustomerLoginPage.css">
</head>
<body>

<?php
session_start();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailInput = test_input($_POST["email"]);
    $passwordInput = test_input($_POST["password"]);
}

$servername = "209.106.201.103";
$username = "dbstudent14";
$password = "spicymonster10";
$dbname = "group5";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM Customer WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $emailInput, $passwordInput);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<p> You have logged in as: <br>" . $row["firstName"] . " " . $row["lastName"] . " </p>";
    $_SESSION["custId"] = $row["customerId"];
    echo "<p>" . $_SESSION["custId"] . "</p>";
  }
} else {
  echo "Invalid Username / Password";
}

$conn->close();
?>

</body>
</html>