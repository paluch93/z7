<?php
if(isset($_POST['katalog'])&&IsSet($_COOKIE['klientLogin']))
{
	$path=$_COOKIE['klientLogin'].'/'.$_POST['katalog'];
	mkdir("$path");
	echo "Pamiętaj odświeżyć stronę główną!!<br>A tę możesz zamknąć jeżeli nie chcesz dodać nic nowego<br><br>";
}


echo "Wprowadź nazwę dla nowego katalogu";
echo <<<_END
<form method="post" action="pliki.php">
		<input type="text" name="katalog" maxlength="20" size="20" placeholder="Nazwa katalogu" required autofocus><br>
        <p><input type="submit" name="submit" value="Stwórz katalog" /></p>
        </form>   
_END;
?>