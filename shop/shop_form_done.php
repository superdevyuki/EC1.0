<?php
session_start();
session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="EN">
<head>
  <meta charset="UTF-8">
  <title>RokumaruFarm</title>
</head>
<body>

<?php

try {

  require_once('../common/common.php');

  $post = sanitize($_POST);

  $onamae = $post['onamae'];
  $email = $post['email'];
  $postal1 = $post['postal1'];
  $postal2 = $post['postal2'];
  $address = $post['address'];
  $tel = $post['tel'];
  $chumon = $post['chumon'];
  $pass = $post['pass'];
  $danjo = $post['danjo'];
  $birth = $post['birth'];

  print $onamae . 'sama<br/>';
  print'thank you for your order.<br/>';
  print $email . 'send to , please confirm it.<br/>';
  print'we will send this product below adress.<br/>';
  print $postal1 . '-' . $postal2 . '<br/>';
  print $address . '<br/>';
  print $tel . '<br/>';

  $honbun = '';
  $honbun .= $onamae . "sama¥n¥n thank you for your order.¥n";
  $honbun .= "¥n";
  $honbun .= "order product¥n";
  $honbun .= "------------¥n";

  $cart = $_SESSION['cart'];
  $kazu = $_SESSION['kazu'];

  $max = count($cart);

  $dsn = 'mysql:dbname=shop3.0;host=localhost;charset=utf8';
  $user = 'root';
  $password = 'root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  for ($i = 0; $i < $max; $i++) {
    $sql = 'SELECT name,price FROM mst_product WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $data[0] = $cart[$i];
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    $name = $rec['name'];
    $price = $rec['price'];
    $kakaku[] = $price;
    $suryo = $kazu[$i];
    $shokei = $price * $suryo;

    $honbun .= $name . '';
    $honbun .= $price . 'yen';
    $honbun .= $suryo . 'ko=';
    $honbun .= $shokei . "en¥n";

  }

  $sql = 'LOCK TABLES dat_sales WRITE,dat_sales_product WRITE,dat_member WRITE';
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  $lastmembercode = 0;
  if($chumon=='chumontouroku')
  {
      $sql = 'INSERT INTO dat_member(password,name,email,postal1,postal2,address,tel,danjo,born)VALUES(?,?,?,?,?,?,?,?,?)';
      $stmt = $dbh->prepare($sql);
      $data = array();
      $data[] = md5($pass);
      $data[] = $onamae;
      $data[] = $email;
      $data[] = $postal1;
      $data[] = $postal2;
      $data[] = $address;
      $data[] = $tel;
      if($danjo == 'dan')
      {
          $data[]=1;
      }
      else
      {
          $data[]=2;
      }
      $data[] = $birth;
      $stmt->execute($data);

      $sql = 'SELECT LAST_INSERT_ID()';
      $stmt = $dbh->prepare($sql);
      $stmt->execute();
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      $lastmembercode=$rec['LAST_INSERT_ID()'];
  }

  $sql = 'INSERT INTO dat_sales(code_member,name,email,postal1,postal2,address,tel)VALUES(?,?,?,?,?,?,?)';
  $stmt = $dbh->prepare($sql);
  $data =array();
  $data[]=$lastmembercode;
  $data[]=$onamae;
  $data[]=$email;
  $data[]=$postal1;
  $data[]=$postal2;
  $data[]=$address;
  $data[]=$tel;
  $stmt->execute($data);

  $sql = 'SELECT LAST_INSERT_ID()';
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  $lastcode=$rec['LAST_INSERT_ID()'];

  for($i=0; $i<$max; $i++)
  {
      $sql = 'INSERT INTO dat_sales_product(code_sales,code_product,price,quantity)VALUES(?,?,?,?)';
      $stmt = $dbh->prepare($sql);
      $data = array();
      $data[] = $lastcode;
      $data[] = $cart[$i];
      $data[] = $kakaku[$i];
      $data[] = $kazu[$i];
      $stmt->execute($data);
  }

  $sql = 'UNLOCK TABLES';
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  $dbh = null;

  if($chumon=='chumontouroku')
  {
      print'you have already finished register mamber.<br/>';
      print'please login by using email_address and password at next time.';
      print'you can order easily.';
      print'<br/>';
  }

  $honbun .= "sending is free.¥n";
  $honbun .= "----------¥n";
  $honbun .= "¥n";
  $honbun .= "Please insert your money to our account";
  $honbun .= "RokumaruBank vegetable branch normal account 1234567¥n";
  $honbun .= "i finish confarming , insert to box and send you.¥n";
  $honbun .= "¥n";


  $honbun .= "□□□□□□□□□□¥n";
  $honbun .= "~reliable vegetable rokumaru farm.¥n";
  $honbun .= "¥n";
  $honbun .= "〇〇prefecture¥n";
  $honbun .= "telephpne 090-¥n";
  $honbun .= "mail info¥n";
  if($chumon=='chumontouroku')
  {
    print'you have already finished register mamber.<br/>';
    print'please login by using email_address and password at next time.';
    print'you can order easily.';
    print'<br/>';
  }
  $honbun .= "□□□□□□□□□□¥n";

//receive email by customer
  $title = 'thank you for your order.';
  $header = 'From:info@rokumarunouen.co.jp';
  $honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
  mb_language('Japanese');
  mb_internal_encoding('UTF-8');
  mail($email, $title, $honbun, $header);

//receive email by company
  $title = 'i received from customers order.';
  $header = 'From:' . $email;
  $honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
  mb_language('Japanese');
  mb_internal_encoding('UTF-8');
  mail('info@rokumarunouen.co.jp', $title, $honbun, $header);

}
catch(Exception $e)
{
    print'sorry';
    exit();
}
?>

<br/>
<a href="shop_list.php">return to product screen</a>

</body>
</html>
