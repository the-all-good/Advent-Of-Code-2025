<?php
include 'src/input.php';

$input = new Input(3);
$banks = $input->split_by_newlines();
// $input = "987654321111111
// 811111111111119
// 234234234234278
// 818181911112111";
// $banks = explode("\n", $input);
$count = 0;

foreach ($banks as $bank) {
    $count += getJoltage(str_split($bank));
}

$input->submit_answer(2, $count);

function getJoltage(array $bank): int
{
    if (count($bank) > 12) {
        foreach ($bank as $key => $num) {
            if ($key === 0) {
                continue;
            }

            if ($bank[$key - 1] < $num) {
                unset($bank[$key -1]);
    
                return getJoltage(array_values($bank));
            }

            if (! isset($bank[$key +1])) {
                unset($bank[$key]);

                return getJoltage(array_values($bank));
            }
        }
    }

    $joltage = implode('', $bank);
    
    return (int) $joltage;
}