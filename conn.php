<?php 
    $mysqli = new mysqli("localhost", "bob_bian", "", "bob_bian");
    if ($mysqli->connect_error != "") {
        echo "error fof connect";
        exit();
    } else {
    	$mysqli->query("set names utf8");
    }
?>