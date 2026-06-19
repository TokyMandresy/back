
<?php
try {
$conn = new PDO(
    'mysql:host=localhost;dbname=database;charset=utf8',
    'root',
    ''
);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  

}catch(PDOException $e) {
  die("Could not connect. " . $e->getMessage());
} 
session_start();

if (@$_SESSION['autoriser']!=='oui') {
	header('location:toky2.php'); }

?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<?php
			if ($_SESSION['type']==="admin") {

	?>


<input type="button" onclick="location.href='toky3.php';" value="Etudiants" />


<input type="button" onclick="location.href='toky5.php';" value="Niveau" />
<?php } 


	?>





</body>
</html>