<?php

$host        = "host=127.0.0.1";
$port        = "port=5432";
$dbname      = "dbname=wikiprice";
$credentials = "user=wikiprice password=Ivigin_213144";

$db = pg_connect( "$host $port $dbname $credentials" ) or die('Could not connect: ' . pg_last_error());
