<?php
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "apartmentfinding");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM recomendationTable WHERE 1=1";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $requestData = json_decode(file_get_contents("php://input"), true);

    $squareFit = isset($requestData["squareFit"]) ? intval($requestData["squareFit"]) : null;

    if (!is_null($squareFit)) {
        $sql .= " AND squarefit >= $squareFit";
    }
}

$result = $conn->query($sql);
$apartments = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $apartments[] = $row;
    }
}

$conn->close();

echo json_encode($apartments);
?>
