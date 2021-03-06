<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="shortcut icon" href=".favicon.ico">
<title>Welcome to Showcase | Eirvo™</title>
<meta name="description" content="Showcase by Eirvo is a web directory listing implementation by Deron Ellse">
<link rel="stylesheet" href=".style.css">
<script src=".sorttable.js"></script>
</head>

<body>
<div id="container">
  <h1>Showcase:: Eirvo™ Listing</h1>
  <hr>
  <div class="description">
    <p>Welcome to <i>Showcase</i> by <b>Eirvo™</b></p>
    <p>Showcase is a web directory listing implementation by Deron Ellse.<br>
      Thank you for taking time out to visit.</p>
    <p>To view a director or sample website, click on the name and its content will on your browser.</p>
    <p class="notice"> <strong style="color: #333;">Quick Contact</strong><br>
      email: <i>allo@eirvo.ga</i></br>
      website: <i>www.eirvo.ga</i></p>
  </div>
  <table class="sortable" style="font-size: 0.8em; line-height: 1.5;">
    <thead>
      <tr>
        <th style='text-align:left; min-width: 50%;'>Filename</th>
        <th style='text-align:center;'>Type</th>
        <th style='text-align:center; width: 20%;'>Size</th>
        <th style='text-align:right;'>Modified</th>
      </tr>
    </thead>
    <tbody>
      <?php

// Adds pretty filesizes
function pretty_filesize($file) {
$size=filesize($file);
if($size<1024){$size=$size." Bytes";}
elseif(($size<1048576)&&($size>1023)){$size=round($size/1024, 1)." KB";}
elseif(($size<1073741824)&&($size>1048575)){$size=round($size/1048576, 1)." MB";}
else{$size=round($size/1073741824, 1)." GB";}
return $size;
}

// Checks to see if veiwing hidden files is enabled
if($_SERVER['QUERY_STRING']=="hidden")
{$hide="";
$ahref="./";
$atext="Hide";}
else
{$hide=".";
$ahref="./?hidden";
$atext="Show";}

// Opens directory
$myDirectory=opendir(".");

// Gets each entry
while($entryName=readdir($myDirectory)) {
$dirArray[]=$entryName;
}

// Closes directory
closedir($myDirectory);

// Counts elements in array
$indexCount=count($dirArray);

// Sorts files
sort($dirArray);

// Loops through the array of files
for($index=0; $index < $indexCount; $index++) {

// Decides if hidden files should be displayed, based on query above.
if(substr("$dirArray[$index]", 0, 1)!=$hide) {

// Resets Variables
$favicon="";
$class="file";

// Gets File Names
$name=$dirArray[$index];
$namehref=$dirArray[$index];

// Gets Date Modified
$modtime=date("M j Y g:i A", filemtime($dirArray[$index]));
$timekey=date("YmdHis", filemtime($dirArray[$index]));


// Separates directories, and performs operations on those directories
if(is_dir($dirArray[$index]))
{
$extn="&lt;Directory&gt;";
$size="&lt;Directory&gt;";
$sizekey="0";
$class="dir";

// Gets favicon.ico, and displays it, only if it exists.
if(file_exists("$namehref/favicon.ico"))
{
$favicon=" style='background-image:url($namehref/favicon.ico);'";
$extn="&lt;Website&gt;";
}

// Cleans up . and .. directories
if($name=="."){$name=". (Current Directory)"; $extn="&lt;System Dir&gt;"; $favicon=" style='background-image:url($namehref/.favicon.ico);'";}
if($name==".."){$name=".. (Parent Directory)"; $extn="&lt;System Dir&gt;";}
}

// File-only operations
else{
// Gets file extension
$extn=pathinfo($dirArray[$index], PATHINFO_EXTENSION);

// Prettifies file type
switch ($extn){
case "png": $extn="PNG Image"; break;
case "jpg": $extn="JPEG Image"; break;
case "jpeg": $extn="JPEG Image"; break;
case "svg": $extn="SVG Image"; break;
case "gif": $extn="GIF Image"; break;
case "ico": $extn="Windows Icon"; break;

case "txt": $extn="Text File"; break;
case "log": $extn="Log File"; break;
case "htm": $extn="HTML File"; break;
case "html": $extn="HTML File"; break;
case "xhtml": $extn="HTML File"; break;
case "shtml": $extn="HTML File"; break;
case "php": $extn="PHP Script"; break;
case "js": $extn="Javascript File"; break;
case "css": $extn="Stylesheet"; break;

case "pdf": $extn="PDF Document"; break;
case "xls": $extn="Spreadsheet"; break;
case "xlsx": $extn="Spreadsheet"; break;
case "doc": $extn="Microsoft Word Document"; break;
case "docx": $extn="Microsoft Word Document"; break;

case "zip": $extn="ZIP Archive"; break;
case "htaccess": $extn="Apache Config File"; break;
case "exe": $extn="Windows Executable"; break;

default: if($extn!=""){$extn=strtoupper($extn)." File";} else{$extn="Unknown";} break;
}

// Gets and cleans up file size
$size=pretty_filesize($dirArray[$index]);
$sizekey=filesize($dirArray[$index]);
}

// Output
if($name !='index.php'){
echo("
<tr class='$class'>
<td style='text-align:left;'><a href='./$namehref'$favicon class='name' title='view $name'>$name</a></td>
<td style='text-align:center;'><a href='./$namehref'>$extn</a></td>
<td style='text-align:center;' sorttable_customkey='$sizekey'><a href='./$namehref'>$size</a></td>
<td style='text-align:right;' sorttable_customkey='$timekey'><a href='./$namehref'>$modtime</a></td>
</tr>");
}
}
}
?>
    </tbody>
  </table>
  
  <h2><?php echo("<a href='$ahref'>$atext hidden files</a>");?></h2>
  <hr>
  <p class="description"> Copyright &copy; <a href="http://www.eirvo.ga/?ref=showcase">Eirvo™ <?php echo date('Y');?></p>
</div>
</body>
</html>
