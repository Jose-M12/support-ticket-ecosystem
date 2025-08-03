# Simple Support Dashboard

A single-page application using HTML and vanilla JavaScript to display open support tickets from the Simple Support Ticket API.

The primary purpose of this project is to demonstrate how to **troubleshoot common web application issues** using browser developer tools, a critical skill for a Technical Support Engineer.

## How it Works
Clicking the "Load Open Tickets" button triggers a JavaScript `fetch` call to the backend API and renders the results on the page.

## Troubleshooting Guide

Here are common issues that can occur and how to diagnose them:

### Scenario 1: The tickets don't load and I see a "CORS error" in the console.

**Error Message (in Console):**
`Access to fetch at 'http://localhost/simple-ticket-api/api/tickets?status=Open' from origin 'null' has been blocked by CORS policy...`

**Diagnosis:**
This is a Cross-Origin Resource Sharing (CORS) error. The browser is preventing JavaScript from one "origin" (our `file://` HTML page) from accessing resources on another origin (our `http://localhost` API) for security reasons.

**Solution:**
The fix must be applied on the **server-side (the PHP API)**. We need to tell the server that it's okay to accept requests from other origins by adding a header in our PHP scripts (e.g., in `read.php`):
```php
header("Access-Control-Allow-Origin: *");

```

### Scenario 2: The tickets don't load and I see a 404 Not Found error.

**Diagnosis:**

1. Open the Browser Developer Tools (F12) and go to the **Network** tab.
2. Click the "Load Open Tickets" button.
3. You will see a network request to your API URL in red with a status of `404`.
4. This means the URL that JavaScript is trying to call is incorrect or the Apache server isn't configured correctly with the `.htaccess` file.

**Solution:**

1. Double-check the URL string in `app.js`.
2. Ensure your local LAMP server is running and the API project is in the correct directory.
3. Verify the `.htaccess` file is working correctly.

### Scenario 3: The tickets don't load, there are no errors, but nothing appears.

**Diagnosis:**

1. Go to the **Network** tab. If the request shows a `200 OK` status, the API is working.
2. Click on the request and check the **Response** tab. Is the data valid JSON, or is it an empty array `[]`? If it's empty, there are no "Open" tickets in the database.
3. Go to the **Console** tab. Add `console.log(data)` in your `app.js` file right after you parse the JSON. This will show you exactly what data your JavaScript is receiving. The problem might be in the loop that is supposed to render the HTML.