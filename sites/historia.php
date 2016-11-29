<?php
require_once 'function.php';
if(isset($_POST['fidk']))
{
	$ajdi=$_POST['fidk'];
	$query="SELECT * FROM z7logi where fid='$ajdi' order by now DESC ";
	$wynik=queryMysql($query);
$rows1 = $wynik->num_rows;

echo "<table border=1 width=100>";
echo "<tr><td>ID</td><td>Adres IP</td><td>Data</td><td>Godzina</td><td>Udane logowanie?</td></tr>";
for($j = 0; $j < $rows1; ++$j)
{
		if($j%2==0)
		{
			echo "<tr style='background-color: #80B8E8;'>";
		}
		else
		{
			echo "<tr>";
		}
		$wynik->data_seek($j);
		$row=$wynik->fetch_array(MYSQLI_NUM);
		echo <<<_END
		<td>$row[0]</td>
		<td>$row[1]</td>
		<td>$row[2]</td>
		<td>$row[3]</td>
_END;
if($row[5]==0)
{
	echo "<td>NIE</td>";
}
else
{
	echo "<td>TAK</td>";
}
echo "</tr>";

}
echo "</table>";
}