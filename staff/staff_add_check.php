<?php
/*
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
*/
?>

<!DOCTYPE html>
<html lang="EN">
<head>
  <meta charset="UTF-8">
  <title>RokumaruFarm</title>
</head>
<body>
<?php

/*
$staff_name=$_POST['name'];
$staff_pass=$_POST['pass'];
$staff_pass2=$_POST['pass2'];
*/

require_once('../common/common.php');

$post=sanitize($_POST);
$staff_name=$post['name'];
$staff_pass=$post['pass'];
$staff_pass2=$post['pass2'];

/*
$staff_name=htmlspecialchars($staff_name,ENT_QUOTES,'UTF-8');
$staff_pass=htmlspecialchars($staff_pass,ENT_QUOTES,'UTF-8');
$staff_pass2=htmlspecialchars($staff_pass2,ENT_QUOTES,'UTF-8');
*/

if($staff_name=='')
{
  print'not insert staff name.<br/>';
}
else
{
  print'staff name';
  print $staff_name;
  print'<br/>';
}

if($staff_pass=='')
{
  print'not insert password.<br/>';
}

if($staff_pass!=$staff_pass2)
{
  print'not match password<br/>';
}

if($staff_name==''||$staff_pass==''||$staff_pass!=$staff_pass2)
{
  print'<form>';
  print'<input type="button" onclick="history.back()" value="return">';
  print'</form>';
}
else
{
  $staff_pass=md5($staff_pass);
  print'<form method="post" action="staff_add_done.php">';
  print'<input type="hidden" name="name" value="'.$staff_name.'">';
  print'<input type="hidden" name="pass" value="'.$staff_pass.'">';
  print'<br/>';
  print'<input type="button" onclick="history.back()" value="return">';
  print'<input type="submit" value="OK">';
  print'</form>';
}

?>

</body>
</html>
