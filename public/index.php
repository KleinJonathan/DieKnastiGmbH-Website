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



<div class="content">
    <h1>Willkommen bei der Knasti GmbH</h1>
    <p>Sie finden hier Möglichkeiten die Anträge der Insassen zu bearbeiten.</p>
    <p>Informationen über die Insassen, welche Ihnen helfen können über den Antrag zu enscheiden sind an entsprechenden Stellen verlinkt.</p>
    <p>Inhalt:</p>
    <ul>
        <li>Insassen: Übersicht über alle Insasen aus Ihrem Gefängnis</li>
        <li>Verträge in bearbeitung: Überisicht über alle noch offenen und zu bearbeitenden Verträge</li>
    </ul>
</div>

<?php include(HELPER_PATH . "/footer.php") ?>