<?php
require 'database_connection.php'; // Include DB connection
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contact_id = intval($_POST['contact_id']);
    $comment = htmlspecialchars($_POST['comment']);
    $created_by = $_SESSION['user_id']; // Assuming user is logged in and user_id is stored in session

    $stmt = $pdo->prepare("INSERT INTO notes (contact_id, comment, created_by, created_at) VALUES (?, ?, ?, NOW())");
    if ($stmt->execute([$contact_id, $comment, $created_by])) {
        echo json_encode(['success' => true, 'message' => 'Note added successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error adding note.']);
    }
}
?>
