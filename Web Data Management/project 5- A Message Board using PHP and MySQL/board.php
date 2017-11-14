
<?php
if(isset($_GET['logout'])){
  session_destroy();
   header("Location: "."login.php");
}
 ?>
<html>
<head><title>Message Board</title></head>
<body>
  <?php session_start();
  error_reporting(E_ALL);
  ini_set('display_errors','On');
  try {
    $dbh = new PDO("mysql:host=127.0.0.1:3306;dbname=board","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $dbh->beginTransaction();
  if(isset($_GET['username'])){
    $stmt = $dbh->prepare('select username, password, fullname from users where username ="'.$_GET['username'].'"and password="'.md5($_GET['password']).'"');
    $stmt->execute();
    if ($row = $stmt->fetch()) {
     $_SESSION['username']=$_GET['username'];
     $_SESSION['fullname']=$row[2];
   }else{
     header("Location: "."login.php");
   }
  }
  } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
  ?>
<form>
  <input type="submit" name="logout" value="Logout" method="get">
  <br>
</form>
  Write a message:
  <br>
  <form>
  <textarea rows="4" cols="50" name="comment" placeholder="Enter text here....."></textarea>
     <br>
  <input type="submit" name="newpost" value="New Post" method="get">
  <br><br>
  A list of messages:<br>
  <?php
    $replyto="";
    $message="";
try {
  if(isset($_GET['comment'])||(isset($_GET['replayto']))){
    if(isset($_GET['nid'])){
      $_SESSION['nameid']=$_GET['nid'];
    }
    $db = new PDO("mysql:host=127.0.0.1:3306;dbname=board","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $db->beginTransaction();
    $id=uniqid();
    if(isset($_GET['replayto'])){
    //$_SESSION['nameid']=$_GET['nid'];
    $replyto=$_GET['replayto'];
    }
    if(isset($_GET['comment'])){
    $message=$_GET['comment'];
    }
    $postedby=$_SESSION['username'];
    $dbh->exec('insert into posts(id, replyto, postedby, datetime, message) values("'.$id.'","'.$replyto.'","'.$postedby.'",NOW(),"'.$message.'")')
         or die(print_r($dbh->errorInfo(), true));
    $dbh->commit();
    $_SESSION['nameid']="";
  }
  $stmt = $dbh->prepare('select p.id,p.replyto,p.postedby,u.fullname,p.datetime,p.message from posts as p, users as u where u.username=p.postedby ORDER BY datetime DESC');
  $stmt->execute();
  echo "<table border='1'>";
  echo "<tr>";
   echo "<th>ID</th>";
   echo "<th>Replyto</th>";
   echo "<th>Postedby</th>";
   echo "<th>FullName</th>";
   echo "<th>Time and Date</th>";
   echo "<th>message</th>";
   echo "<th>Reply</th>";
   echo "</tr>";
   echo "<br>";
  while ($row = $stmt->fetch()) {
   echo "<tr>";
    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td>$row[2]</td>";
    echo "<td>$row[3]</td>";
    echo "<td>$row[4]</td>";
    echo "<td>$row[5]</td>";
    echo"<td><button name='replayto' type='submit' method='get' value='".$row[0]."'>Reply</button></td>";
    echo "</tr>";
      }
      echo "<table border='1'>";
} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}
?>
</form>
</body>
</html>
