<html>
<head>
<link rel="stylesheet" href="CSS-Searches.css">
</head>
<body>

<div id="logo-Container">
    <img src="The Island Project Logo (Transparent).png" alt="The Island Project" id="IslandProjectLogo">
</div>    

<div id='searchResults-Container'>
<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchbarInput = test_input($_POST["searchbar"]);
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

$stmt = $conn->prepare("SELECT * FROM Product WHERE UPPER(productType) LIKE CONCAT(UPPER(?), '%') UNION SELECT * FROM Product WHERE UPPER(name) LIKE CONCAT('%', UPPER(?), '%')");
$stmt->bind_param("ss", $searchbarInput, $searchbarInput);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<p class='searchResult'> " . $row["name"] . " " . $row["cost"] . " </p>";
  }
} else {
  echo "No Results";
}

$conn->close();
?>
</div>
</body>
</html>