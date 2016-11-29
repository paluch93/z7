<?php

$user=$_POST['user'];
$pass=$_POST['pass'];
$link = mysqli_connect(localhost,"db_user","db_password","db_name");
if(!$link) 
{ 
echo"B³¹d: ". mysqli_connect_errno()." ".mysqli_connect_error(); 
}
mysqli_query($link, "SET NAMES 'utf8'");
$result = mysqli_query($link, "SELECT * FROM z7users WHERE login='$user'");
$rekord = mysqli_fetch_array($result);
if(!$rekord)
{
mysqli_close($link);
echo "B³êdne logowanie!<br><a href=javascript:history.back();>Wstecz</A>"; 
}
else
{
if($rekord['password']==$pass && $rekord['prob']<3)
{
flush();
setcookie("klientLogin", $user, time() + 3600, "/");
header('Location: klient.php');
ob_flush();
require_once 'function.php';
$ipaddress = $_SERVER["REMOTE_ADDR"];
$fidk=$rekord['id'];
$data=date("Y-m-d");
$czas=date("H:i");
$send_info="INSERT INTO z7logi VALUES ('$fidk','$ipaddress','$data','$czas',NOW(),'1')";
queryMysql($send_info);
$send_info1="UPDATE z7users SET prob='0' where id='$fidk'";
queryMysql($send_info1);
}
else
{
if($rekord['prob']>=3)
{
echo "Konto zosta³o zablokowane<br><a href=javascript:history.back();>Wstecz</A>";
}
else
{
require_once 'function.php';
$ipaddress = $_SERVER["REMOTE_ADDR"];
$fidk=$rekord['id'];
$data=date("Y-m-d");
$czas=date("H:i");
$send_info="INSERT INTO z7logi VALUES ('$fidk','$ipaddress','$data','$czas',NOW(),'0')";
queryMysql($send_info);
$value=$rekord['prob'];
$value++;
$send_info1="UPDATE z7users SET prob='$value' where id='$fidk'";
queryMysql($send_info1);
mysqli_close($link);   
echo "B³êdne logowanie!<br><a href=javascript:history.back();>Wstecz</A>"; 
}
}
}
?> 