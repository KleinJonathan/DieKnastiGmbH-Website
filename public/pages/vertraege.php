<?php require_once("../../private/initialize.php");
session_start();
if (!isset($_SESSION['loginId'])) {
    redirect(root_url("pages/login.php"));
}?>

<!-- Der String muss als "normale" chars umgewandelt werden um die Daten unschädlich zu machen -->
<!-- http://localhost:8000/pages/insasse.php?id=%3Cstrong%3E1%3C/string%3E -->
<?php
$gef_id = $_SESSION['gefId'];
$sql = oci_parse($conn, 'begin VertraegeInBearbeitung(:gef_id); end;');
oci_bind_by_name($sql, ':gef_id', $gef_id);
oci_execute($sql);

$title = 'Die Knasti GmbH ' . ' - ' . $_SESSION['name'];
$headerTitle = "Die Knasti GmbH";
$headerSubTitle = "Verträge in Bearbeitung";
include(HELPER_PATH . "/header.php");
include(HELPER_PATH . "/navbar.php");
?>

<div class="content">
    <?php if (!oci_execute($sql)) { ?>
        <p>Keine Verträge in Bearbeitung</p>
    <?php } else { ?>
        <table border='1'>
            <tr>
                <th>Erstellt</th>
                <th>Insasse Name</th>
                <th>Bezeichnung</th>
                <th>Notiz Insasse</th>
                <th>Notiz Mitarbeiter</th>
                <th>Bearbeiten</th>
            </tr>

            <?php while ($row = oci_fetch_assoc($sql)) { ?>
                <tr>
                    <td> <?php echo hCheck($row["ERSTELLT"]); ?> </td>
                    <td> <a href="<?php echo root_url('/pages/insasse.php?id=' . hCheck($row['INS_ID'])) ?>"> <?php echo hCheck($row['NACHNAME']) . ',' . hCheck($row['VORNAME'])  ?> </a></td>
                    <td> <?php echo hCheck($row["BEZEICHNUNG"]); ?> </td>
                    <td> <?php 
                        $lob = $row["NOTIZINSASSE"];
                        if ($lob) {
                            $string = $lob->load();
                            echo hCheck($string); 
                        } else {
                            echo "-";
                        }?>
                    </td>
                    <td> <?php 
                        $lob = $row["NOTIZGEFAENGNIS"];
                        if ($lob) {
                            $string = $lob->load();
                            echo hCheck($string); 
                        } else {
                            echo "-";
                        }?>
                    </td>
                    <td>
                        <a href="<?php echo root_url('/pages/bearbeiteVertrag.php?id=' . hCheck($row['VER_ID'])) ?>">
                            <button style="margin: 5px;" >
                                Bearbeiten
                            </button>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php }?>
</div>

<?php
if (isset($sql)) {
    // Freigegebene Ressourcen und schliesen der Verbindung
    oci_free_statement($sql);
}
?>

<?php include(HELPER_PATH . "/footer.php") ?>