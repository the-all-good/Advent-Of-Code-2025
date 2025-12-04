<?php
include 'src/input.php';

$input = new Input(4);
$map = new Map($input->get_input());
$input->submit_answer(2, $map->repeat());

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

    private function viewMap()
    {
        foreach ($this->map as $y => $line) {
            foreach ($line as $char) {
                echo $char;
            }
            echo "\n";
        }
    }

    public function repeat(): int
    {
        $oldCount = 0;
        $newCount = 0;

        do {
            $oldCount = $newCount;
            $newCount += $this->solve();
        } while ($oldCount !== $newCount);
        
        return $newCount;
    }

    public function solve(): int
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
                
                $this->map[$y][$x] = '.';
                $count++;
            }
        }

        return $count;
    }
}