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

  if(isset($_SESSION['cart'])==true) {
    $cart = $_SESSION['cart'];
    $kazu = $_SESSION['kazu'];
    $max = count($cart);
  }
  else
  {
      $max=0;
  }

  if($max==0)
  {
      print 'not insert product in the cart.<br/>';
      print '<br/>';
      print '<a href="shop_list.php">return to product list</a>';
      exit();
  }

  $dsn='mysql:dbname=shop3.0;host=localhost;charset=utf8';
  $user='root';
  $password='root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  foreach($cart as $key =>$val)
  {
      $sql = 'SELECT code,name,price,gazou FROM mst_product WHERE code=?';
      $stmt = $dbh->prepare($sql);
      $data[0] = $val;
      $stmt->execute($data);

      $rec = $stmt->fetch(PDO::FETCH_ASSOC);

      $pro_name[] = $rec['name'];
      $pro_price[] = $rec['price'];
      if($rec['gazou']=='')
      {
          $pro_gazou[] = '';
      }
      else
      {
          $pro_gazou[]='<img src="../product/gazou/'.$rec['gazou'].'">';
      }
  }


$dbh = null;



}
catch(Exception $e)
{
  print 'now we give you more burden for preventing. sorry...';
  exit();
}
?>

content cart<br/>
<br/>
<table border="1">
    <tr>
        <td>product</td>
        <td>product image</td>
        <td>price</td>
        <td>number</td>
        <td>sum</td>
        <td>delete</td>
    </tr>
<form method = "post" action = "kazu_change.php">
<?php for($i=0;$i<$max;$i++) {
  ?>
    <tr>
        <td><?php print $pro_name[$i]; ?></td>
        <td><?php print $pro_gazou[$i]; ?></td>
        <td><?php print $pro_price[$i]; ?>yen</td>
        <td><input type="text" name="kazu<?php print $i; ?>" value="<?php print $kazu[$i];?>"></td>
        <td><?php print $pro_price[$i] * $kazu[$i];?>yen</td>
        <td><input type="checkbox" name="sakujo<?php print $i;?>"></td>
    </tr>
  <?php
}
?>
</table>

<input type="hidden" name="max" value="<?php print $max;?>">
<input type="submit" value="change number"><br/>
<input type="button" onclick="history.back()" value="return">
</form>
<br/>
<a href="shop_form.html">go to purchase procedure</a><br/>

<?php
    if(isset($_SESSION["member_login"])==true)
    {
        print'<a href="shop_kantan_check.php">go to easy purchase procedure page</a><br/>';
    }
?>

</body>
</html>

