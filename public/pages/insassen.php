<?php 
require_once("../../private/initialize.php");
$title = "Insassen - Die Knasti GmbH";
$headerTitle = "Insassen - Die Knasti GmbH";
include(HELPER_PATH . "/header.php");
?>


<nav>
    <!-- <a href="/pages/insasse.php">Insasse</a> Geht nicht, da in dem Header von Insasse eine ID gefprdert wird -->
</nav>


<?php
$sql = findeInsassen($conn);
oci_execute($sql);
?>


<div class="content">
    <table border='1'>
        <tr>

            <th>Insasse-ID</th>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>Punkte</th>
        </tr>

        <?php while ($row = oci_fetch_assoc($sql)) { ?>
            <tr>
                <td> <a href="<?php echo root_url('/pages/insasse.php?id=' . hCheck($row['ID'])) ?>"> <?php echo hCheck($row["ID"]) ?> </a></td>
                <td> <?php echo hCheck($row["VORNAME"]); ?> </td>
                <td> <?php echo hCheck($row["NACHNAME"]); ?> </td>
                <td> <?php echo hCheck($row["PUNKTE"]); ?> </td>
            </tr>
        <?php } ?>
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