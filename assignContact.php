// Update assigned user or type
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contact_id = intval($_POST['contact_id']);
    $new_assigned_to = intval($_POST['assigned_to']);  // This could be dynamic based on the user action
    $new_type = $_POST['new_type'];  // Dynamic type (e.g., Sales Lead / Support)

    $stmt = $pdo->prepare("UPDATE contacts SET assigned_to = ?, type = ?, updated_at = NOW() WHERE id = ?");
    if ($stmt->execute([$new_assigned_to, $new_type, $contact_id])) {
        echo json_encode(['success' => true, 'message' => 'Contact updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating contact.']);
    }
}
