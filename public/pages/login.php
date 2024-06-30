<?php
require_once("../../private/initialize.php");
$title = "Insassen - Die Knasti GmbH";
session_start();
?>



<?php
$headerTitle = 'Login - Die Knasti GmbH';
include(HELPER_PATH . "/header.php");

// Setzen des GEfaengnis und des Mitarbeiters in Session Variablen
$_SESSION['loginId'] = '10';
$_SESSION['gefId'] = '3';
// include(HELPER_PATH . "/navbar.php");
?>
<nav></nav>
<hr/>

<script>
    function login() {

        var id = document.querySelector('input[placeholder="ID"]').value;
        console.log(id);
    }
</script>


<div class="content">
    <input style="margin-top: 5rem;" placeholder="ID"></input>
    <button onclick="login()"><a href='/'>Einloggen</a></button>

</div>

<?php
if (isset($sql)) {
    // Freigegebene Ressourcen und schliesen der Verbindung
    oci_free_statement($sql);
}
?>


<?php include(HELPER_PATH . "/footer.php") ?>