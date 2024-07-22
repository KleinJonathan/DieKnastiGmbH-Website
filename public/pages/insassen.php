<?php
require_once("../../private/initialize.php");
session_start();
$title = 'Die Knasti GmbH ' . ' - ' . $_SESSION['name'];
// Redirect wenn nicht eingeloggt
if (!isset($_SESSION['loginId'])) {
    redirect(root_url("pages/login.php"));
}
?>

<?php
// Abrufen der Daten des Insassen mithilfe einer Stored Procedure und setzen der Page Variablen
$gef_id = $_SESSION['gefId'];
$sql = oci_parse($conn, 'begin AlleInsassen(:gef_id); end;');
oci_bind_by_name($sql, ':gef_id', $gef_id);
oci_execute($sql);
$row = oci_fetch_assoc($sql);
$headerTitle = 'Die Knasti GmbH';
$headerSubTitle = "Insassen";
include(HELPER_PATH . "/header.php");
include(HELPER_PATH . "/navbar.php");
?>


<!-- HTML Code zum anzeigen der Insassen mit kutzen Informationen -->
<div class="content">
    <table border='1'>
        <tr>

            <th>Nachname</th>
            <th>Vorname</th>
            <th>Zelle</th>
            <th>Ansehen</th>
        </tr>

        <?php do { ?>
            <tr>
                <td> <?php echo hCheck($row["NACHNAME"]); ?> </td>
                <td> <?php echo hCheck($row["VORNAME"]); ?> </td>
                <td> <?php echo hCheck($row["ZELLENID"]); ?> </td>
                <td><a href="<?php echo root_url('/pages/insasse.php?id=' . hCheck($row['ID'])) ?>"><button style="margin: 5px;"> Ansehen</button></a></td>
            </tr>
        <?php } while ($row = oci_fetch_assoc($sql)) ?>
    </table>
</div>

<?php
if (isset($sql)) {
    // Freigegebene Ressourcen und schliesen der Verbindung
    oci_free_statement($sql);
}
?>


<?php include(HELPER_PATH . "/footer.php") ?>