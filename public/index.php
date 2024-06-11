<?php 
require_once("../private/initialize.php");
$title = "Startseite - Die Knasti GmbH";
$headerTitle = "Startseite - Die Knasti GmbH";
?>

<?php include(HELPER_PATH . "/header.php") ?>

<nav>
    <!-- <a href="/pages/insasse.php">Insasse</a> Geht nicht, da in dem Header von Insasse eine ID gefprdert wird -->
    <a href="./pages/insassen.php">Insassen</a>
</nav>

<div class="content">

</div>

<?php include(HELPER_PATH . "/footer.php") ?>


<!-- Editieren von Verträgen  -->

<!-- while (($row = oci_fetch_array($sql, OCI_ASSOC + OCI_RETURN_LOBS))) {  -->


<!-- https://www.php.net/manual/en/oci8.examples.php -->
<!-- https://www.oracle.com/webfolder/technetwork/tutorials/obe/db/oow10/php_db/php_db.htm -->
<!-- https://www.w3schools.com/php/php_cookies.asp -->
<!-- https://www.linkedin.com/learning/php-with-mysql-essential-training-1-the-basics?contextUrn=urn%3Ali%3AlyndaLearningPath%3A57bdd8a292015ae4c0cb990f&u=82590906 -->
<!-- https://www.linkedin.com/learning/php-with-mysql-essential-training-2-build-a-cms?contextUrn=urn%3Ali%3AlyndaLearningPath%3A57bdd8a292015ae4c0cb990f&u=82590906 -->