<?php
require_once("../../private/initialize.php");
$title = "Die Knasti GmbH";
session_start();
?>



<?php
// Setzen der Page Variablen
$headerTitle = 'Die Knasti GmbH';
$headerSubTitle = 'Login';
include(HELPER_PATH . "/header.php");
?>
<hr/>
<nav></nav>

<!-- Funktion zum einloggen eines Mitarbeiters -->
<script>
    function login() {
        var id = document.querySelector('input[placeholder="ID"]').value;
    }
</script>

<?php
// Funktion zum einloggen eines Mitarbeiters
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Login mithilfe einer Stored Procedure und setzen der Session Variablen, wenn der Login erfolgreich war
    $id = $_POST['id'] ?? '';

    $sql = oci_parse($conn, 'begin mitarbeiterLogin(:mitid); end;');

    oci_bind_by_name($sql, ':mitid', $id);
    oci_execute($sql);
    $row = oci_fetch_assoc($sql);

    if ($row) {
        $_SESSION['loginId'] = $row["ID"];
        $_SESSION['gefId'] = $row["GEF_ID"];
        $_SESSION['name'] = $row["NAME"];
        ?>
        <!-- Redirect -->
        <script type="text/javascript">
        window.location = "http://localhost:3000/index.php/";
        </script> 
        <?php
    } else {
        // Popup mit Fehlermeldung
        echo '<script>alert("Benutzer nicht verfügbar. Bitte versuchen Sie es erneut.");</script>';
        ?>
        <!-- Redirect -->
        <script type="text/javascript">
        window.location = "http://localhost:3000/pages/login.php/";
        </script> 
        <?php
    }
}
?>

<!-- HTML Code zum anzeigen des Login Formulars -->
<div class="content">
    <form action="login.php" method="post" style="display: flex; flex-direction: column">
        <input name="id" style="margin-top: 5rem;" placeholder="ID"></input>

        <button type="submit">Einloggen</button>
    </form>

</div>

<?php
if (isset($sql)) {
    // Freigegebene Ressourcen und schliesen der Verbindung
    oci_free_statement($sql);
}
?>


<?php include(HELPER_PATH . "/footer.php") ?>