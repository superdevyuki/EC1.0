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

$onamae=$post['onamae'];
$email=$post['email'];
$postal1=$post['postal1'];
$postal2=$post['postal2'];
$address=$post['address'];
$tel=$post['tel'];
$chumon=$post['chumon'];
$pass=$post['pass'];
$pass2=$post['pass2'];
$danjo=$post['danjo'];
$birth=$post['birth'];

$okflg=true;

if($onamae=='')
{
  print'you do not insert your name.<br/><br/>';
  $okflg=false;
}
else
{
    print'your name<br/>';
    print $onamae;
    print'<br/><br/>';
}
if($email=='')
{
  print'Please insert email address exactly';
  $okflg=false;
}
else
{
  print'your email address<br/>';
  print $email;
  print'<br/><br/>';
}

if($postal1=='')
{
  print'Please insert postal exactly';
  $okflg=false;
}

if($postal2=='')
{
  print'Please insert postal exactly';
  $okflg=false;
}
else
{
  print'postal number<br/>';
  print $postal1;
  print'-';
  print $postal2;
  print'<br/><br/>';
}

if($address=='')
{
  print'you do not insert your address.<br/><br/>';
  $okflg=false;
}
else
{
    print'address<br/>';
    print $address;
    print'<br/><br/>';
}

if($tel=='')
{
  print'Please insert tel exactly';
  $okflg=false;
}
else
{
  print'telephone number<br/>';
  print $tel;
  print'<br/><br/>';
}

if($chumon=='chumontouroku')
{
  if($pass=='')
  {
    print'not insert password.<br/><br/>';
    $okflg=false;
  }

  if($pass!=$pass2)
  {
    print'not match password.<br/><br/>';
    $okflg=false;
  }

  print'sex<br/>';
  if($danjo=='dan')
  {
    print'men';
  }
  else
  {
    print'women';
  }
  print'<br/><br/>';

  print'birthday<br/>';
  print $birth;
  print'year';
  print'<br/><br/>';
}



if($okflg=true)
{
print'<form method = "post" action = "shop_form_done.php">';
print'<input type="hidden" name="onamae" value="'.$onamae.'">';
print'<input type="hidden" name="email" value="'.$email.'">';
print'<input type="hidden" name="postal1" value="'.$postal1.'">';
print'<input type="hidden" name="postal2" value="'.$postal2.'">';
print'<input type="hidden" name="address" value="'.$address.'">';
print'<input type="hidden" name="tel" value="'.$tel.'">';
print'<input type="hidden" name="chumon" value="'.$chumon.'">';
print'<input type="hidden" name="pass" value="'.$pass.'">';
print'<input type="hidden" name="danjo" value="'.$danjo.'">';
print'<input type="hidden" name="birth" value="'.$birth.'">';

print'<input type="button" onclick="history.back()"value="return">';
print'<input type="submit" value="OK">';
print'</form>';
}
else
{
    print'<form>';
    print'<input type="button" onclick="history.back()" value="return">';
    print'<form/>';
}

?>

</body>
</html>
