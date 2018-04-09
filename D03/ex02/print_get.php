<?php
foreach ($_GET as $key => $value)
{
	if ($_GET["$key"] != NULL)
		echo $key.':'.' '.$value."\n";
}
?>