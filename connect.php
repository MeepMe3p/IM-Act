<?php
    $connection = new mysqli('localhost', 'root', '', 'dbatayf3');
    
    if(!$connection){
        die(mysqli_error($mysqli));
    }    
?>