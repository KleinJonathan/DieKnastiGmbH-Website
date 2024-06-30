<?php 
require_once("../../private/initialize.php");
$title = "Insassen - Die Knasti GmbH";
session_start();
if (!isset($_SESSION['loginId'])) {
    redirect(root_url("pages/login.php"));
}
?>




<?php
$gef_id = $_SESSION['gefId'];
$sql = oci_parse($conn, 'begin AlleInsassen(:gef_id); end;');
oci_bind_by_name($sql, ':gef_id', $gef_id);
oci_execute($sql);
$row = oci_fetch_assoc($sql);
$headerTitle = 'Insassen - Die Knasti GmbH - ' . hCheck($row["GEFANGNIS"]);
include(HELPER_PATH . "/header.php");
include(HELPER_PATH . "/navbar.php");
?>


<div class="content">
    <table border='1'>
        <tr>

            <th>Insasse-ID</th>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>Zelle</th>
        </tr>

        <?php do { ?>
            <tr>
                <td> <a href="<?php echo root_url('/pages/insasse.php?id=' . hCheck($row['ID'])) ?>"> <?php echo hCheck($row["ID"]) ?> </a></td>
                <td> <?php echo hCheck($row["VORNAME"]); ?> </td>
                <td> <?php echo hCheck($row["NACHNAME"]); ?> </td>
                <td> <?php echo hCheck($row["ZELLENID"]); ?> </td>
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


<!-- Editieren von Verträgen  -->

<!-- while (($row = oci_fetch_array($sql, OCI_ASSOC + OCI_RETURN_LOBS))) {  -->


<!-- https://www.php.net/manual/en/oci8.examples.php -->
<!-- https://www.oracle.com/webfolder/technetwork/tutorials/obe/db/oow10/php_db/php_db.htm -->
<!-- https://www.w3schools.com/php/php_cookies.asp -->
<!-- https://www.linkedin.com/learning/php-with-mysql-essential-training-1-the-basics?contextUrn=urn%3Ali%3AlyndaLearningPath%3A57bdd8a292015ae4c0cb990f&u=82590906 -->
<!-- https://www.linkedin.com/learning/php-with-mysql-essential-training-2-build-a-cms?contextUrn=urn%3Ali%3AlyndaLearningPath%3A57bdd8a292015ae4c0cb990f&u=82590906 -->