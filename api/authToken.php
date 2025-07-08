<?php 
require_once 'lib/JWT.php';
require_once 'lib/Key.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function verificarToken() {
    $headers = getallheaders();
    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        echo json_encode(['error' => 'Token no proporcionado']);
        exit;
    }
    
    $token = explode(' ', $headers['Authorization'])[1] ?? '';
    
    try {
        $decoded = JWT::decode($token, new Key('CLAVE_SECRETA', 'HS256'));
        return $decoded->user_id;
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['error' => 'Token inválido']);
        exit;
    }
}
if (!verificarToken()){
    http_response_code(401);
    echo json_encode(['error' => 'Token no válido']);
    exit;
}