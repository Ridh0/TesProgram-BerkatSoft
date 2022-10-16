<?php
function task1($s, $a)
{
    $count = 0;
    for ($i = 0; $i < strlen($s); $i++) {
        $q = substr($s, $i, 1);
        for ($j = 0; $j < strlen($a) - 1; $j++) {
            $w = substr($a, $j, 1);
            if (strcasecmp($q, $w) == 0)
                $count++;
        }
    }
    if ($count == strlen($s)){
    return true;
    }else{
    return false;
    }
}
var_dump( task1("brs", "berkatsoft"));
var_dump( task1("brs", "berkatco"));
var_dump( task1("brs", "BERKATsoft"));


?>

