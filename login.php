<?php

  @$username=$_POST["n"] ?? "";
@$password=$_POST["pa"] ?? "";
$types="admin";
$typesa="etudiant";
$a=0;
$passwordh=password_hash($password, PASSWORD_DEFAULT);
include('connexion.php');

 
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
          exit();
        }
      
        $silv=$conn->prepare("select * from utilisateur where type=? and username=? limit 1");
      $silv->setFetchMode(PDO::FETCH_ASSOC);
      $silv->execute(array($typesa,$username));
      $no=$silv->fetchAll();
      if (count($no)!==0) {
          $_SESSION['autoriser']='oui';
          $_SESSION['type']="etudiant";
       $nash=$conn->prepare("select * from Etudiant where idCompte=? limit 1");
          $nash->setFetchMode(PDO::FETCH_ASSOC);
          $nash->execute(array(($no[0]['id'])));
          $io=$nash->fetchAll();
          if (count($io)!==0) {
            $_SESSION['matricule']=strtoupper($io[0]['nom']." ".$io[0]['matricule']." ".$io[0]['niveau']);
            header('location:toky3.php');
            exit();
    }

    }
  // code...
}
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