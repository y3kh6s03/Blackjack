# ブラックジャックゲーム

## プレイ方法

> php index.php

-上記コマンドで実行

-プレイヤーとディーラー以外のCPUプレイヤーを0~3名を入力します。

## ルール
- 最初に2枚のカードが配られる。
- 手持ちカードの点数が21点に近い人が勝ち。21点以上になったらその時点で負け。
- 2~９に関しては、カードの数字が点数。
- Aは他のカードの合計ポイントが10以下の時、11点。10以上の時、1点。
- J、Q、Kは10点。

## 特別ルール
#### サレンダー
- 最初の2枚を確認して、ゲームから降りることができる。

#### ダブルダウン
- 最初の2枚を確認して、カードを1枚だけ追加する条件に掛金を倍にすることができる（掛金に関しては未実装なため、雰囲気をお楽しみください）

#### スプリット
- 最初の2枚のカードが同じ数字だった場合に、カードを二手に分けて勝負することが可能。
