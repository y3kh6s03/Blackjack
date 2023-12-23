<?php

namespace player;

use Exception;

class Player
{
    public string $name;
    public bool $isPlayer;
    public array $cardsInHand = [
        'ハート' => [],
        'ダイヤ' => [],
        'クラブ' => [],
        'スペード' => []
    ];
    public int $score = 0;

    public function __construct($name, $isPlayer = true)
    {
        $this->name = $name;
        $this->isPlayer = $isPlayer;
    }

    public function calcScore()
    {
        $this->score = 0;
        foreach ($this->cardsInHand as $key => $vals) {
            if (!(empty($vals))) {
                foreach ($vals as $val) {
                    $val = $this->changeScore($val);
                    $this->score += $val;
                }
            }
        }
        if ($this->score > 21) {
            throw new Exception("{$this->name}の合計値が21を超えたので、{$this->name}の負けです。" . PHP_EOL);
        }
        if ($this->name === "ディーラー") {
            echo "{$this->name}の現在の得点は{$this->score}です。" . PHP_EOL;
        }
    }

    private function changeScore($val)
    {
        if ($val === 'A' && $this->score <= 10) {
            return 11;
        } elseif ($val === 'A' && $this->score >= 10) {
            return 1;
        } elseif (!($val === 'A') && is_string($val)) {
            return 10;
        } else {
            return $val;
        }
    }
}
