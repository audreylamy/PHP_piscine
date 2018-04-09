#!/usr/bin/php
<?php
function    epur_str($my_string)
{
    $i = 0;
    $j = 0;
    $bool = 0;
    $my_string = trim($my_string);
    while ($my_string[$i] != NULL)
    {
        $result[$j] = $my_string[$i];
        $i++;
        $j++;
        while ($my_string[$i] == " " || $my_string[$i] == "\t" || $my_string[$i] == "\n"
        || $my_string[$i] == "\r" || $my_string[$i] == "\0" || $my_string[$i] == "\x0B")
        {
            $bool = 1;
            $i++;
        }
        if ($bool == 1 && $my_string[$i + 1] != NULL)
        {
            $result[$j] = ' ';
            $j++;
            $bool = 0;
        }
    }
    $result = implode('', $result);
    return $result;
}
if ($argc != 2)
	return;
$my_string= epur_str($argv[1]);
$my_string = explode(" ", $my_string);
$tmp = $my_string[0];
array_shift($my_string);
array_push($my_string, $tmp);
$result = implode(" ", $my_string);
echo $result;
echo "\n";
?>
