#!/usr/bin/php
<?php
if ($argc != 1)
	return;
while (1)
{
	echo "Entrez un nombre : "; 
	$my_var = trim(fgets(STDIN));
	if (feof(STDIN))
    {
        echo "\n";
		return;
    }
	if (is_numeric($my_var) || ctype_alpha($my_var))
	{
        if (substr($my_var, -1, 1) % 2 == 0)
            echo "Le chiffre $my_var est Pair";
        else
            echo "Le chiffre $my_var est Impair";
	}
	else
	{
		echo "'$my_var' n'est pas un chiffre";
	}
	echo "\n";
}
?>
