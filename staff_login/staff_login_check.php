<?php

require_once('../common/common.php');

try
{

  $post=sanitize($_POST);
  $staff_code=$post['code'];
  $staff_pass=$post['pass'];


  $staff_pass=md5($staff_pass);

  $dsn='mysql:dbname=shop3.0;host=localhost;charset=utf8';
  $user='root';
  $password='root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $sql = 'SELECT name FROM mst_staff WHERE code=? AND password=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $staff_code;
  $data[] = $staff_pass;
  $stmt->execute($data);

  $dbh=null;

  $rec=$stmt->fetch(PDO::FETCH_ASSOC);

  if($rec==false)
  {
    print'you have wrong staffcode or password<br/>';
    print'<a href="staff_login.html">return</a>';
  }
  else
  {
    session_start();
    $_SESSION['login']=1;
    $_SESSION['staff_code']=$staff_code;
    $_SESSION['staff_name']=$rec['name'];

    header('Location:staff_top.php');
    exit();
  }

}
catch(Exception $e)
{
  print'sorry for';
  exit();
}

?>
