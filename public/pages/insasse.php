<?php require_once("../../private/initialize.php");

if (!isset($_GET["id"])) {
    redirect(root_url("../index.php"));
}
$id = $_GET["id"];

?>

<!-- Der String muss als "normale" chars umgewandelt werden um die Daten unschädlich zu machen -->
<!-- http://localhost:8000/pages/insasse.php?id=%3Cstrong%3E1%3C/string%3E -->
<?php
debug_to_console($id);
hCheck($id);
$sql = oci_parse($conn, "SELECT * FROM INSASSE WHERE ID ='" . $id . "'");
oci_execute($sql);
$row = oci_fetch_assoc($sql);

$title = hCheck($row["NACHNAME"]) . ", " . hCheck($row["VORNAME"]);
$headerTitle = hCheck($row["NACHNAME"]) . ", " . hCheck($row["VORNAME"]);
include(HELPER_PATH . "/header.php");
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

</div>
<?php debug_to_console($sql) ?>



<?php
if (isset($sql)) {
    // Freigegebene Ressourcen und schliesen der Verbindung
    oci_free_statement($sql);
}
?>

<?php include(HELPER_PATH . "/footer.php") ?>