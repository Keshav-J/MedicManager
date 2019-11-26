<?php

include_once 'dbh.inc.php';

session_start();
session_unset();

session_destroy();

header("Location: ../index.php");
exit();

?>