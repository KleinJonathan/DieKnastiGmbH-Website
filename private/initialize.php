<!-- Imitialisierungsdatei, welche vor jedem Seitenaufruf geladen wird -->
<!-- Hier wird unter anderen die DB Verbindung aufgebaut -->
<?php
    echo "<!DOCTYPE html>";
    
    // Dateipfade definieren
    define("PRIVATE_PATH", dirname(__FILE__));          // Private path
    define("PROJECT_PATH", dirname(PRIVATE_PATH));      // Project path
    define("PUBLIC_PATH", PROJECT_PATH . '/public');    // Public path
    define("HELPER_PATH", PRIVATE_PATH . '/helpers');   // Helper path

    // URL PFADE Definieren 
    $public = strpos($_SERVER['SCRIPT_NAME'], '/public');;
    $doc = substr($_SERVER['SCRIPT_NAME'], 0, $public);
    define("WWW_ROOT", $public);

    // Funktionen einbinden
    require_once("functions.php");
    // Aufbauen der Verbindung
    require_once("config.php");
?>