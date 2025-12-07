<?php
include 'src/input.php';

$input = new Input(5);

[$ranges, $ids] = explode("\n\n", $input->get_input());
$count = 0;
$ranges = explode("\n", $ranges);
$sortedRange = [];

foreach ($ranges as $range) {
    [$min, $max] = explode('-', $range);
    $sortedRange[] = ['min' => $min, 'max' => $max];
}

usort($sortedRange, function ($a, $b) {
    return [$a['min'], $a['max']] <=> [$b['min'], $b['max']];
});
$currentRange = [];

foreach ($sortedRange as $key => $array) {
    if (empty($currentRange)) {
        $currentRange['min'] = $array['min'];
        $currentRange['max'] = $array['max'];
        continue;
    }

    if ($array['min'] <= $currentRange['max'] && $array['max'] > $currentRange['max']) {
        $currentRange['max'] = $array['max'];
        continue;
    }

    if ($array['min'] > $currentRange['max']) {
        $count += $currentRange['max'] - $currentRange['min'] + 1;
        $currentRange = ['min' => $array['min'], 'max' => $array['max']];
        continue;
    }
}
$count += $currentRange['max'] - $currentRange['min'] + 1;

$input->submit_answer(2, $count);