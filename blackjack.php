<?php

require_once "card/user-card.php";
require_once "card/cpu-card.php";
require_once "player.php";

use card\UserCard;
use card\CpuCard;
use player\Player;

function blackjack($players)
{
    $userCard = new UserCard();
    $cpuCard = new CpuCard();

    try {
        userFirstCard($players[0], $userCard);
        dealerFirstCard($players[1], $cpuCard);

        if(isSplit($players[0])){
            $splitPlayer = split($players[0], $players);
            $players[] = $splitPlayer;
            $userCard->drew($players[0]);
            $userCard->drew($players[array_key_last($players)]);
            $userCard->addDrew($players[0]);
            $userCard->addDrew($players[array_key_last($players)]);
        }else{
            $userCard->surrender($players[0]);
            doubleDown($userCard, $players[0]);
        }

        dealerDrew($players[1], $cpuCard);
        cpuDrew($players, $cpuCard);
        results($players);
        judge($players);
    } catch (Throwable $e) {
        echo $e->getMessage();
    } finally {
        echo "ブラックジャックを終了します。";
    }
}

function userFirstCard($user, $card)
{
    $card->drew($user);
    $card->drew($user);
    $user->calcScore($user);
}

function dealerFirstCard($dealer, $card)
{
    $card->drew($dealer);
}

function doubleDown($userCard, $player)
{
    $isDouble = $userCard->doubleDrew($player);
    if ($isDouble) {
        $player->calcScore($player);
    } else {
        $userCard->addDrew($player);
    }
}

function isSplit($player){
    $isNum = [];
    foreach($player->cardsInHand as $key => $val){
        if(!empty($val)){
            $isNum[] = $val;
        }
    }
    return $isNum[0] === $isNum[1] ? true : false;
}

function split($player){
    echo "スプリットをしますか？(y/n)".PHP_EOL;
    fscanf(STDIN, "%s", $isSplit);
    if($isSplit === "y"){
        $splitPlayer = new Player("スプリット", true);
        foreach($player->cardsInHand as $key => $val){
            if(!empty($val)){
                $splitPlayer->cardsInHand[$key] = $val;
                $player->cardsInHand[$key] = "";
                break;
            }
        }
    }
    return $splitPlayer;
}

function dealerDrew($dealer, $card)
{
    $card->secondDrew($dealer, true);
    $dealer->calcScore($dealer);
    $card->addDrew($dealer);
}

function cpuDrew($players, $card)
{
    for ($i = 2; $i < count($players); $i++) {
        $card->addDrew($players[$i]);
    }
}

function results($players)
{
    for ($i = 0; $i < count($players); $i++) {
        if ($players[$i]->name !== "ディーラー") {
            echo "{$players[$i]->name}の得点は{$players[$i]->score}です。" . PHP_EOL;
        }
    }
    echo "{$players[1]->name}の得点は{$players[1]->score}です。" . PHP_EOL;
}

function judge($players)
{
    $winPlayer = array_reduce($players, function ($maxScorePlayer, $player) {
        return ($player->score > $maxScorePlayer->score) ? $player : $maxScorePlayer;
    }, $players[0]);
    echo "{$winPlayer->name}の勝ちです！";
}
