<html>
<head>
<title>TinyPaste-#1 paste tool since 2017</title>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css">
<link rel="stylesheet" href="deltatask/snippet.css" type="text/css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.8.0/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'><head><body><div class="outer">
<div class="middle">
<?php
   include("configure.php");
   ini_set('display_errors', 1); 
   ini_set('log_errors',1); 
   error_reporting(E_ALL); 
   mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
   date_default_timezone_set('Asia/Kolkata');
   session_start();
   if(isset($_GET['url']))
   {
   $url=$_GET['url'];
   $flag=1;
   $sql=$conn->prepare("SELECT title,code,username,public,anonymous,language,expiry,filename FROM snippet WHERE url=? LIMIT 1");
   $sql->bind_param("s",$url); 
   $sql->execute(); 
   $result=$sql->get_result();
   $row=mysqli_fetch_array($result);
   $title=$row['title'];
   $code=htmlspecialchars($row['code']);
   $username=$row['username'];
   $public=$row['public'];
   $anonymous=$row['anonymous'];
   $language=$row['language'];
   $expiry=$row['expiry'];
   $filename=htmlspecialchars($row['filename']);
   if(empty($code))
   		$a=0;
   else
   		$a=1;
   if($expiry=="none")
   		$b=0;
   else
   		$b=1;
	if(empty($_SESSION['username']))
		echo "<h1>Access Denied<h1><br><a href=\"/deltatask/login.php\" id=\"button\" class=\"red\">Login</a></div></div></body></html>";
	else if(time()>$expiry&&$b&&!empty($expiry))
		echo "<a href=\"/deltatask/logout.php\" id=\"button\" class=\"green left\">Log Out</a><a href=\"/deltatask/paste.php\" id=\"button\" class=\"green right\">Paste</a><br><h1>Paste expired</h1>";
	else if(isset($_SESSION['username'])&&!empty($_SESSION['username'])&&mysqli_num_rows($result)>0){
		echo "<a href=\"/deltatask/logout.php\" id=\"button\" class=\"green left\">Log Out</a><a href=\"/deltatask/paste.php\" id=\"button\" class=\"green right\">Paste</a><br>";
  	if($public=="yes")
  	{
  		if($anonymous=="yes"){
  			echo "<h1>{$title}</h1><h2>Pasted by an anonymous user</h2>";
  			if($a)
  				echo "<pre><code class=\"".$language."\">".nl2br($code)."<pre><code></div></div></body></html>";
  			else
  			    echo "<pre><code class=\"".$language."\">".nl2br($filename)."<pre><code></div></div></body></html>";
  		}
  		else{
  			echo "<h1>{$title}</h1><h2>Pasted by {$username}</h2>";
  			if($a)
  				echo "<pre><code class=\"".$language."\">".nl2br($code)."<pre><code></div></div></body></html>";
  			else
  			    echo "<pre><code class=\"".$language."\">".nl2br($filename)."<pre><code></div></div></body></html>";
  			}
  	}
  	else
  	{
  		if($username==$_SESSION['username'])
  		{
  		if($anonymous=="yes"){
  			echo "<h1>{$title}</h1><h2>Pasted by an anonymous user</h2>";
  			if($a)
  				echo "<pre><code class=\"".$language."\">".nl2br($code)."<pre><code></div></div></body></html>";
  			else
  			    echo "<pre><code class=\"".$language."\">".nl2br($filename)."<pre><code></div></div></body></html>";
  		}
  		else{
  			echo "<h1>{$title}</h1><h2>Pasted by {$username}</h2>";
  			if($a)
  				echo "<pre><code class=\"".$language."\">".nl2br($code)."<pre><code></div></div></body></html>";
  			else
  			    echo "<pre><code class=\"".$language."\">".nl2br($filename)."<pre><code></div></div></body></html>";
  			}

  		}
  		else
  			echo "<h1>Access Denied</h1><h2>Sorry, this is a private paste</h2>";
  		
   	}
}
   else
   	echo "<a href=\"/deltatask/logout.php\" class=\"red left\" id=\"button\">Log Out</a><a href=\"/deltatask/paste.php\" id=\"button\" class=\"red right\">Paste</a><h1>Paste does not exist</h1>";
}
?>