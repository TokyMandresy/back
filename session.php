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
function removev($ID){
  $sva="delete from Etudiant where idCompte=?"
  $sta=$conn->prepare($sva);
  $sta->execute(array($ID));
}

session_start();
if (@$_SESSION['autoriser']!=='oui') {
	header('location:login.php');

		// code...
	
	// code...
}if (isset($_POST['ok'])) {
            @$nom=$_POST['no'];
            @$matric=$_POST['pass'];
            @$id=$_POST['id'];
            $sql="UPDATE Etudiant set nom=? ,matricule=? where idCompte=?";
            $stmt= $conn->prepare($sql);
            $stmt->execute(array($nom, $matric, $id));
            
          }
if (isset($_POST['del'])) {

    $id = $_POST['id'];

    $sql = "DELETE FROM Etudiant WHERE idCompte=?";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
}


    /*else {
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
			<table>
  <thead>
    <tr>
      <th>Nom</th>
      <th>matricule</th>
      <th>niveau</th>
    </tr>
  </thead>
  <tbody>

		<?php 
			if ($_SESSION['type']==="admin") {
				$nash=$conn->prepare("select * from Etudiant");
          $nash->setFetchMode(PDO::FETCH_ASSOC);
          $nash->execute();
          $io=$nash->fetchAll();
           if (count($io)!==0) {?>

           	<?	 while ($a<count($io)) {?>
           	    <td><?php echo $io[$a]["nom"];?></td>
           	    <td><?php echo 	$io[$a]["matricule"];?></td>
           	    <td><?php echo 	$io[$a]["niveau"]; ?></td>
                <td>
                    <div style="display:flex; gap:8px; align-items:center;">
        
        <button onclick="document.getElementById('popup<?= $io[$a]['idCompte']; ?>').showModal()">
            Modifier
        </button> 
       
    
          <form action="" method="post" style="margin: 0;">


            <input type="hidden" name="id" value="<?php echo $io[$a]['idCompte'];?>">
            <button name="del" type="submit">del</button>
        </form> 
    </div>
</td> 
                <?php $cd=$io[$a]["idCompte"]; ?>


<dialog id="popup<?= $io[$a]["idCompte"]; ?>">
   <form action="" method="post">
   	    <input type="hidden" 
           name="id" 
           value="<?= $io[$a]['idCompte']; ?>">
    <label>nom</label>
    <input type="text" name="no" value="<?php echo $io[$a]["nom"];?>"><br>
    <label>matricule</label>
    <input type="text" name="pass" value="<?php echo $io[$a]["matricule"]; ?>"><br>
  
       <button type="submit" name="ok">
                    Enregistrer
                </button>
  	         <button 
                    type="button"
                    onclick="document.getElementById('popup<?= $io[$a]['idCompte']; ?>').close()"
                >
                    Fermer
                </button>
              </form>

</dialog>

           	     </tr>
             <?php $a++;}
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
