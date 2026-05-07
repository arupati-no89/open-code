<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'POST only']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$message = trim($input['message'] ?? '');
$history = $input['history'] ?? [];

if ($message === '') {
    http_response_code(400);
    echo json_encode(['error' => 'message is required']);
    exit;
}

$systemPrompt = <<<PROMPT
あなたはWebマーダーミステリーのゲームマスターです。
- 序盤は犯人名を断定しない
- プレイヤーの推理を促すヒントを短く返す
- ネタバレは避ける
PROMPT;

$messages = [['role' => 'system', 'content' => $systemPrompt]];
foreach ($history as $turn) {
    if (!isset($turn['role'], $turn['content'])) {
        continue;
    }
    $role = $turn['role'];
    if (!in_array($role, ['user', 'assistant'], true)) {
        continue;
    }
    $messages[] = ['role' => $role, 'content' => (string)$turn['content']];
}
$messages[] = ['role' => 'user', 'content' => $message];

$payload = json_encode([
    'model' => 'gemma3:4b',
    'messages' => $messages,
    'stream' => false,
], JSON_UNESCAPED_UNICODE);

$ch = curl_init('http://127.0.0.1:11434/api/chat');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_POSTFIELDS => $payload,
    CURLOPT_TIMEOUT => 60,
]);

$response = curl_exec($ch);
$curlErr = curl_error($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($response === false) {
    http_response_code(502);
    echo json_encode(['error' => 'Ollama接続失敗: ' . $curlErr]);
    exit;
}

$data = json_decode($response, true);
if ($httpCode >= 400) {
    http_response_code($httpCode);
    echo json_encode(['error' => $data['error'] ?? 'Ollama error']);
    exit;
}

$reply = $data['message']['content'] ?? null;
if (!$reply) {
    http_response_code(500);
    echo json_encode(['error' => 'LLM応答の解析に失敗']);
    exit;
}

echo json_encode(['reply' => $reply], JSON_UNESCAPED_UNICODE);
