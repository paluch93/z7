<?php 
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
<h3>Logowanie do chmury</h3>
<form method="post" action="./sites/zaloguj.php">   
Login:<input type="text" name="user" maxlength="20" size="20" placeholder="Login" required autofocus><br>   
Hasło:<input type="password" name="pass" maxlength="20" size="20" placeholder="Password" required><br>   
<input type="submit" value="Zaloguj"/>  
</form>
<form method="post" action="./sites/nowy.php">   
<input type="submit" value="Dodaj użytkownika"/>  
</form>
<!—Koniec body -->
</body>

<!—Koniec html -->
</html>
_END;
?>