<!-- Beispiel Configdatei zum Verbinden mit einer Orable Datenbank -->
<!-- Die Datei muss kopiert und umbenannt werden in config.php -->
<?php
    // Verbindung zur Datenbank aufbauen
    $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = SERVERARRD)(PORT = POST)))(CONNECT_DATA=(SID=SID)))";
    $conn = oci_connect("USERNAME","PASSWORT",$db);
    // Verbindung prüfen
    if (!$conn) {
        debug_to_console("NOT Connected to Oracle!");
        $e = oci_error();
        echo htmlentities($e['message']);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        exit;
    } else {
        debug_to_console("Connected to Oracle!");

    }
?>