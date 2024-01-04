<?php
    //MES FONCTIONS UTILITAIRES
    function sanitize($data){
        return htmlentities(strip_tags(trim($data)));
    }
?>