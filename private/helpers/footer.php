<footer>
    &copy; <?php echo date('Y') ?> Die Knasti GmbH
    <a href="#top">Nach oben</a>
</footer>
</body>

</html>

<?php
    // Schließen der Datenbankverbindung
    oci_close($conn);
?>