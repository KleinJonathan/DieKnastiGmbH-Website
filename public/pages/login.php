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

// Setzen des Gefaengnis und des Mitarbeiters in Session Variablen
// $_SESSION['loginId'] = '10';    
// $_SESSION['gefId'] = '3';
// $_SESSION['name'] = 'Justizvollzugsanstalt Hameln';
?>
<hr/>
<nav></nav>

<script>
    function login() {

        var id = document.querySelector('input[placeholder="ID"]').value;
        console.log(id);
    }
</script>

<?php
// Funktion zum updaten eines Vertags
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Speichern Sie das Datum aus dem Formular in einer Variable
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