<?php
$file=$_FILES['file'];
if(isset($_POST['wgrywanie'])&&isset($file['name'])&&IsSet($_COOKIE['klientLogin']))
{
	$path=$_COOKIE['klientLogin'].'/'.$_POST['wgrywanie'].'/'.$file['name'];
    move_uploaded_file($file['tmp_name'], $path);
	echo "Pamiętaj odświeżyć stronę główną!!<br>A tę możesz zamknąć jeżeli nie chcesz dodać nic nowego<br><br>";
}
else
{
	echo "Brak wybranych poprawnie opcji!!!<br><br>";
}


echo "Wybierz katalog do zapisu pliku";
echo <<<_END
<form method="post" action="plik.php" enctype="multipart/form-data">
<select name="wgrywanie">
_END;
$path=$_COOKIE['klientLogin'];
$dir = array_diff(scandir($path), array('.', '..'));
foreach($dir as $x)
{
	if(is_dir($path.'/'.$x))
	{
		echo '<option value="'.$x.'" >'.$x.'</option>';
	}
}
echo <<<_END
	</select>
	<p><label for="name">Wybierz plik</label><br />
        <input type="file" name="file" /></p>
	<p><input type="submit" name="submit" value="Wyślij plik do katalogu w chmurze" /></p>
</form>  
_END;
?>