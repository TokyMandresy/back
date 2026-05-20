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


/*
try {
  $sql="CREATE TABLE utilisateur (
     id INT  PRIMARY KEY UNIQUE AUTO_INCREMENT , 
     username VARCHAR(50) UNIQUE NOT NULL ,
       mdp VARCHAR(250) NOT NULL,
       type VARCHAR(50) NOT NULL )
        ";


   $conn->exec($sql);
      echo "Table created successfully";
  } catch(PDOException $e) {
  echo "Error creating table: " . $sql . "<br>" . $e->getMessage();
}

try {
  $sql="CREATE TABLE Etudiant (
     id INT PRIMARY KEY UNIQUE AUTO_INCREMENT  , 
       matricule VARCHAR(50) UNIQUE NOT NULL,
       nom VARCHAR(50) NOT NULL,
       niveau VARCHAR(50) NOT NULL,
       idCompte INT(6))
        ";


   $conn->exec($sql);
      echo "Table created successfully";
  } catch(PDOException $e) {
  echo "Error creating table: " . $sql . "<br>" . $e->getMessage();
}*/

	@$username=$_POST["username"] ?? "";
@$password=$_POST["password"] ?? "";
@$type=$_POST["type"] ?? "";

@$matricule=$_POST["matricule"] ?? "";
@$niveau=$_POST["niveau"] ?? "";

@$na=$_POST["nom"] ?? "";
$message="";

echo $username." ".$type;
if (isset($_POST["ok"]) or isset($_POST["okk"]) ) {
  if (empty($username)) $message="erreur";
  if (empty($password)) $message="erreur";
  if (empty($type)) $message="erreur";
  if ($type==="etudiant") {
    if (empty($na)) $message="erreur";
    if (empty($matricule)) $message="erreur";
    if (empty($niveau)) $message="erreur";   
  }
  if ($message==="") {
        $passwordh=password_hash($password, PASSWORD_DEFAULT);
      $rad=$conn->prepare("insert into utilisateur(username,mdp,type) values (?,?,?)");
    $rad->execute(array($username,$passwordh,$type));
    $last_id = $conn->lastInsertId();
    if ($type==="etudiant") {
      
    
    
      $rady=$conn->prepare("insert into Etudiant(nom,matricule,niveau,idCompte) values (?,?,?,?)");
      $rady->execute(array($na,$matricule,$niveau,$last_id));
      
    }
    $message="SUCESS";
    header('location:login.php');
  }
}
/*
if (!empty($username) and !empty($password) and !empty($type)) {
  
    $rad=$conn->prepare("insert into utilisateur(username,mdp,type) values (?,?,?)");
    $rad->execute(array($username,$password,$type));
    $last_id = $conn->lastInsertId();
    if ($type!="admin") {
      
    
    
      $rady=$conn->prepare("insert into Etudiant(nom,matricule,niveau,idCompte) values (?,?,?,?)");
      $rady->execute(array($na,$matricule,$niveau,$last_id));
      echo "string";
                        }        
                                                                                     
  // code...
}else {
  echo "diso";
}
*/



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
  <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body><?php if ($message !== "") echo "<p>" . htmlspecialchars($message) . "</p>"; ?>
	<form method="POST" action="">
<label>username</label>
    <input type="text" name="username" required><br>
    <label>pass</label>
    <input type="password" name="password" required> <br>
    <label>Account Type</label>
            <select name="type" id="accountType" onchange="toggleStudentFields()">
                <option value="etudiant"<?php if($type == 'etudiant') echo 'selected'; ?>>etudiant</option>
                <option value="admin" <?php if($type == 'admin') echo 'selected'; ?>>Admin</option>
            </select>
  <div id="that"> 
		<label>nom</label>
		<input type="text" name="nom"><br>
   

		
		<label>matricule</label>
		<input type="text" name="matricule"><br>
		<label>niveau</label>
		<input type="text" name="niveau"><br>
          </div>

		<button type="submit" name="okk" value="ok">ok</button>
    </form>
    <script>
      function toggleStudentFields() {
            var accountType = document.getElementById('accountType').value;
            var studentSection = document.getElementById('that');
            
            if (accountType === 'admin') {
                studentSection.classList.add('hidden');
            } else {
                studentSection.classList.remove('hidden');
            }
        }

        // Run on page load to preserve state if validation failed
        window.onload = toggleStudentFields;
  </script>
</body>
</html>