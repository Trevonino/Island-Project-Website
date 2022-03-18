<html>  
<head>
<link rel="stylesheet" href="CSS-AdminPageLogin.css">
</head>

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

$stmt = $conn->prepare("SELECT * FROM Employee WHERE email = ? AND password = ? AND isAdmin = 1");
$stmt->bind_param("ss", $emailInput, $passwordInput);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<p> You have logged in as: <br>" . $row["firstName"] . " " . $row["lastName"] . " </p>";
    $_SESSION["adminId"] = $row["employeeId"];
    echo "<p>EmployeeId: " . $_SESSION["adminId"] . "</p>";
    echo '<input type="button" value="Add Item" id="addItemButton" class="logInButton" onclick="location.href=' . "'AdminAddItemPage.php';" . '">';
  }
} else {
  echo "Invalid Username / Password";
}

$conn->close();
?>

</body>
</html>

<body>