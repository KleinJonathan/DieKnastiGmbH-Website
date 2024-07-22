<?php
require_once("../private/initialize.php");
session_start();
// Redirect wenn nicht eingeloggt
if (!isset($_SESSION['loginId'])) {
    redirect(root_url("pages/login.php"));
} 

// Setzern der Page Variablen
$title = 'Die Knasti GmbH ' . ' - ' . $_SESSION['name'];
$headerTitle = "Die Knasti GmbH";
$headerSubTitle = "Startseite";
?>

<?php
include(HELPER_PATH . "/header.php");
include(HELPER_PATH . "/navbar.php");
?>


<!-- HTML Code -->
<div class="content">
    <h1>Willkommen bei der Knasti GmbH</h1>
    <p>Sie finden hier Möglichkeiten die <b>Anträge</b> der Insassen zu <b>bearbeiten</b>.</p>
    <p>Informationen über die Insassen, welche Ihnen helfen können über den Antrag zu enscheiden sind an entsprechenden Stellen verlinkt.</p>
    <h3>Inhalt:</h3>
    <ul>
        <li><b>Insassen</b>: Übersicht</b> über alle Insasen aus Ihrem Gefängnis</li>
        <li><b>Verträge in bearbeitung:</b> <b>Überisicht</b> über alle noch offenen und zu bearbeitenden Verträge</li>
    </ul>
</div>

<?php include(HELPER_PATH . "/footer.php") ?>