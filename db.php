<?php
define('HOSTNAME','localhost');
define('DB_USERNAME','perlu');
define('DB_PASSWORD','perlu');
define('DATABASE','perlu');
$link = mysql_connect(constant('HOSTNAME'), constant('DB_USERNAME'), constant('DB_PASSWORD')) or die("Database connection error, please check!");
mysql_select_db(constant('DATABASE'), $link) or die("Connection to the defined database not possible, please check!");
?>
