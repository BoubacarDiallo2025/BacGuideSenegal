<?php
/**
 * Bootstrap du projet - À inclure au début de chaque fichier PHP
 * Initialise les chemins et les configurations globales
 */

// Déterminer le répertoire racine en fonction du fichier qui inclut ce bootstrap
$script_dir = dirname($_SERVER['SCRIPT_FILENAME']);
$project_root = dirname(__FILE__);

// Si on est dans le dossier pages, remonter d'un niveau
if (basename($script_dir) === 'pages') {
    $project_root = dirname($script_dir);
}

// Définir les constantes de chemins
if (!defined('PROJECT_ROOT')) {
    define('PROJECT_ROOT', $project_root);
}
if (!defined('INCLUDES_DIR')) {
    define('INCLUDES_DIR', PROJECT_ROOT . '/includes');
}
if (!defined('CONFIG_DIR')) {
    define('CONFIG_DIR', PROJECT_ROOT . '/config');
}
if (!defined('PAGES_DIR')) {
    define('PAGES_DIR', PROJECT_ROOT . '/pages');
}

// Inclure la configuration des chemins
require_once CONFIG_DIR . '/paths.php';

// Inclure la configuration de la base de données
require_once CONFIG_DIR . '/database.php';
?>
