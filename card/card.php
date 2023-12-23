<?php


namespace card;

abstract class Card
{
    protected array $CARD_NUMS = ['A', 2, 3, 4, 5, 6, 7, 8, 9, 'J', 'Q', 'K'];

    abstract public function drew($player);

    abstract public function addDrew($player);
}
