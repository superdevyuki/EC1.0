<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
print'you are not login<br/>';
print'<a href="shop_list.html">go to product list</a>';
exit();
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
$code = $_SESSION['member_code'];

$dsn='mysql:dbname=shop3.0;host=localhost;charset=utf8';
$user='root';
$password='root';
$dbh = new PDO($dsn, $user, $password);
$dbh ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT name,email,postal1,postal2,address,tel FROM dat_member WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[] = $code;
$stmt->execute($data);
$rec = $stmt->fetch(PDO::FETCH_ASSOC);

$dbh = null;

$onamae=$rec['onamae'];
$email=$rec['email'];
$postal1=$rec['postal1'];
$postal2=$rec['postal2'];
$address=$rec['address'];
$tel=$rec['tel'];

print'your name<br/>';
print $onamae;
print'<br/><br/>';

print'your email address<br/>';
print $email;
print'<br/><br/>';

print'postal number<br/>';
print $postal1;
print'-';
print $postal2;
print'<br/><br/>';

print'address<br/>';
print $address;
print'<br/><br/>';

print'telephone number<br/>';
print $tel;
print'<br/><br/>';


print'<form method = "post" action = "shop_kantan_done.php">';
print'<input type="hidden" name="onamae" value="'.$onamae.'">';
print'<input type="hidden" name="email" value="'.$email.'">';
print'<input type="hidden" name="postal1" value="'.$postal1.'">';
print'<input type="hidden" name="postal2" value="'.$postal2.'">';
print'<input type="hidden" name="address" value="'.$address.'">';
print'<input type="hidden" name="tel" value="'.$tel.'">';
print'<input type="button" onclick="history.back()"value="return">';
print'<input type="submit" value="OK">';
print'</form>';

?>

</body>
</html>
