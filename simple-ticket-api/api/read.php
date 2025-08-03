<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once __DIR__ . '/../config/Database.php';
include_once __DIR__ . '/../models/Ticket.php';

$database = new Database();
$db = $database->connect();

$ticket = new Ticket($db);

$result = $ticket->read();
$num = $result->rowCount();

if($num > 0) {
    $tickets_arr = array();
    $tickets_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $ticket_item = array(
            'id' => $id,
            'customer_name' => $customer_name,
            'customer_email' => $customer_email,
            'subject' => $subject,
            'body' => html_entity_decode($body),
            'status' => $status,
            'priority' => $priority
        );

        array_push($tickets_arr['data'], $ticket_item);
    }

    echo json_encode($tickets_arr);
} else {
    echo json_encode(
        array('message' => 'No Tickets Found')
    );
}
?>