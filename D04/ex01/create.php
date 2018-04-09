<?php
if (!file_exists('../private/'))
{
	$path = '../private/';
	mkdir($path, 0777, true);
}
if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] && $_POST['submit'] === "OK")
{
	if (!file_exists('../private/passwd'))
	{
		file_put_contents('../private/passwd', NULL);
		$tab = array(array('login' => htmlspecialchars($_POST['login']), 'passwd' => hash("whirlpool", $_POST['passwd'])));
		$array_ser = serialize($tab);
		file_put_contents('../private/passwd', $array_ser, FILE_APPEND);
		echo "OK"."\n";
	}
	else
	{
		$array_unser = unserialize(file_get_contents('../private/passwd', $array_ser));
		$egal = 0;
		foreach ($array_unser as $key => $value)
		{
			if ($value['login'] == $_POST['login'])
			{
				$egal = 1;
				echo "ERROR". "\n";
			}
		}
		if ($egal == 0)
		{
			$array_unser[] = array('login' => htmlspecialchars($_POST['login']), 'passwd' => hash("whirlpool",$_POST['passwd']));
			$array_ser = serialize($array_unser);
			file_put_contents('../private/passwd', $array_ser);
		}
	}
}
else 
{
	echo "ERROR". "\n";
}
?>