<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once __DIR__ . '/../config/Database.php';
include_once __DIR__ . '/../models/Ticket.php';

$database = new Database();
$db = $database->connect();

$ticket = new Ticket($db);

$data = json_decode(file_get_contents("php://input"));

$ticket->id = $data->id;

$ticket->customer_name = $data->customer_name;
$ticket->customer_email = $data->customer_email;
$ticket->subject = $data->subject;
$ticket->body = $data->body;
$ticket->status = $data->status;
$ticket->priority = $data->priority;

if($ticket->update()) {
    echo json_encode(
        array('message' => 'Ticket Updated')
    );
} else {
    echo json_encode(
        array('message' => 'Ticket Not Updated')
    );
}
?>