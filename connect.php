<?php
    $connection = new mysqli('localhost', 'root', '', 'dbsabayf3');
    
    if(!$connection){
        die(mysqli_error($mysqli));
    }    
?>