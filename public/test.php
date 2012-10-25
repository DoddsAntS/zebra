<?php
function median($array = array()) {
    $middleIndex = ceil(count($array)/2) - 1; //0 based index
    return $array[$middleIndex];
}

function workArray($array = array()) {
    sort($array);
    $avg = array_sum($array)/count($array);
    return array('sorted'=>$array, 'median'=>median($array), 'average'=>$avg);
}

function sortNameNumeric($a, $b) {
    $a = preg_replace("/\D/i", "", $a);
    $b = preg_replace("/\D/i", "", $b);
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
}

$numericValues = array(50, 1500, 20.23, 65, 64, 3.145, 10, 42, 37, 91);
$fileNames = array("image1.jpg", "image50.jpg", "image10.jpg", "image5.jpg", "image2.jpg", "image9.jpg");
echo "<pre>";
print_r(workArray($numericValues));
echo "</pre>";

usort($fileNames, 'sortNameNumeric');
echo "<pre>";
print_r($fileNames);
echo "</pre>";
?>
