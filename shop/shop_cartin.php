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

  if(isset($_SESSION['cart'])==true) {
    $cart = $_SESSION['cart'];
    $kazu = $_SESSION['kazu'];
    if(in_array($pro_code,$cart)==true)
    {
        print'you have already inserted to the cart.<br/>';
        print'<a href="shop_list.php">return to product list</a>';
        exit();
    }
  }
  $cart[]=$pro_code;
  $kazu[] = 1;
  $_SESSION['cart']=$cart;
  $_SESSION['kazu']=$kazu;

}
catch(Exception $e)
{
  print 'now we give you more burden for preventing. sorry...';
  exit();
}
?>

add to cart.<br/>
<br/>
<a href="shop_list.php">return to product list</a>

</body>
</html>

