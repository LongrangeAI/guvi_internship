<?php
header('Content-Type: application/json');
require 'config.php';

$token = $_POST['session_token'];
if ($redis->del($token)) {
    echo json_encode(['status' => 'success', 'message' => 'Logged out']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Token not found']);
}
?>
