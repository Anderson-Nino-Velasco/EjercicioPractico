<?php

$HOST_DB = 'localhost:3306';
$USER_DB = 'root';
$PASS_DB = '';
$NAME_DB = 'basedatos';

$conn = mysqli_connect($HOST_DB, $USER_DB, $PASS_DB, $NAME_DB);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else{
    //echo "Connected to DB!";
}
