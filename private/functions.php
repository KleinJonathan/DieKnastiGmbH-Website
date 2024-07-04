<!-- Gundlegende Funktionen, welche von den meisten Seiten gebraucht werden -->
<?php

// Ausgabe von Debug Informationen in der Konsole
function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

// Pfad zum Root Verzeichnis um leichter die Dateien zu finden
function root_url($script_path) {
    // add the leading '/' if not present
    if($script_path[0] != '/') {
      $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
  }

  // Funktion um die Eingaben von Formularen zu überprüfen
function hCheck($string=""){
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Funktion zum rückgeben einer 404 Seite
function error_404(){
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
    exit();
    // Statt exit kann auch hier eine individuelle HTLM Page geladen werden
}

// Funktion zum umleiten auf eine andere Seite
function redirect($string=""){
    header("Location: " . $string);
    exit();
}

?>
