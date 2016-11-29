<?
require_once 'function.php';
if(isset($_POST['user'])&&isset($_POST['pass']))
{
$user=($_POST['user']);
$pass=($_POST['pass']);
$query="SELECT * FROM z7users WHERE login='$user'";
$wynik=queryMysql($query);
$rows1 = $wynik->num_rows;
if($rows1>0)
{
	echo "Dany użytkownik już istnieje, użyj innej nazwy";
}
else
{
	$send_info="INSERT INTO z7users VALUES ('','$user','$pass','','$user')";
	queryMysql($send_info);
	mkdir("$user");
	echo "Dodano pomyślnie użytkownika, wciśnij wstecz aby się zalogować<br><a href=../index.php>Wstecz</a>";
}
}
echo <<<_END
<!doctype html>
<html lang=”pl”>
<head>
<title>Zadanie 7 - TAS</title>

<meta charset="UTF-8">

<meta name="description" content="Zadanie 7 , Tworzenie Aplikacji Sieciowych">
<meta name="keywords" content="z7,zadanie7,studia">

</head>
<body>
<h1>Prywatna chmura plików</h1>
<br>
<h3>Dodawanie nowego użytkownika</h3>
<form method="post" action="nowy.php">   
Login:<input type="text" name="user" maxlength="20" size="20" placeholder="Login" required autofocus><br>   
Hasło:<input type="password" name="pass" maxlength="20" size="20" placeholder="Password" required><br>   
<input type="submit" value="Dodaj"/>  

<!—Koniec body -->
</body>

<!—Koniec html -->
</html>
_END;
?>