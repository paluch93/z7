<?php
require_once 'function.php';

if(!IsSet($_COOKIE['klientLogin']))
{
echo "Błąd w logowaniu";
}
else
$user=$_COOKIE['klientLogin'];

$query="SELECT * FROM z7users WHERE login='$user'";
$wynik=queryMysql($query);
$rows1 = $wynik->num_rows;
$wynik->data_seek(0);
$row=$wynik->fetch_array(MYSQLI_NUM);
echo <<<_END
<html>
<head>
<title>Panel użytkownika $user</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<style type="text/css" media="all"> 
    @import url("style.css");
</style>
<script src="http://code.jquery.com/jquery-latest.js"></script>

</head>
<body>
<center><h1>Witamy w Panelu Chmury </h1></center>
<h3>Dane użytkownika:</h3>
_END;
echo "Login : $user<br>";

$query="SELECT * FROM z7logi WHERE fid='$row[0]' order by now DESC ";
$wynik=queryMysql($query);
$rows1 = $wynik->num_rows;
$wynik->data_seek(1);
$row1=$wynik->fetch_array(MYSQLI_NUM);

echo "Data ostatniego logowania : $row1[2]<br>";
echo "Godzina ostatniego logowania : $row1[3]<br>";
echo "Adres IP ostatniego logowania : $row1[1]<br>";
if($row1[5]==0)
{
	echo "Poprzednie logowanie było nieudane<br>";
}
else
{
	echo "Poprzednie logowanie było udane<br>";
}
echo <<<_END
<form method="post" action="historia.php" target="_blank">   
<input type="hidden" name="fidk" value="$row[0]">   
<input type="submit" value="Historia logowań"/>  
</form>
<br>
<form method="post" action="wyloguj.php" >      
<input type="submit" value="Wyloguj"/>  
</form>
_END;
echo "<br><br><br>";
echo <<<_END
<div id="container">
    <h1>Chumra plików online</h1>
     
    <fieldset>
        <legend>Dodaj nowy plik do przechowania</legend>
        <form method="post" action="dodaj.php" enctype="multipart/form-data">
        <input type="hidden" name="user" value="$row[1]" />
        <p><label for="name">Wybierz plik</label><br />
        <input type="file" name="file" /></p>
        <p><input type="submit" name="submit" value="Wyślij plik do chmury" /></p>
        </form>   
    </fieldset>
<fieldset>
    <legend>Pliki w chmurze</legend>
    <ul id="files">
_END;
$dir = opendir($row[4]);
while(false !== ($file = readdir($dir)))
  if($file != '.' && $file != '..') 
  {
	$file1=rawurlencode($file);
    echo '<li><a href='.$row[4].'/'.$file1.'>'.$file.'</a></li>';
  }
echo <<<_END
    </ul>
</fieldset>
</div>
</body>
</html>
_END;
?>