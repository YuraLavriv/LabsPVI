<html>
<head>
	<meta charset="utf-8">
	<title>
		Hash code
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
		$target_file = "uploads/" . basename($_FILES["file"]["name"]);


		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) 
		{
	        echo "Hash of your file is:<br>";
	        echo hash_file('md5', $target_file);
	    } 
	    else 
	    {
	        echo "Sorry, there was an error uploading your file.";
	    }

?>
</div>
</body>
</html>