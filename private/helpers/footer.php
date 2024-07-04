<!-- Footer zum einfügen in jede Datei -->
<footer>
    &copy; <?php echo date('Y') ?> Die Knasti GmbH
</footer>
</body>

</html>

<?php
    // Schließen der Datenbankverbindung
    oci_close($conn);
?>