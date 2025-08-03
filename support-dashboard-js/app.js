document.getElementById('fetchBtn').addEventListener('click', () => {
    const ticketsContainer = document.getElementById('ticketsContainer');
    ticketsContainer.innerHTML = '';

    fetch('http://localhost:8080/api/read.php?status=Open')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.data && data.data.length > 0) {
                data.data.forEach(ticket => {
                    const ticketElement = document.createElement('div');
                    ticketElement.innerHTML = `
                        <h3>${ticket.subject}</h3>
                        <p><strong>Customer:</strong> ${ticket.customer_name}</p>
                        <p><strong>Status:</strong> ${ticket.status}</p>
                        <p><strong>Priority:</strong> ${ticket.priority}</p>
                        <hr>
                    `;
                    ticketsContainer.appendChild(ticketElement);
                });
            } else {
                ticketsContainer.innerHTML = '<p>No open tickets found.</p>';
            }
        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
            ticketsContainer.innerHTML = `<p>Error loading tickets. See console for details.</p>`;
        });
});