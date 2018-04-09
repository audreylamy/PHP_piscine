<?php
if ($_GET["action"] != NULL)
{
    if ($_GET["action"] == "set")
        setcookie($_GET["name"], $_GET["value"], time() + 365*24*3600, null, null, false, true);
    if ($_GET["action"] == "get")
    {
        if ($_COOKIE[$_GET["name"]] != NULL)
        {
            echo $_COOKIE[$_GET["name"]];
            echo "\n";
        }
    }
    if ($_GET["action"] == "del")
        setcookie($_GET["name"], "", time() -3600);
}
?>
