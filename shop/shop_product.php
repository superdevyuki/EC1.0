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
  print '<a href="member_logout.php>logout</a><br/>';
  print '<br/>';
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

  $pro_code=$_GET['procode'] ;

  $dsn='mysql:dbname=shop3.0;host=localhost;charset=utf8';
  $user='root';
  $password='root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $sql='SELECT name,price,gazou FROM mst_product WHERE code=?';
  $stmt= $dbh->prepare($sql);
  $data[]=$pro_code;
  $stmt->execute($data);

  $rec= $stmt->fetch(PDO::FETCH_ASSOC);
  $pro_name= $rec['name'];
  $pro_price= $rec['price'];
  $pro_gazou_name= $rec['gazou'];

  $dbh= null;

  if($pro_gazou_name=='')
  {
    $disp_gazou='';
  }
  else
  {
    $disp_gazou='<img src="../product/gazou/'.$pro_gazou_name.'">';
  }

  print'<a href="shop_cartin.php?procode='.$pro_code.'">insert to cart</a><br/><br/>';

}
catch(Exception $e)
{
  print 'now we give you more burden for preventing. sorry...';
  exit();
}
?>

refer product information<br/>
<br/>
product code<br/>
<?php print $pro_code;?>
<br/>
product name<br/>
<?php print $pro_name;?>
<br/>
product price<br/>
<?php print $pro_price;?>
<br/>
<?php print $disp_gazou;?>
<br/>
<br/>
<form>
  <input type="button" onclick="history.back()" value="return">
</form>

</body>
</html>

