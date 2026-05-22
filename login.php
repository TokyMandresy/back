<?php

  @$username=$_POST["n"] ?? "";
@$password=$_POST["pa"] ?? "";
$types="admin";
$typesa="etudiant";
$a=0;
$passwordh=password_hash($password, PASSWORD_DEFAULT);
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
if (isset($_POST['ok'])) {
  $CM=$conn->prepare("select mdp from utilisateur where username=?");
  $CM->setFetchMode(PDO::FETCH_ASSOC);
  $CM->execute(array($username));
  $tap=$CM->fetchAll();
  if (count($tap)!==0) {
    if (password_verify($password, $tap[0]["mdp"])) {
      $nas=$conn->prepare("select * from utilisateur where type=? and username=? limit 1");
      $nas->setFetchMode(PDO::FETCH_ASSOC);
      $nas->execute(array($types,$username));
      $tek=$nas->fetchAll();
      if (count($tek)!==0)
        {
          $_SESSION['autoriser']='oui';
          $_SESSION['type']='admin';
          header('location:session.php');
        }
      
        $silv=$conn->prepare("select * from utilisateur where type=? and username=? limit 1");
      $silv->setFetchMode(PDO::FETCH_ASSOC);
      $silv->execute(array($typesa,$username));
      $no=$silv->fetchAll();
      if (count($no)!==0) {
          $_SESSION['autoriser']='oui';
          $_SESSION['type']="etudiant";
          $_SESSION['matricule']=$no[0]["nom"]." ".$no[0]["matricule"]." ".$no[0]["niveau"];
          header('location:session.php');
    }

    }
  // code...
}
}





?>


<!DOCTYPE html>
<html>
<head> </head>
  <body>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <form action="" method="post">
    <label>username</label>
    <input type="number" name="n"><br>
    <label>pass</label>
    <input type="password" name="pa"><br>
    <button type="submit" name="ok" >connecter</button>


</body>
</html>