<!DOCTYPE html>
<html lang="EN">
<head>
  <meta charset="UTF-8">
  <title>RokumaruFarm</title>
</head>
<body>
<?php

$mbango=$_POST['mbango'];

$hoshi['M1']='kani';
$hoshi['M31']='andoromeda';
$hoshi['M42']='orion';
$hoshi['M45']='subaru';
$hoshi['M57']='dounats';

foreach($hoshi as $key => $val)
{
  print $key.'is'.$val;
  print'<br/>';
}

print 'you choosed hoshi is';
print $hoshi[$mbango];

?>


</body>
</html>

