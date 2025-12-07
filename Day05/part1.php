<?php
include 'src/input.php';

$input = new Input(5);
[$ranges, $ids] = explode("\n\n", $input->get_input());
$count = 0;

foreach (explode("\n", $ids) as $id) {
    if (inRanges($id, $ranges)) {
        $count++;
    }
}

$input->submit_answer(1, $count);

function inRanges($id, $ranges): bool 
{
    foreach (explode("\n", $ranges) as $range) {
        [$min, $max] = explode('-', $range);
        if ((int) $id <= $max && (int) $id >= $min) {
            return true;
        }
    }

    return false;
}