<?php

$id = $_GET["id"];
include '../constants.php';
        
const conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB);
if (isset($_SESSION['user']['username'])) {

    $sql_query = $sql_query = "SELECT * from todos WHERE id=$id";
    $result = conn->query($sql_query);
    $curr_status = $result->fetch_assoc()["status"];

    $new_status;
    if ($curr_status === "completed") {
        $new_status = "pending";
    }
    else {
        $new_status = "completed";
    }
    $sql_query = "UPDATE todos
    SET status = '$new_status'
    WHERE id = $id;";
    $result = conn->query($sql_query);

    
}
header("Location:../todos.php");



?>