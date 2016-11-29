<?php
require_once 'function.php';
$user=$_POST['user'];

$query="SELECT * FROM z7users WHERE login='$user'";
$wynik=queryMysql($query);
$rows1 = $wynik->num_rows;
$wynik->data_seek(0);
$row=$wynik->fetch_array(MYSQLI_NUM);

if(!file_exists($row[4]))
{
mkdir("$row[4]");
}

$file=$_FILES['file'];
if(isset($file['name']))
{
move_uploaded_file($file['tmp_name'], $row[4].'/'.$file['name']);
echo <<<_END
<script type="text/javascript">
window.location.href = 'klient.php';
</script>
_END;
}
else
{
	echo "Błąd przy przesyłaniu danych<br><a href=javascript:history.back();>Wstecz</a>";
}

?>