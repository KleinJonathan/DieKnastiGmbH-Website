<?php
require_once("../private/initialize.php");
$title = 'Die Knasti GmbH ' . ' - ' . $_SESSION['name'];
$headerTitle = "Die Knasti GmbH";
$headerSubTitle = "Startseite";
session_start();
if (!isset($_SESSION['loginId'])) {
    redirect(root_url("pages/login.php"));
} ?>

<?php
include(HELPER_PATH . "/header.php");
include(HELPER_PATH . "/navbar.php");
?>



<div class="content">
    <h1>Willkommen bei der Knasti GmbH</h1>
    <p>Die Knasti GmbH ist ein Unternehmen, welches sich auf die Verwaltung von Gefängnissen spezialisiert hat. Wir bieten Ihnen eine Vielzahl von Dienstleistungen an, um den Alltag in Gefängnissen zu erleichtern.</p>
    <p>Unsere Dienstleistungen umfassen unter anderem:</p>
    <ul>
        <li>Verwaltung von Insassen</li>
        <li>Verwaltung von Verträgen</li>
        <li>Verwaltung von Gefängnissen</li>
    </ul>
    <p>Wir freuen uns, Ihnen bei der Verwaltung Ihrer Gefängnisse zu helfen.</p>
</div>

<?php include(HELPER_PATH . "/footer.php") ?>