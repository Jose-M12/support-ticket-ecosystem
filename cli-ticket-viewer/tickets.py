import requests
import argparse

API_URL = "http://localhost:8080/api"

def list_tickets(status=None):
    url = f"{API_URL}/read.php"
    if status:
        url += f"?status={status}"
    response = requests.get(url)
    if response.status_code == 200:
        tickets = response.json().get('data', [])
        if tickets:
            print(f"{ 'ID':<5} {'Subject':<30} {'Customer':<20} {'Status':<15} {'Priority':<10}")
            print("-"*90)
            for ticket in tickets:
                print(f"{ticket['id']:<5} {ticket['subject']:<30} {ticket['customer_name']:<20} {ticket['status']:<15} {ticket['priority']:<10}")
        else:
            print("No tickets found.")
    else:
        print(f"Error: {response.status_code}")

def view_ticket(id):
    url = f"{API_URL}/read_single.php?id={id}"
    response = requests.get(url)
    if response.status_code == 200:
        ticket = response.json()
        print(f"ID: {ticket['id']}")
        print(f"Subject: {ticket['subject']}")
        print(f"Customer: {ticket['customer_name']} ({ticket['customer_email']})")
        print(f"Status: {ticket['status']}")
        print(f"Priority: {ticket['priority']}")
        print(f"Body:\n{ticket['body']}")
    else:
        print(f"Error: {response.status_code}")

def create_ticket(name, email, subject, body):
    url = f"{API_URL}/create.php"
    payload = {
        'customer_name': name,
        'customer_email': email,
        'subject': subject,
        'body': body,
        'priority': 'Medium'
    }
    response = requests.post(url, json=payload)
    if response.status_code == 200:
        print("Ticket created successfully.")
    else:
        print(f"Error: {response.status_code} - {response.text}")

if __name__ == "__main__":
    parser = argparse.ArgumentParser(description="CLI for interacting with the Support Ticket API.")
    subparsers = parser.add_subparsers(dest="command")

    list_parser = subparsers.add_parser('list', help='List all tickets')
    list_parser.add_argument('--status', help='Filter by status')

    view_parser = subparsers.add_parser('view', help='View a single ticket')
    view_parser.add_argument('id', type=int, help='The ID of the ticket to view')

    create_parser = subparsers.add_parser('create', help='Create a new ticket')
    create_parser.add_argument('--name', required=True, help='Customer name')
    create_parser.add_argument('--email', required=True, help='Customer email')
    create_parser.add_argument('--subject', required=True, help='Ticket subject')
    create_parser.add_argument('--body', required=True, help='Ticket body')

    args = parser.parse_args()

    if args.command == 'list':
        list_tickets(args.status)
    elif args.command == 'view':
        view_ticket(args.id)
    elif args.command == 'create':
        create_ticket(args.name, args.email, args.subject, args.body)
    else:
        parser.print_help()