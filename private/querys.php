<?php
    function findeInsassen($conn){
        $sql = oci_parse($conn, "SELECT * FROM INSASSE");
        oci_execute($sql);
        return $sql;
    }

?>