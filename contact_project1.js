// Fetch contact details and display them
function loadContactDetails(contactId) {
    fetch(`view_contact.php?contact_id=${contactId}`)
        .then(response => response.json())
        .then(data => {
            const contact = data.contact;
            const notes = data.notes;
            const details = `
                <p><strong>Full Name:</strong> ${contact.title} ${contact.firstname} ${contact.lastname}</p>
                <p><strong>Email:</strong> ${contact.email}</p>
                <p><strong>Company:</strong> ${contact.company}</p>
                <p><strong>Telephone:</strong> ${contact.telephone}</p>
                <p><strong>Type:</strong> ${contact.type}</p>
                <p><strong>Assigned To:</strong> ${contact.assigned_firstname} ${contact.assigned_lastname}</p>
                <button onclick="assignToMe(${contact.id})">Assign to Me</button>
                <button onclick="toggleType(${contact.id}, '${contact.type}')">Switch Type</button>
            `;
            document.getElementById('contactDetails').innerHTML = details;

            const notesList = notes.map(note => `
                <li>${note.comment} by ${note.firstname} ${note.lastname} on ${note.created_at}</li>
            `).join('');
            document.getElementById('notesList').innerHTML = notesList;
        });
}

// Add a note to the contact
document.getElementById('addNoteForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const comment = document.getElementById('noteComment').value;
    const contactId = 1;  // Example: should be dynamic
    fetch('add_note.php', {
        method: 'POST',
        body: new URLSearchParams({
            'contact_id': contactId,
            'comment': comment
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadContactDetails(contactId);  // Reload the contact details
        }
    });
});
