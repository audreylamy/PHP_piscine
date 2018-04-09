<?php
if (!file_exists('../private/'))
{
	$path = '../private/';
	mkdir($path, 0777, true);
}
if ($_POST['login'] && $_POST['oldpw'] && $_POST['newpw'] && $_POST['submit'] && $_POST['submit'] == "OK")
{
	$array_unser = unserialize(file_get_contents('../private/passwd',FILE_USE_INCLUDE_PATH));
	$i = 0;
	foreach ($array_unser as $account)
	{
		if (($account['login'] == $_POST['login']) && ($account['passwd'] == (hash("whirlpool",$_POST['oldpw']))))
		{
			$array_unser[$i]['passwd'] = (hash("whirlpool",$_POST['newpw']));
			echo "OK\n";
			$modif = 1;
		}
		$i++;
	}
	if ($modif == 1)
	{
		$array_ser = serialize($array_unser);
		file_put_contents('../private/passwd', $array_ser);
	}
	else
		echo "ERROR". "\n";
}
else 
{
	echo "ERROR". "\n";
}
?>