# Full Stack Support Ticket Ecosystem

This repository contains a mini-ecosystem of three interconnected projects designed to demonstrate a comprehensive skill set in backend development (PHP/MySQL), command-line tooling (Python), and front-end web development (Vanilla JavaScript), all centered around a support ticketing system.

## Project Overview

1.  **Simple Support Ticket API (PHP/MySQL):** The backend RESTful API providing CRUD operations for support tickets.
2.  **CLI Ticket Viewer (Python):** A command-line interface tool to interact with the API.
3.  **Support Dashboard (Vanilla JavaScript):** A simple web-based dashboard to display open tickets from the API, with a focus on troubleshooting common web issues.

## Technologies Used

*   **Backend:** PHP 8, MySQL, Apache
*   **Containerization:** Docker, Docker Compose
*   **CLI:** Python 3 (`requests`, `argparse`)
*   **Frontend:** HTML5, Vanilla JavaScript (`fetch` API)
*   **Version Control:** Git

## Getting Started Locally (using Docker Desktop)

This project is designed to be easily run locally using Docker Desktop, which provides a consistent environment for the PHP/MySQL API.

### Prerequisites

*   **Docker Desktop:** Ensure Docker Desktop is installed and running on your Windows machine. Make sure **WSL Integration** is enabled for your Linux distribution (e.g., Debian) in Docker Desktop settings (`Settings > Resources > WSL Integration`).
*   **WSL (Windows Subsystem for Linux):** You should be working within your WSL terminal (e.g., Debian via VS Code).
*   **Python 3 and pip:** Ensure Python 3 and `pip` (or `pip3`) are installed in your WSL environment. If `pip` is missing or you encounter `externally-managed-environment` errors, you might need to install `python3-pip` and `python3-requests` via `sudo apt-get install -y python3-pip python3-requests`.

### Step-by-Step Setup

1.  **Clone the Repository:**
    Open your WSL terminal and clone this entire repository:
    ```bash
    git clone https://github.com/Jose-M12/support-ticket-ecosystem.git
    cd support-ticket-ecosystem
    ```

2.  **Start Docker Containers (API & Database):**
    Navigate to the root of the cloned repository (where `docker-compose.yml` is located) and start the services:
    ```bash
    docker-compose up -d
    ```
    This will download the necessary Docker images (MySQL 5.7, PHP 8.0-Apache) and start two containers: `mysql_db` (for the database) and `php_apache_web` (for the API). The API will be accessible on `http://localhost:8080`.

3.  **Initialize the Database Schema:**
    The MySQL database container is running, but the `tickets` table needs to be created. Execute the following command from the root of the repository:
    ```bash
    docker exec -i mysql_db mysql -uroot -prootpassword support_db < db_schema.sql
    ```
    This command connects to the `mysql_db` container and runs the SQL commands from `db_schema.sql` to create the `tickets` table.

### Interacting with the Projects

#### **A. Simple Support Ticket API (Backend)**

Your API is now running at `http://localhost:8080/simple-ticket-api/api/`. You can test it using `curl` from your WSL terminal:

*   **Create a Ticket:**
    ```bash
    curl -X POST -H "Content-Type: application/json" -d '{"customer_name":"John Doe", "customer_email":"john@example.com", "subject":"API Test Ticket", "body":"This is a test ticket created via curl.", "priority":"Medium"}' http://localhost:8080/simple-ticket-api/api/create.php
    ```

*   **List All Tickets:**
    ```bash
    curl http://localhost:8080/simple-ticket-api/api/read.php
    ```

*   **Get a Single Ticket (replace `1` with an actual ID):**
    ```bash
    curl http://localhost:8080/simple-ticket-api/api/read_single.php?id=1
    ```

#### **B. CLI Ticket Viewer (Python)**

Navigate to the `cli-ticket-viewer` directory:

```bash
cd cli-ticket-viewer
```

Then, you can use the `tickets.py` script:

*   **Create a Ticket:**
    ```bash
    python3 tickets.py create --name "Jane Smith" --email "jane@example.com" --subject "CLI Created Ticket" --body "This ticket was created using the Python CLI." --priority "High"
    ```

*   **List All Tickets:**
    ```bash
    python3 tickets.py list
    ```

*   **List Open Tickets:**
    ```bash
    python3 tickets.py list --status Open
    ```

*   **View a Single Ticket (replace `1` with an actual ID):**
    ```bash
    python3 tickets.py view 1
    ```

*   **Update a Ticket (replace `<ID>` with an actual ID, provide all fields):**
    ```bash
    python3 tickets.py update <ID> --name "New Name" --email "new@example.com" --subject "Updated Subject" --body "Updated body content." --status "Closed" --priority "High"
    ```

*   **Delete a Ticket (replace `<ID>` with an actual ID):**
    ```bash
    python3 tickets.py delete <ID>
    ```

#### **C. Support Dashboard (Vanilla JavaScript)**

1.  Open your web browser (on Windows).
2.  Navigate to the `support-dashboard-js` directory within your cloned repository.
3.  Double-click the `index.html` file to open it in your browser.
4.  Click the "Load Open Tickets" button.

    You should see the tickets fetched from your running API displayed on the page.

## Potential Online Deployment Alternatives

While this project is set up for local Docker deployment, here are some free/low-cost options for deploying parts of it online:

*   **For the PHP/MySQL API:**
    *   **Heroku (with ClearDB MySQL Add-on):** Heroku offers a free tier for web apps, and ClearDB provides a free MySQL database add-on. You would need to configure your PHP app to connect to the ClearDB database using environment variables.
    *   **Render.com:** Offers free tiers for web services and databases. Similar setup to Heroku.
    *   **Free Web Hosting with PHP/MySQL Support:** Many providers offer basic free hosting plans that support PHP and MySQL, though they might have limitations on resources or traffic.

*   **For the Support Dashboard (Frontend):**
    *   **GitHub Pages:** Since it's a static HTML/JS site, you can easily host it on GitHub Pages directly from your repository.
    *   **Netlify / Vercel:** Both offer generous free tiers for hosting static sites. You would connect your GitHub repository, and they would automatically deploy your `support-dashboard-js` folder.

**Important Note for Online Deployment:** If you deploy the frontend and backend separately, you will need to ensure your PHP API has the correct `Access-Control-Allow-Origin` header set to allow requests from your deployed frontend's domain. You would replace `*` with the specific domain (e.g., `https://your-dashboard.netlify.app`).

## Contributing

Feel free to fork this repository, experiment, and improve upon it!
