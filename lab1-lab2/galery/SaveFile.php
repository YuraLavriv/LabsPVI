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

	$file = $_POST['fileurl'];
	$file = str_replace('https://', 'http://', $file);
	$localRef = "files/" . basename($file);

	$content = @fopen($file,'r');
	if(!$content)
		echo "Sorry. Cant find this file.<br>";
	elseif(@file_put_contents($localRef, fopen($file, 'r')) === FALSE)
		echo "Error occurs while loading file!<br>";
	else
	{
		echo "Your file has been uploaded!<br>";
		echo "<a href = \"$localRef\" >Your file</a><br>";
	}

?>
</div>
</body>
</html>