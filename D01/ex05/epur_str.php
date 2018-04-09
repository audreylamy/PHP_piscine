#!/usr/bin/php
<?php
$j = 0;
$v = 0;
$bool = 0;
if ($argc == 2)
{
    while ($argv[1][$j] == " ")
        $j++;
    while ($argv[1][$j] != NULL)
    {
        while ($argv[1][$j] == " ")
        {
            $bool = 1;
            $j++;
        }
        if ($bool == 1 && $argv[1][$j + 1] != NULL)
        {
            $my_epur_str[$v] = ' ';
            echo $my_epur_str[$v];
            $v++;
            $bool = 0;
        }
        $my_epur_str[$v] = $argv[1][$j];
        echo $my_epur_str[$v];
        $j++;
        $v++;
    }
    echo "\n";
}
?>
