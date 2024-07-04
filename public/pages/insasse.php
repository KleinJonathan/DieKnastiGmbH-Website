<?php require_once("../../private/initialize.php");
session_start();
if (!isset($_SESSION['loginId'])) {
    redirect(root_url("pages/login.php"));
}

if (!isset($_GET["id"])) {
    redirect(root_url("../index.php"));
}
$id = $_GET["id"];

?>

<!-- Der String muss als "normale" chars umgewandelt werden um die Daten unschädlich zu machen -->
<!-- http://localhost:8000/pages/insasse.php?id=%3Cstrong%3E1%3C/string%3E -->
<?php
hCheck($id);
$sql = oci_parse($conn, 'begin EinzelnerInsassen(:i_id); end;');
oci_bind_by_name($sql, ':i_id', $id);
oci_execute($sql);
$row = oci_fetch_assoc($sql);

// Redirect wenn keine Daten gefunden wurden
if (!$row) {
    redirect(root_url("../index.php"));
}

$title = 'Die Knasti GmbH ' . ' - ' . $_SESSION['name'];
$headerTitle = "Die KnastiGmbH";
$headerSubTitle = hCheck($row["NACHNAME"]) . ", " . hCheck($row["VORNAME"]);
include(HELPER_PATH . "/header.php");
include(HELPER_PATH . "/navbar.php");
?>

<div class="content">
    <h3>Persönliche Daten</h3>
    <dl>
        <dt>Nachname: </dt>
        <dd> <?php echo hCheck($row["NACHNAME"]) ?> </dd>

        <dt>Vorname: </dt>
        <dd> <?php echo hCheck($row["VORNAME"]) ?> </dd>

        <dt>Punkte: </dt>
        <dd> <?php echo hCheck($row["PUNKTE"]) ?> </dd>


        <?php 
        $lob = $row["NOTIZ"];
        if ($lob) { ?>
            <?php $string = $lob->load();?>
            <dt>Notiz: </dt>
            <dd> <?php echo hCheck($string) ?> </dd>
        <?php } else { ?>
            <dt>Notiz: </dt>
            <dd>Keine Notizen </dd>
        <?php } ?>

        <dt>Kontostand: </dt>
        <dd> <?php echo hCheck($row["KONTO"]) ?>€ </dd>
            
    </dl>

    <h3>Aktueller Aufenthalt</h3>
    <?php if (hCheck($row["ZELLENID"])) {?>
            <dl>
                <dt>Gefängnis: </dt>
                <dd> <?php echo hCheck($row["GEFANGNIS"]) ?> </dd>

                <dt>Zelle: </dt>
                <dd> <?php echo hCheck($row["ZELLENID"]) ?> </dd>
            </dl>
    <?php } else { ?>
        <dl>
            <dt>Der Insasse ist zur Zeit nicht inhaftiert.</dt>
        </dl>
    <?php } ?>

    <?php $row = oci_fetch_assoc($sql);?>

    <?php 
        if (hCheck($row["ZUSTAND"])) {?>
            <h3>Verträge</h3>
            <?php do {
                if (hCheck($row["ZUSTAND"])) { ?>
                    <dl>
                        <dt>Begin: </dt>
                        <dd> 
                            <?php 
                            if ($row["BEGINN"] == null) {
                                echo "Kein Datum";
                            } else {
                                echo hCheck(date("d.m.Y", strtotime($row["BEGINN"])));
                            } ?> 
                        </dd>
        
                        <dt>Bezeichnung: </dt>
                        <dd> <?php echo hCheck($row["BEZEICHNUNG"]) ?> </dd>
        
                        <dt>Zustand: </dt>
                        <dd> <?php echo hCheck($row["ZUSTAND"]) ?> </dd>
                        <?php if ($row["ZUSTAND"] == "In Bearbeitung") {?>
                            <dd>
                                <button 
                                style="margin: 0;"
                                ><a href="<?php echo root_url('/pages/bearbeiteVertrag.php?id=' . hCheck($row['VER_ID'])) ?>">Bearbeiten</a></button>
                            </dd>
                        <?php }?>
                    </dl>
                    <?php
                } else {
                    break;
                }
            } while ($row = oci_fetch_assoc($sql));
        }
    ?>


    <?php 
        if (hCheck($row["BEZEICHNUNG"])) {?>
            <h3>Zwischenfälle</h3>
            <?php do {
                if (hCheck($row["BEZEICHNUNG"])) { ?>
                        <dl>
                            <dt>Datum: </dt>
                            <dd> <?php echo hCheck(date("d.m.Y", strtotime($row["BEGINN"]))); ?> </dd>
    
                            <dt>Bezeichnung: </dt>
                            <dd> <?php echo hCheck($row["BEZEICHNUNG"]) ?> </dd>
                        </dl>
                        <?php
                } else {
                    break;
                }
            } while ($row = oci_fetch_assoc($sql));
        }
    ?>
</div>

<?php
if (isset($sql)) {
    // Freigegebene Ressourcen und schliesen der Verbindung
    oci_free_statement($sql);
}
?>

<?php include(HELPER_PATH . "/footer.php") ?>