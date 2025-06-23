<?php
require 'config.php';

$session_id = $_GET['session_id'] ?? '';
if (!$session_id || !$redis->exists("session:$session_id")) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid session']);
    exit;
}

$data = json_decode($redis->get("session:$session_id"), true);
echo json_encode(['status' => 'success', 'data' => $data]);
?>
