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
  $dsn='mysql:dbname=shop3.0;host=localhost;charset=utf8';
  $user='root';
  $password='root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $sql='SELECT code,name FROM mst_staff WHERE 1';
  $stmt= $dbh->prepare($sql);
  $stmt->execute();

  $dbh= null;

  print 'staff list<br/><br/>';

  print'<form method="post"action="staff_branch.php">';

  while(true)
  {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if($rec==false)
    {
      break;
    }
    print'<input type="radio" name="staffcode" value="'.$rec['code'].'">';
    print $rec['name'];
    print'<br/>';
  }
  print'<input type="submit" name="disp" value="refer">';
  print'<input type="submit" name="add" value="add">';
  print'<input type="submit" name="edit" value="fix">';
  print'<input type="submit" name="delete" value="delete">';
  print'</form>';
}
catch(Exception $e)
{
  print 'now we give you more burden for preventing. sorry...';
  exit();
}
?>

<br/>
<a href="../staff_login/staff_top.php">go to top menu</a><br/>



</body>
</html>

