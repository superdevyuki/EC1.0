<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
  print'welcome to guest<br/>';
  print'<a href="member_login.html">go to login screen</a>';
  print'<br/>';
}
else
{
  print 'welcome';
  print $_SESSION['member_name'];
  print 'sama';
  print '<a href="member_logout.php">logout</a><br/>';
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

  $sql='SELECT code,name,price FROM mst_product WHERE 1';
  $stmt= $dbh->prepare($sql);
  $stmt->execute();

  $dbh= null;

  print 'product list<br/><br/>';

  while(true)
  {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if($rec==false)
    {
      break;
    }
    print'<a href="shop_product.php?procode='.$rec['code'].'">';
    print $rec['name'].'---';
    print $rec['price'].'yen';
    print'</a>';
    print'<br/>';
  }

}
catch(Exception $e)
{
  print 'now we give you more burden for preventing. sorry...';
  exit();
}
  print '<br/>';
  print'<a href="shop_cartlook.php">see cart</a><br/>';
?>


</body>
</html>
