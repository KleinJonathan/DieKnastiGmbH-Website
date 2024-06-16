<?php require_once("../../private/initialize.php");

if (!isset($_GET["id"])) {
    redirect(root_url("../index.php"));
}
$id = $_GET["id"];

?>

<!-- Der String muss als "normale" chars umgewandelt werden um die Daten unschädlich zu machen -->
<!-- http://localhost:8000/pages/insasse.php?id=%3Cstrong%3E1%3C/string%3E -->
<?php
// debug_to_console($id);
// Fetchen der Daten aus der Datenbank
hCheck($id);
$sql = oci_parse($conn, 'begin Test(:i_id); end;');
oci_bind_by_name($sql, ':i_id', $id);

oci_execute($sql);
$row = oci_fetch_assoc($sql);
// Redirect wenn keine Daten gefunden wurden
if (!$row) {
    redirect(root_url("../index.php"));
}

$title = hCheck($row["NACHNAME"]) . ", " . hCheck($row["VORNAME"]);
$headerTitle = hCheck($row["NACHNAME"]) . ", " . hCheck($row["VORNAME"]);
include(HELPER_PATH . "/header.php");
include(HELPER_PATH . "/navbar.php");
?>

<div class="content">

    <dl>
        <dt>Nachname: </dt>
        <dd> <?php echo hCheck($row["NACHNAME"]) ?> </dd>

        <dt>Vorname: </dt>
        <dd> <?php echo hCheck($row["VORNAME"]) ?> </dd>

        <dt>Punkte: </dt>
        <dd> <?php echo hCheck($row["PUNKTE"]) ?> </dd>
    </dl>

    <?php $row = oci_fetch_assoc($sql);?>

    <dl>
        <dt>Begin: </dt>
        <dd> <?php echo hCheck($row["BEGINN"]) ?> </dd>

        <dt>Bezeichnung: </dt>
        <dd> <?php echo hCheck($row["BEZEICHNUNG"]) ?> </dd>

        <dt>Zustand: </dt>
        <dd> <?php echo hCheck($row["ZUSTAND"]) ?> </dd>
    </dl>

    <?php $row = oci_fetch_assoc($sql);?>

    <dl>
        <dt>Gefängnis: </dt>
        <dd> <?php echo hCheck($row["NAME"]) ?> </dd>

        <dt>Zellenid: </dt>
        <dd> <?php echo hCheck($row["ZELLENID"]) ?> </dd>
    </dl>

    <?php $row = oci_fetch_assoc($sql);?>

    <dl>
        <dt>Gefängnis: </dt>
        <dd> <?php echo hCheck($row["DATUM"]) ?> </dd>

        <dt>Zellenid: </dt>
        <dd> <?php echo hCheck($row["BEZEICHNUNG"]) ?> </dd>
    </dl>

</div>

<?php
if (isset($sql)) {
    // Freigegebene Ressourcen und schliesen der Verbindung
    oci_free_statement($sql);
}
?>

<?php include(HELPER_PATH . "/footer.php") ?>





<!-- Editieren von Verträgen  -->

<!-- while (($row = oci_fetch_array($sql, OCI_ASSOC + OCI_RETURN_LOBS))) {  -->


