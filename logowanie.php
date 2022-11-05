<?php
$conn = mysqli_connect(
	'localhost',
	'root',
	'',
	'kinoo'
);

if(isset($_POST['login'],$_POST['pass']))
{
	$login = $_POST['login'];
	$haslo2 = $_POST['pass'];
	$result1=$conn->query("SELECT id,nazwa,haslo FROM uzytkownicy WHERE nazwa = '".$login."' AND haslo = '".sha1($haslo2)."';");
	$row_cnt = $result1->num_rows;
	if ($row_cnt>0){
		session_start();
		while($row = mysqli_fetch_assoc($result1)){
			$_SESSION['login']=$_POST['login'];
			$_SESSION['id']=$row['id'];
		}
		header("Location: glowna1.php");
		exit();
	}
	else{
		$error = "<p style='color: white;'>"."bledny login lub haslo"."</p>"."</br>";
	}
}
else
	$error = false;
?>
<HTML>
<HEAD>
  <TITLE>Boro Films</TITLE>
  <link rel="stylesheet" href="./styles/styles.scss">
  <link rel="stylesheet" href="./styles/nav.css">
</HEAD>
<BODY>
<?php
  echo $error ? $error : "";
?>
  <form class="login-form" method="POST">
  <p class="login-text">Podaj login i haslo</p>
  <input type="text" class="login-username" autofocus="true" required="true" placeholder="Username" name="login"/>
  <input type="password" class="login-password" required="true" placeholder="Password" name="pass"/>
  <input type="submit" value="Login" class="login-submit" />
</form>

<div class="underlay-photo"></div>
<div class="underlay-black"></div> 
<a class="p-follow" href="rejestracja.php"><button class="follow">Zarejestruj</button></a>

</BODY>
</HTML> 