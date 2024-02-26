<?php
/**
 * Envoie une réponse JSON au client.
 * @param string $message Le message d'erreur à envoyer.
 * @param mixed $data Les données à envoyer dans la réponse.
 * @param int $statusCode Le code de statut HTTP de la réponse.
 */
 function sendJsonResponse($data, $statusCode) {
    header('Content-Type: application/json, charset=utf-8');
    header('Access-Control-Allow-Origin: *');
    header('Connection: keep-alive');
    http_response_code($statusCode);
    $responseData["response"] = $data;
    $responseData["statuscode"] = $statusCode;
    echo json_encode($responseData);
    exit;
}

function sendJsonErrorResponse($message, $statusCode) {
    sendJsonResponse(['success' => false,'erreur' => $message], $statusCode);
}

function sendJsonSuccessResponse($data, $statusCode) {
    sendJsonResponse(['success' => true, 'data' => $data], $statusCode);
}