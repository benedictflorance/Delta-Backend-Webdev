<!DOCTYPE HTML>
<?php
include("configure.php");
   ini_set('display_errors', 1); 
   ini_set('log_errors',1); 
   error_reporting(E_ALL); 
   mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
   date_default_timezone_set('Asia/Kolkata');
   session_start();
echo "<head><title>TinyPaste-#1 paste tool since 2017</title><link href=\"paste.css\" type=\"text/css\" rel=\"stylesheet\"/>
<link href=\"https://fonts.googleapis.com/css?family=Open+Sans\" rel=\"stylesheet\">
<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'><head><body><div class=\"outer\">
<div class=\"middle\">";
if(isset($_SESSION['username']))
{
echo "<a href =\"logout.php\" id=\"button\" class=\"green left\">Logout</a><a href =\"paste.php\" id=\"button\" class=\"green right\">Paste</a>
	<h1>TinyPaste &copy</h1><h5>#1 paste tool since 2017</h5><h2 class=\"space\">List of Pastes</h2><h2 class =\"space\">Click on the snippet to view it</h2><br><table><tr><th>S. No.</th><th>Snippet</th></tr>";
	$sql="SELECT * FROM snippet";
	$result=mysqli_query($conn,$sql);
	$i=1;
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr><td>".$i."</td><td><a href=\"//{$_SERVER['HTTP_HOST']}"."/"."{$row['url']}\">{$row['title']}</a></td></tr>";
	$i++;
	}
	echo "</table></div></div></body></html>";

}
else
	echo "<h1>Access Denied</h2><br><a id=\"button\" class=\"green\" href=\"login.php\">Click here to log in</a></div></div></body></html>";