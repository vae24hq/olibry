<?php
oFile::Inc(oBJCT.'db'.DS.'pdo.inc');
oFile::Inc(oBJCT.'db'.DS.'mysqli.inc');
// $dbconfig = array('name' => "aodb", 'user' => "ao", 'pw' => "AO20", 'host' => "ao.co", 'driver' => 'iPDO');
$dbconfig = array('name' => "aodb", 'user' => "ao", 'pw' => "AO20", 'host' => "ao.co", 'driver' => 'iMySQLi');
// $dbconfig = array('name' => "oNONE", 'user' => "ao", 'pw' => "AO20", 'host' => "ao.co", 'driver' => 'iMySQLi');
$db = new oDatabase($dbconfig);
// $db = new oDatabase($dbconfig);
// $db = new oSQLi($dbconfig);
$dbo = $db->dbo();



$v = '';
// $q = "SELECT COUNT(`auid`) FROM `harv_logs`"; #TODO count function
// $q = "SELECT * FROM `harv_logs`";
// $q = "INSERT INTO `harv_logs` (`action`) VALUES ('runam')";
// $v = $db->SQL($q);
// $v = $db->isDB('aodemo');
// $v = $db->createDB('ao');
// $v = $db->useDB('ao');
$q = "SELECT * FROM `harv_logs`";
$v = $db->SQL($q);

echo oPrint::Neat($v);