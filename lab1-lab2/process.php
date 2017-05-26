<html>
<head>
	<meta charset="utf-8">
	<title>
		Processed
	</title>
	<link rel="stylesheet" href="styles.css">
	<script>
	function pageSetup() {
			var form = document.getElementsByClassName("global")[0];
			var offsetHeight = (window.innerHeight - form.offsetHeight)/2;
			var offsetWidth = (window.innerWidth - form.offsetWidth)/2;

			form.style.position = "absolute";
			form.style.left = offsetWidth + "px";
		}
	</script>
</head>
<body onload="pageSetup();" onresize="pageSetup();">
<div class="global">
<?php 
	$target_file;
	$users = array(
	    "Admin" => "admin",
	    "Moder" => "pass",
	    "User1" => "1234",
	    "B0bby" => "1_like_p1zza",
	);

	if(!empty($_GET))
	{
		echo "Values were sent with GET method.<br>";
		$login = $_GET['login'];
		$pass = $_GET['pass'];
		$prog = $_GET['progname'];
		$filename = $_GET['userfile'];
	}
	elseif(!empty($_POST))
	{
		echo "Values were sent with POST method.<br>";
		$login = $_POST['login'];
		$pass = $_POST['pass'];
		$prog = $_POST['progname'];
		$filename = $_FILES["userfile"]["name"];
	}

	
	$ext = end(explode(".", $filename));
	$target_ext = 'jpg';

	
function checkData()
{
	global $ext, $target_ext, $users, $login, $pass, $target_file, $filename;

	if(isset($users[$login]))
	{
		echo "Sorry. User with this nickname is already registrated!<br>";
		return false;
	}

	
	if(isset($_GET['userfile']))
	{
		echo "To upload an image you should select POST method.<br>";
	}
	else
	{
		if(!isset($_POST['submit']) AND !isset($_GET['submit']))
		{
			echo "Sorry, there was an error uploading your file.<br>";
			return false;
		}
		if($ext != $target_ext)
		{
			echo "Sorry. Chosen file has not $target_ext extension.<br>";
			return false;
		}

		if($_FILES['userfile']["size"] > 2000000)//2MB
		{
			echo "Your avatar file is too large. Uplod file up to 2MB.<br>";
			return false;
		}

		$target_dir = "avatars/";
		$target_file = $target_dir . basename($filename);
		if(!move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file))
		{
			echo "Sorry, there was an error uploading your file.<br>";
			return false;
		}
	}
	

	$users[$login] = $pass;

	return true;
}

function output()
{
	global $login, $prog, $target_file;
	echo "Hello $login!<br>";
	
	echo "<img src= \"$target_file\" class=\"avatar\"><br>"; 


	if(!empty($prog))
	{
		echo "Output of \"$prog\" on server is:<br>";
		system($prog);
		echo "<br>";
	}
}

if(checkData())
{
	echo "Successfully registreated!<br>";
	output();
	echo "<a href=\"galery/index.html\" class=\"button\">OK</a>";
}
else
{
	echo "<a href=\"index.html\" class=\"button\">Back</a>";
}

?>
</div>
</body>
</html>