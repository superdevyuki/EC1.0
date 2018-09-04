<!DOCTYPE html>
<html lang="EN">
<head>
  <meta charset="UTF-8">
  <title>RokumaruFarm</title>
</head>
<body>
<?php

 require_once('../common/common.php');

 $seireki=$_POST['seireki'];

 $wareki=gengo($seireki);
 print $wareki;

?>

</body>
</html>

