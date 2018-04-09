<?php
function ft_is_sort($tab)
{
	$tmp = $tab;
	sort($tab);
	$i = 0;
	while ($tmp[$i] && $tab[$i])
	{
		if ($tmp[$i] != $tab[$i])
			return (FALSE);
		$i++;
	}
	return (TRUE);
}
?>
