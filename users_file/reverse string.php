<?php

$number = '25455';
$string='ajeet';
$reverse = '';
$reverse_number='';
$i = 0;
$j=0;
while(!empty($string[$i])){
    $reverse = $string[$i].$reverse;
    $i++;
}
echo $reverse;


while(!empty($number[$j])){
    $reverse_number = $number[$j].$reverse_number;
    $j++;
}
echo $reverse_number;

?>