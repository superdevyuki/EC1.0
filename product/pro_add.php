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
Add Product<br/>
<br/>
<form method="post" action="pro_add_check.php" enctype="multipart/form-data">
  Please insert product name.<br/>
  <input type="text" name="name" style="width:200px"><br/>
  Please insert price.<br/>
  <input type="text" name="price" style="width:50px"><br/>
  Please select image.<br/>
  <input type="file"  name="gazou" style="width:400px"><br/>
  <br/>
  <input type="button" onclick="history.back()" value="return">
  <input type="submit" value="OK">
</form>

</body>
</html>

