<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once __DIR__ . '/../config/Database.php';
include_once __DIR__ . '/../models/Ticket.php';

$database = new Database();
$db = $database->connect();

$ticket = new Ticket($db);

$data = json_decode(file_get_contents("php://input"));

$ticket->customer_name = $data->customer_name;
$ticket->customer_email = $data->customer_email;
$ticket->subject = $data->subject;
$ticket->body = $data->body;
$ticket->priority = $data->priority;

if($ticket->create()) {
    echo json_encode(
        array('message' => 'Ticket Created')
    );
} else {
    echo json_encode(
        array('message' => 'Ticket Not Created')
    );
}
?>