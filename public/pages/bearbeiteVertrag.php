<?php require_once("../../private/initialize.php");
$id = $_GET["id"];
session_start();
if (!isset($_SESSION['loginId'])) {
    redirect(root_url("pages/login.php"));
} ?>

<?php
// debug_to_console($id);
// Fetchen der Daten aus der Datenbank
hCheck($id);
$sql = oci_parse($conn, 'begin mitarbeiterVertrag(:i_id); end;');
oci_bind_by_name($sql, ':i_id', $id);

oci_execute($sql);
$row = oci_fetch_assoc($sql);
// Redirect wenn keine Daten gefunden wurden

$title = "Vertrag bearbeiten - Die Knasti GmbH";
$headerTitle = "Vertrag bearbeiten - Die Knasti GmbH";
include(HELPER_PATH . "/header.php");
include(HELPER_PATH . "/navbar.php");
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Speichern Sie das Datum aus dem Formular in einer Variable
    $id = $_POST['id'] ?? '';
    $notizmitarbeiter = $_POST['notizmitarbeiter'] ?? '';
    $beginn = $_POST['beginn'] ?? '';
    $beginn_formatiert = $beginn ? date('d/m/Y', strtotime($beginn)) : NULL;
    $ende = $_POST['ende'] ?? '';
    $ende_formatiert = $ende ? date('d/m/Y', strtotime($ende)) : NULL;
    $verguetung = $_POST['verguetung'] ?? '';
    $status = $_POST['status'] ?? '';

    $sql = oci_parse($conn, 'begin BearbeiteVertrag(:ver, :beginn, :ende, :verguetung, :vertrag_zustand, :notizGefaengnis); end;');

    oci_bind_by_name($sql, ':ver', $id);
    oci_bind_by_name($sql, ':beginn', $beginn_formatiert);
    oci_bind_by_name($sql, ':ende', $ende_formatiert);
    oci_bind_by_name($sql, ':verguetung', $verguetung);
    oci_bind_by_name($sql, ':vertrag_zustand', $status);
    oci_bind_by_name($sql, ':notizGefaengnis', $notizmitarbeiter);


    oci_execute($sql);
}
?>


<div class="content">
    <?php if (hCheck($row["BENACHRICHTIGUNGSPFLICHT"]) == null){ ?>
            <button id="gerichtAnfragenButton">Gericht anfragen</button>
            
            <script type="text/javascript">
                document.getElementById("gerichtAnfragenButton").onclick = function() {
                    alert("Anfrage erfolgreich gesendet!");
                };
            </script>
    <?php } ?>
    <form action="bearbeiteVertrag.php" method="post">
        <dl>
            <?php
            $placeholder = "";
            $lob = $row["NOTIZGEFAENGNIS"];
            if ($lob) {
                $string = $lob->load();
                $placeholder = hCheck($string);
            }
            if (strtotime($row["BEGINN"]) !== false) {
                // Wenn ja, formatieren und anzeigen
                $beginn = date('Y-m-d', strtotime($row["BEGINN"]));
            } else {
                // Wenn nicht, Standardwert anzeigen
                $beginn = 'dd/mm/yyyy';
            }
            if (strtotime($row["ENDE"]) !== false) {
                // Wenn ja, formatieren und anzeigen
                $ende = date('Y-m-d', strtotime($row["ENDE"]));
            } else {
                // Wenn nicht, Standardwert anzeigen
                $ende = 'dd/mm/yyyy';
            }
            ?>

            <input type="hidden" name="id" value="<?php echo hCheck($row["VER_ID"]) ?>">
            <dt>Insasse: </dt>
            <dd> <?php echo hCheck($row["VORNAME"]) . ', ' . hCheck($row["NACHNAME"]) ?> </dd>

            <dt>Erstellt: </dt>
            <dd> <?php echo hCheck($row["ERSTELLT"]) ?> </dd>

            <dt>Bezeichnung: </dt>
            <dd> <?php echo hCheck($row["BEZEICHNUNG"]) ?> </dd>

            <?php
            $lob = $row["NOTIZINSASSE"];
            if ($lob) { ?>
                <?php $string = $lob->load(); ?>
                <dt>Notiz Insasse: </dt>
                <dd> <?php echo hCheck($string) ?> </dd>
            <?php } else { ?>
                <dt>Notiz Insasse: </dt>
                <dd>Keine Notizen </dd>
            <?php } ?>

            <dt>Notiz Mitarbeiter: </dt>
            <dd>
                <textarea style="width: 300px;" name="notizmitarbeiter"><?php echo $placeholder ?></textarea>
            </dd>

            <dt>Beginn:</dt>
            <dd><input type="date" name="beginn" value="<?php echo $beginn ?>"></input></dd>

            <dt>Ende:</dt>
            <dd><input type="date" name="ende" value="<?php echo $ende ?>"></input></dd>

            <dt>Vergütung:</dt>
            <dd><input name="verguetung" value="<?php echo hCheck($row["VERGUTUNG"]) ?>"></input></dd>

            <dt>Zustand:</dt>
            <dd>
                <select name="status">
                    <option value="In Bearbeitung" <?php if ($row["ZUSTAND"] == "In Bearbeitung") echo 'selected'; ?>>In Bearbeitung</option>
                    <option value="Genehmigt" <?php if ($row["ZUSTAND"] == "Genehmigt") echo 'selected'; ?>>Genehmigt</option>
                    <option value="Abgeschlossen" <?php if ($row["ZUSTAND"] == "Abgeschlossen") echo 'selected'; ?>>Abgeschlossen</option>
                    <option value="Abgelehnt" <?php if ($row["ZUSTAND"] == "Abgelehnt") echo 'selected'; ?>>Abgelehnt</option>
                </select>
            </dd>

        </dl>
        <button type="submit">Speichern</button>
        <!-- <button type="submit"><a href="./vertraege.php">Speichern</a></button> -->
    </form>
</div>

<?php
if (isset($sql)) {
    // Freigegebene Ressourcen und schliesen der Verbindung
    oci_free_statement($sql);
}
?>

<?php include(HELPER_PATH . "/footer.php") ?>