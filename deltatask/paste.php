<!DOCTYPE HTML>
<?php
include("configure.php");
   ini_set('display_errors', 1); 
   ini_set('log_errors',1); 
   error_reporting(E_ALL); 
   mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
   date_default_timezone_set('Asia/Kolkata');
session_start();
$submitErr=$fileErr=$titleErr='';
echo "<head><title>TinyPaste-#1 paste tool since 2017</title><link href=\"paste.css\" type=\"text/css\" rel=\"stylesheet\"/>
<link href=\"https://fonts.googleapis.com/css?family=Open+Sans\" rel=\"stylesheet\">
<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'><head><body><div class=\"outer\">
<div class=\"middle\">";
if(isset($_SESSION['username']))
{	
if(isset($_POST['submit'])){
	$errors=0;
	function randomString()
	{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i <7; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
	}
	$title=trim(mysqli_real_escape_string($conn,$_POST['title']));
	$file='';
	$code=$_POST['code'];
	$username=$_SESSION['username'];
	$privacy=$_POST['privacy'];
	$anonymity=$_POST['anonymity'];
	$language=$_POST['language'];
	$expiry=$_POST['expiry'];
	$url=randomString();
	$name=$_FILES['filedoc']['name'];  
    $temp_name=$_FILES['filedoc']['tmp_name'];  
    if(isset($name)){
        if(!empty($name)){      
            $file=file_get_contents($temp_name);
            }
        $ext= pathinfo($name,PATHINFO_EXTENSION);
        }       
	if($expiry=="1")
		$expiry=strtotime("+1 minute");
	else if($expiry=="2")
		$expiry=strtotime("+10 minutes");
	else if($expiry=="3")
		$expiry=strtotime("+1 hour");
	else if($expiry=="4")
		$expiry=strtotime("+1 day");
	else if($expiry=="5")
		$expiry=strtotime("+1 week");
	else if($expiry=="6") 
		$expiry=strtotime("+1 month");
	if(empty($code)&&empty($name))
		{$fileErr="Either code/file should be given";
		 $errors++;}
	if(!empty($code)&&!empty($name))
		{$fileErr="Both code and file isn't allowed";
		 $errors++;}
	if(!preg_match('/^[A-Za-z0-9_~\-!@#\$%\^&\*\(\) ]+$/',$title))
	{
	$titleErr="Only letters, numbers and special characters allowed";
	$errors++;
	}
	if(empty($title))
		{$titleErr="Title should not be empty";
		 $errors++;}
	if(!($ext=="sh"||$ext=="bash"||$ext=="zsh"||$ext=="cs"||$ext=="csx"|$ext=="c"||$ext=="h"||$ext=="cpp"||$ext=="apacheconf"||$ext=="vhost"||$ext=="coffee"||$ext=="cson"||$ext=="iced"||$ext=="diff"||$ext=="patch"||$ext=="c++"||$ext=="h++"||$ext=="hh"||$ext=="html"||$ext=="xhtml"||$ext=="html"||$ext=="xml"||$ext=="http"||$ext=="ini"||$ext=="json"||$ext=="js"||$ext=="cfg"||$ext=="js"||$ext=="java"||$ext=="jsp"||$ext=="md"||$ext=="markdown"||$ext=="mdown"||$ext=="mdwn"||$ext=="mkd"||$ext=="mkdn"||$ext=="mkdown"||$ext=="mak"||$ext=="make"||$ext=="mkfile"||$ext=="mk"||$ext=="d"||$ext=="nginxconf"||$ext=="m"||$ext=="php"||$ext=="php3"||$ext=="php4"||$ext=="php5"||$ext=="phps"||$ext=="phpt"||$ext=="inc"||$ext=="pl"||$ext=="pm"||$ext=="perl"||$ext=="cgi"||$ext=="plx"||$ext=="py"||$ext=="gyp"||$ext=="wsgi"||$ext=="jruby"||$ext=="macruby"||$ext=="rake"||$ext=="rb"||$ext=="rbx"||$ext=="sql"||$ext=="mysql"||$ext=="sh-session"||$ext=="ps1"||$ext=="doc"||$ext=="docx"||$ext=="txt"||$ext=="css"))
	{
		$fileErr="Invalid file format. Try again.";
		$errors++;
	}
	if(!$errors)
	{
	$sql =$conn->prepare("INSERT INTO snippet(title,code,username,public,anonymous,language,expiry,filename,url) VALUES(?,?,?,?,?,?,?,?,?)");
	$sql->bind_param("sssssssss",$title,$code,$username,$privacy,$anonymity,$language,$expiry,$file,$url);
	$result=$sql->execute();
	$submitErr="Pasted successfully. Paste can be viewed at ".$_SERVER['HTTP_HOST']."/".$url ;
	}
}
	echo "<a href =\"logout.php\" id=\"button\" class=\"green left\">Logout</a><a href =\"list.php\" id=\"button\" class=\"green right\">List of Pastes</a>
	<h1 class=\"push\">TinyPaste &copy</h1><h5 class=\"push\">#1 paste tool since 2017</h5><h2 >Welcome, ".ucwords($_SESSION['name'])."!</h2>
	<form action=\"";echo htmlentities($_SERVER["PHP_SELF"]);echo "\" method=\"post\" enctype=\"multipart/form-data\">
	<h2>New Paste</h2>
	<span class=\"success\">";echo $submitErr;echo "</span><br>
	<span style=\"color:red\">All * fields are mandatory</span><br>
	<textarea spellcheck=\"false\" onkeyup=\"this.style.height='24px'; this.style.height = this.scrollHeight + 12 + 'px';\" name=\"code\"></textarea><br>
	<label> Title:<span style=\"color:red\">*</span><input type = \"text\" name = \"title\"/></label><br><span class=\"error\">";echo $titleErr;echo"</span><br>
	<label> Upload File?  <input type = \"file\" name = \"filedoc\"/></label><br><span class=\"error\">";echo $fileErr;echo"</span><br>
	Privacy:<span style=\"color:red\">*</span>
	<label><input type=\"radio\" name=\"privacy\" value=\"yes\" checked>Public</label>
	<label><input type=\"radio\" name=\"privacy\" value=\"no\">Private</label><br>
	Anonymity:<span style=\"color:red\">*</span>
	<label><input type=\"radio\" name=\"anonymity\" value=\"no\" checked>Non-Anonymous</label>
	<label><input type=\"radio\" name=\"anonymity\" value=\"yes\">Anonymous</label><br>
	Language:<span style=\"color:red\">*</span><select name=\"language\">
				<option value = \"no-highlight\">None</option>
				<option value = \"apache\">Apache</option>
				<option value = \"bash\">Bash</option>
				<option value = \"cs\">C#</option>
				<option value = \"cpp\">C,C++</option>
				<option value = \"css\">CSS</option>
				<option value = \"coffeescript\">CoffeeScript</option>
				<option value = \"diff\">Diff</option>
				<option value = \"html\">HTML,XML</option>
				<option value = \"http\">HTTP</option>
				<option value = \"ini\">Ini</option>
				<option value = \"json\">JSON</option>
				<option value = \"java\">Java</option>
				<option value = \"javascript\">JavaScript</option>
				<option value = \"makefile\">Makefile</option>
				<option value = \"markdown\">Markdown</option>
				<option value = \"nginx\">Nginx</option>
				<option value = \"objectivec\">Objective C</option>
				<option value = \"php\">PHP</option>
				<option value = \"perl\">Perl</option>
				<option value = \"python\">Python</option>
				<option value = \"ruby\">Ruby</option>
				<option value = \"sql\">SQL</option>
				<option value = \"shell\">Shell Session</option>
			</select><br>
	Expiry:<span style=\"color:red\">*</span><select name=\"expiry\">
				  <option value = \"1\">1 Minute</option>
				  <option value = \"2\">10 Minutes</option>
                  <option value = \"3\">1 Hour</option>  
                  <option value = \"4\">1 Day</option>
                  <option value = \"5\">1 Week</option>
                  <option value = \"6\">1 Month</option>
                  <option value = \"none\" selected>Never</option>
                  </select><br>
	<input id=\"button\"class=\"red\" type =\"submit\" class=\"red\" name=\"submit\" value = \"Paste\"/><br>
	</form>";

}
else
	echo "<h1>Access Denied</h2><br><a id=\"button\" class=\"green\" href=\"login.php\">Click here to log in</a></div></div></body></html>";
?>