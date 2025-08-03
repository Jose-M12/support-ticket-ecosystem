# CLI Ticket Viewer

A command-line interface (CLI) tool written in Python to interact with the Simple Support Ticket API. This tool demonstrates proficiency with command-line applications and REST API consumption.

## Features
- List all tickets or filter by status.
- View the details of a specific ticket.
- Create a new ticket directly from the terminal.

## Prerequisites
- Python 3
- `requests` library (`pip install requests`)
- The "Simple Support Ticket API" project must be running.

## Usage
**List all open tickets:**
```bash
python tickets.py list --status Open

```

**View ticket with ID 1:**

```bash
python tickets.py view 1

```
**Create a new ticket:**
```bash
python tickets.py create --name "John Doe" --email "john@example.com" --subject "CLI Creation Test" --body "My issue is..."

```