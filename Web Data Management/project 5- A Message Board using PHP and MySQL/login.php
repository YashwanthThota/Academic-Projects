<html>
<head><title>login page</title></head>
<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors','On');

try {
  $dbh = new PDO("mysql:host=127.0.0.1:3306;dbname=board","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  $dbh->beginTransaction();
if(isset($_GET['username'])){
  $stmt = $dbh->prepare('select username, password from users where username ="'.$_GET['username'].'"and password="'.md5($_GET['password']).'"');
  $stmt->execute();
  if ($row = $stmt->fetch()) {
   header("Location: "."board.php");
  }
}
} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}
//action="board.php"
?>
<form action="board.php" method="get">
  Username:<br>
  <input type="text" name="username">
  <br>
  Password:<br>
  <input type="password" name="password">
  <br><br>
  <input type="submit" name="login" value="login">
</form>
</body>
</html>
