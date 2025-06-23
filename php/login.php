<?php
require 'config.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    echo "<script>alert('Both fields required!');window.location.href='../login.html';</script>";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    // Create session ID
    $session_id = bin2hex(random_bytes(16));

    // Store session data in Redis
    $redis->set("session:$session_id", json_encode([
        'name' => $user['name'],
        'email' => $user['email']
    ]));
    $redis->expire("session:$session_id", 3600); // 1 hour

    // Redirect with session ID in URL (or cookie/localStorage)
    echo "<script>
        localStorage.setItem('session_id', '$session_id');
        window.location.href = '../profile.html';
    </script>";
} else {
    echo "<script>alert('Invalid credentials!');window.location.href='../login.html';</script>";
}
?>
