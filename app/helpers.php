<?php
if (!function_exists('isPrime')) {
function isPrime($number)
{
if($number<=1) return false;
$i = $number - 1;
while($i>1) {
if($number%$i==0) return false;
$i--;
}
return true;
}
function calculateGPA($grades, $maxGPA = 4.0) {
    $totalWeightedGrade = 0;
    $totalMaxGrade = 0;

    foreach ($grades as $grade) {
        $totalWeightedGrade += ($grade->grade / $grade->maxGrade) * $maxGPA * $grade->maxGrade;
        $totalMaxGrade += $grade->maxGrade;
    }

    return $totalMaxGrade > 0 ? round($totalWeightedGrade / $totalMaxGrade, 2) : 0.0;
}
}