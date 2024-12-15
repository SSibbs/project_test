<?php
$host = 'localhost';
$username = 'project_user';
$password = 'password123';
$dbname = 'dolphin_crm';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $telephone = htmlspecialchars($_POST['telephone']);
    $company = htmlspecialchars($_POST['company']);
    $type = htmlspecialchars($_POST['type']);
    $assigned_to = intval($_POST['assigned_to']);
    $created_by = $_SESSION['user_id']; 

    if ($email && $firstname && $lastname) { 
        $stmt = $pdo->prepare("INSERT INTO contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
        if ($stmt->execute([$title, $firstname, $lastname, $email, $telephone, $company, $type, $assigned_to, $created_by])) {
            echo json_encode(['success' => true, 'message' => 'Contact created successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error creating contact.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input data.']);
    }
}
?>
