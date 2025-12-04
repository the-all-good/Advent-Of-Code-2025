<?php
include 'src/input.php';

$input = new Input(4);
$map = new Map($input->get_input());

$input->submit_answer(1, $map->solve());

class Map
{
    public array $map;

    public function __construct(string $input)
    {
        $this->map = $this->createMap($input);
    }

    private function createMap(string $input): array
    {
        $map = [];
        foreach (explode("\n", $input) as $y => $line) {
            $map[$y] = str_split($line);
        }

        return $map;
    }

    public function solve()
    {
        $count = 0;

        foreach ($this->map as $y => $line) {
            foreach ($line as $x => $item) {
                $touches = 0;
                if ($item !== "@") {
                    continue;
                }

                if (isset($this->map[$y + 1][$x + 1]) && $this->map[$y + 1][$x + 1] === "@") {
                    $touches++;
                }
                if (isset($this->map[$y + 1][$x]) && $this->map[$y + 1][$x] === "@") {
                    $touches++;
                }
                if (isset($this->map[$y + 1][$x - 1]) && $this->map[$y + 1][$x - 1] === "@") {
                    $touches++;
                }
                if (isset($this->map[$y][$x + 1]) && $this->map[$y][$x + 1] === "@") {
                    $touches++;
                }
                if (isset($this->map[$y][$x - 1]) && $this->map[$y][$x - 1] === "@") {
                    $touches++;
                }
                if (isset($this->map[$y - 1][$x - 1]) && $this->map[$y - 1][$x - 1] === "@") {
                    $touches++;
                }
                if (isset($this->map[$y - 1][$x]) && $this->map[$y - 1][$x] === "@") {
                    $touches++;
                }
                if (isset($this->map[$y - 1][$x + 1]) && $this->map[$y - 1][$x + 1] === "@") {
                    $touches++;
                }

                if ($touches >= 4) {
                    continue;
                }

                $count++;
            }
        }

        return $count;
    }
}