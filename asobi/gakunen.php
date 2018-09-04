<!DOCTYPE html>
<html lang="EN">
<head>
  <meta charset="UTF-8">
  <title>RokumaruFarm</title>
</head>
<body>
<?php

$gakunen=$_POST['gakunen'];

switch($gakunen)
{
    case'1':
    $kousha='you are south';
    $bukatsu='bukatsu have sports and culture';
    $mokuhyou='you should be used to school';
    break;

    case'2':
    $kousha='you are south2';
    $bukatsu='bukatsu have sports and culture';
    $mokuhyou='you should be used to school';
    break;

    case'3':
    $kousha='you are south3';
    $bukatsu='bukatsu have sports and culture';
    $mokuhyou='you should be used to school';
    break;

    default:
    $kousha='you are south default';
    $bukatsu='bukatsu have sports and culture';
    $mokuhyou='you should be used to school';
    break;

}

print 'kousha'.$kousha.'<br/>';
print 'bukatsu'.$bukatsu.'<br/>';
print 'mokuhyou'.$mokuhyou.'<br/>';


?>


</body>
</html>

