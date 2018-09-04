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
  $pro_gazou_name_old= $rec['gazou'];

  $dbh= null;

  if($pro_gazou_name_old=='')
  {
      $disp_gazou='';
  }
  else
  {
      $disp_gazou='<img src="./gazou/'.$pro_gazou_name_old.'">';
  }

}
catch(Exception $e)
{
  print 'now we give you more burden for preventing. sorry...';
  exit();
}
?>

fix product<br/>
<br/>
product code<br/>
<?php print $pro_code;?>
<br/>
<br/>
<form method="post" action="pro_edit_check.php" enctype="multipart/form-data">
  <input type="hidden"  name="code" value="<?php print $pro_code;?>">
  <input type="hidden"  name="gazou_name_old" value="<?php print $pro_gazou_name_old;?>">
  Product name<br/>
  <input type="text"  name="name" style="width:200px" value="<?php print $pro_name;?>"><br/>
  Price<br/>
  <input type="text" name="price" style="width:50px" value="<?php print $pro_price;?>">yen<br/>
  <br/>
  <?php print $disp_gazou;?>
  <br/>
  Please select image.<br/>
  <input type="file" name="gazou" style="width:400px"><br/>
  <br/>
  <input type="button" onclick="history.back()" value="return">
  <input type="submit" value="OK">
</form>

</body>
</html>

