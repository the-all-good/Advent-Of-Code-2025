<?php
include 'src/input.php';

$input = new Input(2);
$puzzles = explode(',', $input->get_input());
$count = 0;

foreach ($puzzles as $puzzle) {
    preg_match("/(?<start>\d*)-(?<end>\d*)/", $puzzle, $match);
    $checkRange = range((int) $match['start'], (int) $match['end']);
    $count += checkRange($checkRange);
}

$input->submit_answer(1, $count);

function checkRange(array $range): int {
    $count = 0;
    foreach ($range as $num) {
        $halfLength = ceil(strlen($num) /2);
        $firstHalf = substr($num, 0, $halfLength);
        $endHalf = substr($num, $halfLength);
        $check = str_contains($endHalf, $firstHalf);

        if ($check) {
            $count += $num;
        } 
    }

    return $count;
}