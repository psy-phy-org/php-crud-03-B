<?php

require_once("dbconnect.php");

$sth=$dbh->prepare('DELETE FROM products WHERE id=' . $_GET['id']);
$sth->execute();

header('location:index.php');
exit();
