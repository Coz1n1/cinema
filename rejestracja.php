<?php 
    $conn = mysqli_connect(
        'localhost',
        'root',
        '',
        'kinoo'
    );
    
if(isset($_POST['login'],$_POST['haslo'])){
    $login = $_POST['login'];
    $numer = $_POST['numer'];
    $haslo = $_POST['haslo'];
    $result2 = $conn->query(
        "select nazwa,nr from uzytkownicy where nazwa like '{$_POST["login"]}' or nr like '{$_POST["numer"]}'"
    );
    if(strlen($login)>1 && strlen($numer)==9 && strlen($haslo)>5){
        if($result2->num_rows>0){
            echo "<h2 style='color: white'>Taki login lub numer juz istnieje</h2>";
        }else {
            $haslo2 = sha1($haslo);
            $sql = "INSERT INTO uzytkownicy(id, nazwa, nr, haslo) VALUES ('','$login','$numer','$haslo2')";
            $result = $conn->query($sql);
            echo "zostales zarejestrowany";
		    header("Location: logowanie.php");

        }
    }else{
        echo "<p style='color: white;'>Blad, sprawdz poprawnosc i dlugosc danych</p>";
    }
}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boro Films</title>
    <link rel="stylesheet" href="./styles/styles1.scss">
    <link rel="stylesheet" href="./styles/nav.css">
</head>
<body>
    <form class="login-form" method="post">
    <h1 class="login-text">Rejestracja</h1>
    <input type="text" class="login-username" autofocus="true" required="true" placeholder="Podaj login" name="login"/>
    <input type="text" class="login-username" autofocus="true" required="true" placeholder="Podaj numer telefonu" name="numer"/>
    <input type="password" class="login-password" required="true" placeholder="Haslo" name="haslo"/>
    <input type="submit" value="Zarejestruj" class="login-submit" />
    </form>
    <a class="p-follow" href="logowanie.php"><button class="follow">Zaloguj</button></a>
    <div class="underlay-photo"></div>
    <div class="underlay-black"></div> 
</body>
</html>