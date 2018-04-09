<?php
function ft_split($my_str)
{
	$my_tab = explode(' ', $my_str);
	$my_tab2 = array_filter($my_tab);
	sort($my_tab2);
	return ($my_tab2);
}
?>
