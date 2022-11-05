<?php 
$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'kinoo'
);
$ran = json_decode($_POST['wybrane']);

for($i=0;$i<sizeof($ran);$i++){
$sql = "INSERT INTO rezerwacje(id, id_uzytkownika, rzad, miejsce,id_seansu) VALUES ('','".$ran[$i]->{'uzytkownik'}."','".$ran[$i]->{'rzad'}."','".$ran[$i]->{'miejsce'}."','".$ran[$i]->{'id'}."')";
$result = $conn->query($sql);
}
?>
