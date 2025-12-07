<?php
/**
 * Configuration des chemins du projet
 * Utilise des chemins absolus pour éviter les problèmes de chemins relatifs
 */

// Définir le répertoire racine du projet
define('PROJECT_ROOT', dirname(dirname(__FILE__)));
define('INCLUDES_DIR', PROJECT_ROOT . '/includes');
define('CONFIG_DIR', PROJECT_ROOT . '/config');
define('PAGES_DIR', PROJECT_ROOT . '/pages');

// Fonction helper pour inclure les fichiers
function include_file($file_path) {
    $full_path = $file_path;
    if (file_exists($full_path)) {
        include $full_path;
    } else {
        trigger_error("File not found: $full_path", E_USER_WARNING);
    }
}

// Fonction pour inclure le header
function include_header() {
    include INCLUDES_DIR . '/header.php';
}

// Fonction pour inclure le footer
function include_footer() {
    include INCLUDES_DIR . '/footer.php';
}

// Fonction pour inclure la base de données
function include_database() {
    include CONFIG_DIR . '/database.php';
}
?>
