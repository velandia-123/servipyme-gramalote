<?php
// helpers.php - versión compatible y robusta
// Reemplaza tu helpers.php con este para evitar errores por versión de PHP
// No debe imprimir nada, ni espacios antes de <?php

function secure_session_start(){
    if (session_status() === PHP_SESSION_NONE) {
        // Detectar HTTPS
        $secure = false;
        if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') $secure = true;
        if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) $secure = true;

        // Parámetros actuales de cookie
        $cookieParams = session_get_cookie_params();

        // Compatibilidad: PHP 7.3+ acepta array en session_set_cookie_params
        if (defined('PHP_VERSION_ID') && PHP_VERSION_ID >= 70300) {
            session_set_cookie_params([
                'lifetime' => $cookieParams['lifetime'],
                'path'     => $cookieParams['path'],
                'domain'   => $cookieParams['domain'],
                'secure'   => $secure,
                'httponly' => true,
                'samesite' => 'Lax'
            ]);
        } else {
            // Fallback para PHP < 7.3 (no tiene opción explicit samesite)
            // Añadimos samesite en el path (truco común)
            $path = $cookieParams['path'];
            // Evitar duplicar si ya contiene samesite
            if (stripos($path, 'samesite=') === false) {
                $path = $path . '; samesite=Lax';
            }
            session_set_cookie_params(
                $cookieParams['lifetime'],
                $path,
                $cookieParams['domain'],
                $secure,
                true // httponly
            );
        }

        // Iniciar sesión — asegurarse de no haber enviado headers
        if (!headers_sent()) {
            session_start();
        } else {
            // Si headers ya se enviaron (no debería), intentar usar output buffering
            @ob_start();
            session_start();
            @ob_end_flush();
        }
    }
}

// Generar token CSRF y guardarlo en $_SESSION
function generate_csrf_token(){
    secure_session_start();
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Verificar token CSRF de forma segura
function verify_csrf_token($token){
    secure_session_start();
    if (empty($_SESSION['csrf_token']) || empty($token)) return false;
    return hash_equals($_SESSION['csrf_token'], $token);
}

// Escapar salidas a HTML
function esc($s){
    return htmlspecialchars($s ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// Util: comprobar si la sesión está activa (para debug)
function session_active(){
    return session_status() === PHP_SESSION_ACTIVE;
}
?>
