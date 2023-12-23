<?php

namespace card;

require_once(__DIR__."/card.php");

class CpuCard extends Card
{

    public function drew($player)
    {
        $key = array_rand($player->cardsInHand);
        $val = $this->CARD_NUMS[array_rand($this->CARD_NUMS)];
        $resultDrewCard = array($key => $val);
        $player->cardsInHand = array_merge_recursive($player->cardsInHand, $resultDrewCard);

        if($player->name === "ディーラー"){
            foreach ($resultDrewCard as $key => $val) {
                echo "{$player->name}の引いたカードは{$key}の{$val}です。" . PHP_EOL;
                echo "{$player->name}の引いた2枚目のカードはわかりません。" . PHP_EOL;
            }
        }
    }

    public function secondDrew($player, $isSecond)
    {
        $key = array_rand($player->cardsInHand);
        $val = $this->CARD_NUMS[array_rand($this->CARD_NUMS)];
        $resultDrewCard = array($key => $val);
        $player->cardsInHand = array_merge_recursive($player->cardsInHand, $resultDrewCard);

        if($player->name === "ディーラー" && $isSecond === true){
            foreach ($resultDrewCard as $key => $val) {
                echo "{$player->name}の引いた2枚目のカードは{$key}の{$val}でした。" . PHP_EOL;
            }
        }else{
            echo "ディーラーの引いたカードは{$key}の{$val}です。" . PHP_EOL;
        }
    }

    public function addDrew($player)
    {
        if ($player->name === "ディーラー") {
            while ($player->score <= 17) {
                $this->secondDrew($player, false);
                $player->calcScore();
            }
            $player->calcScore();
        } else {

            while ($player->score <= 17) {
                $this->drew($player);
                $player->calcScore();
            }
        }
    }
}

