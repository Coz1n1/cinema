<?php
$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'kinoo'
);
 $result=$conn->query("SELECT seanse.data as data,seanse.godzina as godzina,filmy.tytul as tytul from seanse,filmy WHERE seanse.id_filmu=filmy.id");

 while($row = mysqli_fetch_assoc($result)){
    $json[] = [
        "tytul" => $row["tytul"],
        "data" => $row["data"],
        "godzina" => $row["godzina"],
    ];

}
$jsonstring = json_encode($json);
echo $jsonstring;

?>