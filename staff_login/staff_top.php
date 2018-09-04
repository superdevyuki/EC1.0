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
shop management top menu<br/>
<br/>
<a href="../staff/staff_list.php">staff manegement</a><br/>
<br/>
<a href="../product/pro_list.php">pro manegement</a><br/>
<br/>
<a href="../order/order_download.php">download ordered product</a><br/>;
<br/>
<a href="staff_logout.php">logout</a><br/>
</body>
</html>
