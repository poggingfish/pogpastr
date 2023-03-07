<?php
    require("src/config.php");
    $db = new PDO("sqlite:src/$dbFile");
    $db->exec("CREATE TABLE pastes (
        PasteID varchar(25), 
        Paste varchar(50000));");
?>