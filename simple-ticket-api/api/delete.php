<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once __DIR__ . '/../config/Database.php';
include_once __DIR__ . '/../models/Ticket.php';

$database = new Database();
$db = $database->connect();

$ticket = new Ticket($db);

$data = json_decode(file_get_contents("php://input"));

$ticket->id = $data->id;

if($ticket->delete()) {
    echo json_encode(
        array('message' => 'Ticket Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Ticket Not Deleted')
    );
}
?>