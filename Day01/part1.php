<?php
include 'src/input.php';

$input = new Input(1);
$lines = $input->split_by_newlines();
$position = (int) 50;
$count = 0;

foreach ($lines as $line) {
    preg_match("/(?<dir>[L,R])(?<count>\d{1,4})/", $line, $matches);

    if ($matches['dir'] == "L") {
        $position -= (int) $matches['count'];
    }

    if ($matches['dir'] == "R") {
        $position += (int) $matches['count'];
    }

    if ($position > 100) {
        $position %= 100;
    }

    if ($position < 0) {
        $position %= -100;
    }

    if ($position == 0 || $position == 100) {
        $count++;
    }
}

$input->submit_answer(1, $count);