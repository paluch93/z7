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
        <p><input type="submit" name="submit" value="Wyślij plik do chmury(katalog główny)" /></p>
        </form>   
    </fieldset>
<fieldset>
    <legend>Pliki w chmurze</legend>
<button onclick="window.open('pliki.php', 'newwindow', 'width=500, height=250'); return false;">Dodaj katalog</button>
<button onclick="window.open('plik.php', 'newwindow', 'width=500, height=250'); return false;">Dodaj plik do wybranego katalogu</button>
_END;

echo "<ul id='files'>";
$path=$row[4];
$dir = array_diff(scandir($path), array('.', '..'));
foreach($dir as $x)
{
	$x1=rawurlencode($x);
	if(is_dir($row[4].'/'.$x))
	{
		 echo '<li><a href='.$row[4].'/'.$x1.' target=_blank>'.$x.'<----KATALOG</a></li>';
		 $directory=$row[4].'/'.$x;
		 $dir1=array_diff(scandir($directory), array('.', '..'));
		 echo "<ul>";
		 foreach($dir1 as $y)
		 {
			 $y1=rawurlencode($y);
			 $directory1=$directory.'/'.$y1;
			 if(is_dir($directory1))
			 {
			 echo '<li><a href="'.$directory1.'" target=_blank>'.$y.'<----KATALOG</a></li>';
			 }
			 else
			 {
			 echo '<li><a href="'.$directory1.'" target=_blank>'.$y.'<----PLIK</a></li>';
			 }
		 }
		 echo "</ul>";
	}
	else
	{
		echo '<li><a href='.$row[4].'/'.$x1.' target=_blank>'.$x.'<----PLIK</a></li>';
	}
}

echo <<<_END
    </ul>
</fieldset>
</div>
</body>
</html>
_END;
?>