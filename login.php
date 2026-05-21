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
  $res=$conn->prepare("select * from utilisateur where username=? and mdp=? limit 1");
  $res->setFetchMode(PDO::FETCH_ASSOC);
  $res->execute(array($username,$passwordh));
  $tab=$res->fetchAll();
  if(count($tab)===0)
      $message="<li>Mauvais login ou mot de passe!</li>";
    else{
      $nas=$conn->prepare("select * from utilisateur where type=? and username=? limit 1");
      $nas->setFetchMode(PDO::FETCH_ASSOC);
      $nas->execute(array($types,$username));
      $tek=$res->fetchAll();
      if (count($tek)!==0)
        {
          $nash=$conn->prepare("select * from Etudiant");
          $nash->setFetchMode(PDO::FETCH_ASSOC);
          $nash->execute();
          $io=$nash->fetchAll();
          if (count($io)!==0) {
            while (a<count($io)) {
              echo io[$a]["nom"]." ".io[$a]["matricule"]." ".io[$a]["niveau"];
              $a++;
            }
          }
        }
      $silv=$conn->prepare("select * from utilisateur where type=? and username=? limit 1");
      $silv->setFetchMode(PDO::FETCH_ASSOC);
      $silv->execute(array($typesa,$username));
      $no=$silv->fetchAll();
      if (count($no)!==0) {
        echo no[0]["nom"]." ".no[0]["matricule"]." ".no[0]["niveau"];
      }

    }
  // code...
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