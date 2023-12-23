<?php

namespace card;

require_once(__DIR__ . "/card.php");

use card\Card;
use Exception;
use Throwable;

class UserCard extends Card
{
    public function drew($player)
    {
        $key = array_rand($player->cardsInHand);
        $val = $this->CARD_NUMS[array_rand($this->CARD_NUMS)];
        $resultDrewCard = array($key => $val);
        $player->cardsInHand = array_merge_recursive($player->cardsInHand, $resultDrewCard);
        foreach ($resultDrewCard as $key => $val) {
            echo "{$player->name}の引いたカードは{$key}の{$val}です。" . PHP_EOL;
        }
    }

    public function addDrew($player)
    {
        echo "カードを引きますか？(y/n):" . PHP_EOL;
        fscanf(STDIN, '%s', $input);
        if ($input === 'y') {
            while ($input == 'y') {
                $this->drew($player);
                $player->calcScore();
                $input = '';
                echo "カードを引きますか？(y/n):" . PHP_EOL;
                fscanf(STDIN, '%s', $input);
            }
        }
    }

    public function doubleDrew($player)
    {
        echo "ダブルダウンしますか？(y/n)" . PHP_EOL;
        fscanf(STDIN, "%s", $isDouble);
        if ($isDouble === "y") {
            $this->drew($player);
            return true;
        } else {
            return false;
        }
    }

    public function surrender($player)
    {
        echo "あなたの現在の得点は{$player->score}です。" . PHP_EOL;
        echo "サレンダーしますか？(y/n)" . PHP_EOL;
        fscanf(STDIN, "%s", $isSurrender);
        if($isSurrender === "y"){
            throw new Exception("プレイヤーがサレンダーを選択しました。プレイヤーの負けです。");
        }
    }
}

// プレイヤーのドローカードの値が等しかったときに条件分岐でメソッドを引っ張り出して以下を実行
// プレイヤーがもっているカードを二分割にする
// cardinhandを分割して二つの配列にする
// そこから普通にドローカードを行なって点数を加算していく
// それで結果を選択すればいい。
// ということはプレイヤーを分割？
// プレイヤーを分割するについては、既存のプレイヤーに付随して、プレイヤーをインスタンスする
// そのインスタンスしたオブジェクトにカードを分割して渡す
// そのあとは普通にドローを繰り返す？
// ということはプレイヤーが2人だったときのブラックジャックを成立させる必要がある
// プレイヤー[5]を使用することはないからそこに追加もしくは配列の最後に追加すればいい。
// 上記のパターンの実装
// プレイヤーをインスタンス化する
// それを配列に追加する。
// そのプレイヤーに既存のプレイヤーの手札を分割して渡す
// そしたら、2人ともカードをひくことが必要になるからドローカードを入れる
// 上のやつは最初と最後の配列の要素だけ別の配列を作成して、持たせる
// そこに追加していくようになるかな？

// それとも手札を二つに分割する？
// isPlayerがtrueのときには、オブジェクトを二つ持たせるようにしておく
// スプリットを選択されたときに、最初のcardinhandの値をもう一つの方に移行する
