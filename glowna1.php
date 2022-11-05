<?php
session_start();
if (!isset($_SESSION["login"])){
header("Location: logowanie.php");
exit();
}else {
  $conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'kinoo'
  );
  $sql = "SELECT * FROM seanse INNER JOIN filmy WHERE `seanse`.`id_filmu` = `filmy`.`id` ORDER BY `seanse`.`data`;";
  $result = mysqli_query($conn, $sql);
  $response = array();
  while($row = mysqli_fetch_assoc($result)){
    $response[] = $row;
  };
}

?>
<HTML>
<HEAD>
  <TITLE>Boro Films</TITLE>
  <link rel="stylesheet" href="./styles/glowna1.css">
</HEAD>
<BODY>
  <h2>Witaj <?= $_SESSION["login"] ?>, wybierz coś dla siebie</h2>
<div class="main">
  <?php foreach ($response as $key => $value) : ?>
    <div class="calosc">
    <img src='./assets/<?= $value['tytul'] ?>.jpg' alt="" class="zdjecie">    
    <h2><?= $value["tytul"] ?></h2>
    <h3><?= $value["data"] ?></h3>
    <h3><?= $value["godzina"] ?></h3>
    <a href="miejsca.php?id=<?= $value["id_filmu"] ?>" ><button class="przycisk">Zarezerwuj</button></a>
    </div>
  <?php endforeach; ?>
</div>
<a href="wyloguj.php"><button class="przycisk">Wyloguj</button></a>

</BODY>
</HTML>
