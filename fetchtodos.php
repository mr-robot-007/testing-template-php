<?php
include 'config/constants.php';

// Establish database connection
$conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data
$sql_query = "SELECT * FROM todos";

// Execute query
$result = $conn->query($sql_query);

$data = array();

if ($result->num_rows > 0) {
    // Store data in an array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Encode the data to JSON format
$json_data = json_encode($data);

// Print or echo the JSON data
echo $json_data;

// Close the database connection
$conn->close();
?>