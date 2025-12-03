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
    $count += getJoltage($bank);
}

$input->submit_answer(1, $count);

function getJoltage(string $bank): int
{
    $firstNum = 0;
    $secondNum = 0;
    foreach (str_split(substr($bank, 0, -1)) as $num) {
        if ($num > $firstNum) {
            $firstNum = $num;
            $secondNum = 0;
        } elseif ($num > $secondNum) {
            $secondNum = $num;
        } else {
            continue;
        }
    }

    $lastChar = (int) substr($bank, -1);

    if ($lastChar > $secondNum) {
        $secondNum = $lastChar;
    }

    $joltage = $firstNum . $secondNum;

    return (int) $joltage;
}