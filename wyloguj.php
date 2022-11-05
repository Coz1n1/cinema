<?php
session_start();
?>
<HTML>
<HEAD>
  <TITLE>Wylogowanie</TITLE>
</HEAD>
<BODY>
<?php
  header("Location: glowna.php");
  session_destroy();
?>
</BODY>
</HTML>
