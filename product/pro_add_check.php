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

require_once('../common/common.php');

$post=sanitize($_POST);

$pro_name=$post['name'];
$pro_price=$post['price'];
$pro_gazou=$_FILES['gazou'];



if($pro_name=='')
{
  print'not insert product name.<br/>';
}
else
{
  print'product name';
  print $pro_name;
  print'<br/>';
}

if(preg_match("/^[0-9]+$/", $pro_price)==0)
{
  print 'Please insert price exactly.<br/>';
}
else
{
  print'product price';
  print $pro_price;
  print'yen<br/>';
}

if($pro_gazou['size']>0)
{
    if($pro_gazou['size']>1000000)
    {
        print'image size is too big!';
    }
    else
    {
        move_uploaded_file($pro_gazou['tmp_name'],'./gazou/'.$pro_gazou['name']);
        print'<img src="./gazou/'.$pro_gazou['name'].'">';
        print'<br/>';
    }
}
if($pro_name==''||preg_match("/^[0-9]+$/", $pro_price)==0||$pro_gazou['size']>1000000)
{
  print'<form>';
  print'<input type="button" onclick="history.back()" value="return">';
  print'</form>';
}
else
{
  print'add above product<br/>';
  print'<form method="post" action="pro_add_done.php">';
  print'<input type="hidden" name="name" value="'.$pro_name.'">';
  print'<input type="hidden" name="price" value="'.$pro_price.'">';
  print'<input type="hidden" name="gazou_name" value="'.$pro_gazou['name'].'">';
  print'<br/>';
  print'<input type="button" onclick="history.back()" value="return">';
  print'<input type="submit" value="OK">';
  print'</form>';
}

?>

</body>
</html>
