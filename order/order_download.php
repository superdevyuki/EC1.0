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
?>

Please select order day which you want to download.<br/>
<form method = "post" action = "order_download_done.php">
<?php pulldown_year();?>
year
<?php pulldown_month();?>
month
<?php pulldown_day();?>
day<br/>
<br/>
<input type = "submit" value = "go to download">
</form>


</body>
</html>
