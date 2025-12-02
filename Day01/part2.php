<?php
include 'src/input.php';

$input = new Input(1);
$lines = $input->split_by_newlines();
$position = (int) 50;
$count = 0;

foreach ($lines as $line) {
    preg_match("/(?<dir>[L,R])(?<count>\d{1,4})/", $line, $matches);

    if ($matches['dir'] == "L") {
        if ($position == 0) {
            $count--;
        }
        $position -= (int) $matches['count'];
    }

    if ($matches['dir'] == "R") {
        if ($position == 100) {
            $count--;
        }
        $position += (int) $matches['count'];
    }

    while ($position > 100) {
        $position -= 100;
        $count++;
    }

    while ($position < 0) {
        $position += 100;
        $count++;
    }

    if ($position == 0 || $position == 100) {
        $count++;
    }
}

$input->submit_answer(2, $count);