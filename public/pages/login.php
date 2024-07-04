<?php
require_once("../../private/initialize.php");
$title = "Insassen - Die Knasti GmbH";
session_start();
?>



<?php
// Setzen der Page Variablen
$headerTitle = 'Die Knasti GmbH';
$headerSubTitle = 'Login';
include(HELPER_PATH . "/header.php");

// Setzen des Gefaengnis und des Mitarbeiters in Session Variablen
$_SESSION['loginId'] = '10';    
$_SESSION['gefId'] = '3';
$_SESSION['name'] = 'Justizvollzugsanstalt Hameln';
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