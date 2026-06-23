 <?php 
$c=0;
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
	header('location:toky2.php');

		// code...
	
	// code...
}
if (isset($_POST['ok'])) {
            @$nom=$_POST['no'];
            @$nomp=$_POST['id'];
                        $sql="UPDATE niveau set id=?";
            $stmt= $conn->prepare($sql);
            $stmt->execute(array($nomp));
            
          }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

</body>
</html>