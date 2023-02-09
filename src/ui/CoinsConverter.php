<?php

declare(strict_types=1);

namespace src\ui;

use Exception;
use src\domain\models\Coin;
use src\domain\models\Coins;

class CoinsConverter
{
    public static function toString(Coins $coins): string
    {
        if ($coins->isEmpty()) return "nochange";

        $coinsStrArray = [];
        foreach ($coins->getMap() as $key => $value) {
            $coinsStrArray[] = "$key $value";
        }

        return implode(' ', $coinsStrArray);
    }

    /**
     * @throws Exception
     */
    public static function fromArray(array $arr): Coins
    {
        $coins = new Coins();
        foreach ($arr as $amount => $number) {
            if (is_int($number) && $number > 0) {
                for ($i = 0; $i < $number; $i++) {
                    $coins->add(Coin::fromAmount(intval($amount)));
                }
            } else {
                throw new Exception('硬貨の個数が正の整数でない: ' . "$number");
            }
        }
        return $coins;
    }
}