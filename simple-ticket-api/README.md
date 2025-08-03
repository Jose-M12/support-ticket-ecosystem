# Simple Support Ticket API

This is a RESTful API built with PHP and MySQL for basic support ticket management (CRUD operations). It's designed to demonstrate an understanding of backend development with the LAMP stack.

## Features
- Create a new support ticket.
- Read (list) all tickets, with filtering by status or priority.
- Read a single ticket by its ID.
- Update the status or priority of an existing ticket.
- Delete a ticket.

## Tech Stack
- PHP 8
- MySQL
- Apache (via XAMPP/MAMP)

## Database Setup
1. Create a MySQL database named `support_db`.
2. Run the following SQL to create the `tickets` table:
   ```sql
   CREATE TABLE tickets (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    customer_email VARCHAR(100) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    status ENUM('Open', 'In Progress', 'Closed') NOT NULL DEFAULT 'Open',
    priority ENUM('Low', 'Medium', 'High') NOT NULL DEFAULT 'Medium',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

   ```

## API Endpoints

- `GET /tickets`: Get all tickets.
- `GET /tickets?status=Open`: Get all open tickets.
- `GET /tickets/{id}`: Get a single ticket.
- `POST /tickets`: Create a new ticket (provide JSON body).
- `PUT /tickets/{id}`: Update a ticket (provide JSON body).
- `DELETE /tickets/{id}`: Delete a ticket.

## Usage Example (with cURL)

**Create a Ticket:**

```bash
curl -X POST -H "Content-Type: application/json" -d '{"customer_name":"Softgic HR", "customer_email":"hr@softgic.com", "subject":"API Test", "body":"This is a test ticket."}' http://localhost/simple-ticket-api/api/tickets

```