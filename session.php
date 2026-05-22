<?php
$a=0;
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
	header('location:login.php');

		// code...
	
	// code...
}/*else {
	if ($_SESSION['type']==="admin") {
		 nash=$conn->prepare("select * from Etudiant");
          $nash->setFetchMode(PDO::FETCH_ASSOC);
          $nash->execute();
          $io=$nash->fetchAll();
           if (count($io)!==0) {
           	    echo $io[$a]["nom"]." ".$io[$a]["matricule"]." ".$io[$a]["niveau"];
              $a++;
           }
$

	} 
	if ($_SESSION['type']==="etudiant") {
		echo $_SESSION['matricule'];
	}

}
*/

?>
<!DOCYTPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="" />
	</head>
	<body>
		<header>
			
			<a href="deconnexion.php">Quitter la session</a>
		</header>
		<h1>
		<?php 
			if ($_SESSION['type']==="admin") {
				$nash=$conn->prepare("select * from Etudiant");
          $nash->setFetchMode(PDO::FETCH_ASSOC);
          $nash->execute();
          $io=$nash->fetchAll();
           if (count($io)!==0) {
           	    echo $io[$a]["nom"]." ".$io[$a]["matricule"]." ".$io[$a]["niveau"];
              $a++;
           }

			}
			if ($_SESSION['type']==='etudiant') {
				echo $_SESSION['matricule'];
			}
		?>
		<span>
		
		</span>
		</h1>
	</body>
</html>
