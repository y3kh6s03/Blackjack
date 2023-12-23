<?php

use player\Player;

require_once "blackjack.php";

echo "あなたとディーラー以外のプレイヤー数を0~3で入力してください" . PHP_EOL;
fscanf(STDIN, "%d", $inputPlayer);

$players = [];
$user = new Player("あなた", true);
$players[] = $user;
$dealer = new Player("ディーラー", false);
$players[] = $dealer;
$isInput = true;
while($isInput){
    if ($inputPlayer === 0) {
        echo "あなたとディーラーの直接対決です。" . PHP_EOL;
        $isInput = false;
    } elseif ($inputPlayer > 0 && $inputPlayer <= 3) {
        echo "あなた以外のプレイヤーが{$inputPlayer}人参加しました。" . PHP_EOL;
        for ($i = 0; $i < $inputPlayer; $i++) {
            $cpuName = "cpu" . $i;
            $$cpuName = new Player($cpuName, false);
            $players[] = $$cpuName;
        }
        echo "ブラックジャックを開始します。" . PHP_EOL;
        $isInput = false;
    }else{
        echo "無効な値が入力されました。0 ~ 3の値を入力してください。" . PHP_EOL;
        echo "あなたとディーラー以外のプレイヤー数を0~3で入力してください" . PHP_EOL;
        fscanf(STDIN, "%d", $inputPlayer);
    }
}


blackjack($players);
