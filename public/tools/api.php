<?php
/**
 * Simple API for AJAX testing
 * This file handles various AJAX requests for testing purposes
 * 
 * IMPORTANT: This is a TESTING/DEVELOPMENT API
 * For production use, implement:
 * - Input validation and sanitization
 * - Rate limiting
 * - Authentication/Authorization
 * - Comprehensive error handling
 * - Logging and monitoring
 */

header('Content-Type: application/json');

// CORS Configuration
// For testing/development: Allow localhost and common local addresses
// For production: Update $allowedOrigins to include your actual domain(s)
// Example: $allowedOrigins = ['https://yourdomain.com', 'https://www.yourdomain.com'];
$allowedOrigins = [
    'http://localhost:8000',
    'http://127.0.0.1:8000',
    'http://localhost',
    'http://127.0.0.1'
];

// Add server name if available
if (isset($_SERVER['HTTP_HOST'])) {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $allowedOrigins[] = $protocol . '://' . $_SERVER['HTTP_HOST'];
}

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
if (in_array($origin, $allowedOrigins)) {
    header("Access-Control-Allow-Origin: $origin");
}
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

// Get request method
$method = $_SERVER['REQUEST_METHOD'];

// Route handler
switch ($method) {
    case 'GET':
        handleGet();
        break;
    case 'POST':
        handlePost();
        break;
    case 'PUT':
        handlePut();
        break;
    case 'DELETE':
        handleDelete();
        break;
    default:
        sendResponse(405, 'Method not allowed');
}

function handleGet() {
    $action = $_GET['action'] ?? 'default';
    
    switch ($action) {
        case 'users':
            sendResponse(200, 'Success', [
                'users' => [
                    ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
                    ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com'],
                    ['id' => 3, 'name' => 'Bob Johnson', 'email' => 'bob@example.com']
                ]
            ]);
            break;
            
        case 'time':
            sendResponse(200, 'Success', [
                'timestamp' => time(),
                'datetime' => date('Y-m-d H:i:s'),
                'timezone' => date_default_timezone_get()
            ]);
            break;
            
        default:
            sendResponse(200, 'API is working', [
                'version' => '1.0',
                'endpoints' => ['users', 'time']
            ]);
    }
}

function handlePost() {
    // Note: For production, implement input validation, sanitization, and rate limiting
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!$data) {
        $data = $_POST;
    }
    
    // For production: Add validation here
    // Example: if (!validateInput($data)) { sendResponse(400, 'Invalid input'); }
    
    sendResponse(200, 'POST request received', [
        'received_data' => $data,
        'timestamp' => date('Y-m-d H:i:s')
    ]);
}

function handlePut() {
    $data = json_decode(file_get_contents('php://input'), true);
    
    sendResponse(200, 'PUT request received', [
        'updated_data' => $data,
        'timestamp' => date('Y-m-d H:i:s')
    ]);
}

function handleDelete() {
    $id = $_GET['id'] ?? null;
    
    sendResponse(200, 'DELETE request received', [
        'deleted_id' => $id,
        'timestamp' => date('Y-m-d H:i:s')
    ]);
}

function sendResponse($status, $message, $data = null) {
    http_response_code($status);
    
    $response = [
        'status' => $status,
        'message' => $message
    ];
    
    if ($data !== null) {
        $response['data'] = $data;
    }
    
    echo json_encode($response, JSON_PRETTY_PRINT);
    exit;
}
?>
