<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once __DIR__ . '/../config/Database.php';
include_once __DIR__ . '/../models/Ticket.php';

$database = new Database();
$db = $database->connect();

$ticket = new Ticket($db);

$ticket->id = isset($_GET['id']) ? $_GET['id'] : die();

$ticket->read_single();

$ticket_arr = array(
    'id' => $ticket->id,
    'customer_name' => $ticket->customer_name,
    'customer_email' => $ticket->customer_email,
    'subject' => $ticket->subject,
    'body' => $ticket->body,
    'status' => $ticket->status,
    'priority' => $ticket->priority
);

print_r(json_encode($ticket_arr));
?>