<?php
// index.php (à la racine)

// Optionnel : afficher les erreurs PHP pendant que vous développez (très utile pour déboguer)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Récupération de l'action demandée dans l'URL (par défaut, on va sur 'home')
$action = isset($_GET['action']) ? $_GET['action'] : 'home';

switch ($action) {
    case 'home':
        require_once __DIR__ . '/controllers/HomeController.php';
        $controller = new HomeController();
        $controller->index();
        break;

    default:
        // Page 404 simple si la route n'existe pas
        header("HTTP/1.0 404 Not Found");
        echo "Oups ! Page introuvable.";
        break;
}