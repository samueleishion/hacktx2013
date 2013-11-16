<?

function HTMLhead($page) {
	?>
<!DOCTYPE html>
<html><head>
 <title>HackTX2013</title>
 <link rel="stylesheet" type="text/css" href="_views/_stys/global.css"> 
 <script src="_views/_scrs/jquery.min.js"></script>
 <script src="_views/_scrs/main.js"></script>
</head><body>
	<?
}

function HTMLnav($page) {
	$des = $_SESSION['HACKpath'];
	?>
<nav></nav>
	<?
}

function HTMLfoot($page) {
	?>
</body></html>
	<?
}

?>