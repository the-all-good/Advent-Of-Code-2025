<?php
include 'src/input.php';

$input = new Input(2);
// $input = "11-22,95-115,998-1012,1188511880-1188511890,222220-222224,1698522-1698528,446443-446449,38593856-38593862,565653-565659,824824821-824824827,2121212118-2121212124";
$puzzles = explode(',', $input->get_input());
$count = 0;

foreach ($puzzles as $puzzle) {
    preg_match("/(?<start>\d*)-(?<end>\d*)/", $puzzle, $match);
    $checkRange = range((int) $match['start'], (int) $match['end']);
    $count += checkRange($checkRange);
}

$input->submit_answer(2, $count);

function checkRange(array $range): int 
{
    $count = 0;
    foreach ($range as $num) {
        $count += checkSequence($num);
    }

    return $count;
}

function checkSequence(int $num): int
{
    $count = 0;
    $halfLength = ceil(strlen($num) /2);
    foreach (range(1, $halfLength) as $check) {
        if (checkRepeat(substr($num, 0, $check), $num)) {
            $count += $num;
            break;
        }
    }

    return $count;
}

function checkRepeat($check, int $num): bool 
{
    $count = substr_count($num, $check);
    if ($count == strlen($num) / strlen($check) && $count > 1) {
        return true;
    }

    return false;
}