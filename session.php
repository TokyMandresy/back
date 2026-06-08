<?php
$a=0;
include('connexion.php');
function removev($ID){
  $sva="delete from Etudiant where idCompte=?"
  $sta=$conn->prepare($sva);
  $sta->execute(array($ID));
}

session_start();
if (@$_SESSION['autoriser']!=='oui') {
	header('location:login.php');

}if (isset($_POST['ok'])) {
            @$nom=$_POST['no'];
            @$matric=$_POST['pass'];
            @$id=$_POST['id'];
            $sql="UPDATE Etudiant set nom=? ,matricule=? where idCompte=?";
            $stmt= $conn->prepare($sql);
            $stmt->execute(array($nom, $matric, $id));
            header("Location: ".$_SERVER['PHP_SELF']);
exit;
            
          }
if (isset($_POST['del'])) {

    $id = $_POST['id'];

    $sql = "DELETE FROM Etudiant WHERE idCompte=?";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
}

?>
<!DOCYTPE html>
<html>
	<head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://unpkg.com/jspdf-autotable@3.5.31/dist/jspdf.plugin.autotable.min.js"></script>
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
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
    <?php $op=$conn->prepare("select distinct niveau , idCompte from Etudiant");
            $op->setFetchMode(PDO::FETCH_ASSOC);
            $op->execute();
            $ia=$op->fetchAll(); 
             if (count($ia)!==0) {
              while ($b<count($ia)) { ?>
                <button type="button" style="text-align: left" onclick="update('<?php echo $ia[$b]['niveau'];?>')"><?php echo $ia[$b]['niveau'];?></button>
                <?php $b++;?>
                         <script>
           function update(niveauRecherche){

    const filter = niveauRecherche.toUpperCase();

    const table = document.getElementById("myTable");
    const tr = table.getElementsByTagName("tr");

    for (let i = 1; i < tr.length; i++) {

        const tdniveau = tr[i].getElementsByTagName("td")[2];

        if (tdniveau) {

            const niveau = tdniveau.textContent || tdniveau.innerText;

            if (niveau.toUpperCase().indexOf(filter) > -1) {

                tr[i].style.display = "";

            } else {

                tr[i].style.display = "none";
            }
        }
    }
}    </script>
                    <button type="button" onclick="reset()">all</button>
                      <button type="button" onclick="exportToPDF()">pdf</button>
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
<script>
  

function myFunction() {
    const input = document.getElementById("myInput");
    const filter = input.value.toUpperCase();
    const table = document.getElementById("myTable");
    const tr = table.getElementsByTagName("tr");

    for (let i = 1; i < tr.length; i++) {

        const tdNom = tr[i].getElementsByTagName("td")[0];
        const tdMatricule = tr[i].getElementsByTagName("td")[1];
        const tdniveau=tr[i].getElementsByTagName("td")[2];

        if (tdNom || tdMatricule || tdniveau ) {

            const nom = tdNom.textContent || tdNom.innerText;
            const matricule = tdMatricule.textContent || tdMatricule.innerText;
            const niveau=tdniveau.textContent || tdniveau.innerText;

            if (
                nom.toUpperCase().indexOf(filter) > -1 ||
                matricule.toUpperCase().indexOf(filter) > -1 ||
                niveau.toUpperCase().indexOf(filter) > -1
            ) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
  </script>