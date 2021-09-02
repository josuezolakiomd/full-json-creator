<?php

// Remote
// $db_name = 'vGNmfqSClT';
// $db_host = 'remotemysql.com';
// $db_user = 'vGNmfqSClT';
// $db_pass = 'feU3OqUALR';

// Local
$db_name = 'json_creator';
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';

$pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_pass);