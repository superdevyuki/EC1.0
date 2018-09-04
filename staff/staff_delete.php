<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
  print'you false login<br/>';
  print'<a href="../staff_login/staff_login.html">go to login screen</a>';
  exit();
}
else
{
  print $_SESSION['staff_name'];
  print'login<br/>';
  print'<br/>';
}
?>

<!DOCTYPE html>
<html lang="EN">
<head>
  <meta charset="UTF-8">
  <title>RokumaruFarm</title>
</head>
<body>
<?php

try
{

  $staff_code=$_GET['staffcode'] ;

  $dsn='mysql:dbname=shop3.0;host=localhost;charset=utf8';
  $user='root';
  $password='root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $sql='SELECT name FROM mst_staff WHERE code=?';
  $stmt= $dbh->prepare($sql);
  $data[]=$staff_code;
  $stmt->execute($data);

  $rec= $stmt->fetch(PDO::FETCH_ASSOC);
  $staff_name= $rec['name'];

  $dbh= null;

}
catch(Exception $e)
{
  print 'now we give you more burden for preventing. sorry...';
  exit();
}
?>

delete staff<br/>
<br/>
staff code<br/>
<?php print $staff_code;?>
<br/>
staff name<br/>
<?php print $staff_name;?>
<br/>
Do you want to delete this staff?<br/>
<br/>
<form method="post" action="staff_delete_done.php">
  <input type="hidden" name="code" value="<?php print $staff_code?>">
  <input type="button" onclick="history.back()" value="return">
  <input type="submit" value="OK">
</form>

</body>
</html>

